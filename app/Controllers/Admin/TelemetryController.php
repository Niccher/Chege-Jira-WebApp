<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TelemetryController extends BaseController
{
    public function index()
    {
        // 1. Container RAM
        $ramTotal = 0;
        $ramUsed = 0;
        if (is_readable('/proc/meminfo')) {
            $meminfo = file_get_contents('/proc/meminfo');
            preg_match('/MemTotal:\s+(\d+)\s+kB/', $meminfo, $totalMatches);
            preg_match('/MemAvailable:\s+(\d+)\s+kB/', $meminfo, $availMatches);
            
            $ramTotal = isset($totalMatches[1]) ? round($totalMatches[1] / 1024, 2) : 0;
            $ramAvail = isset($availMatches[1]) ? round($availMatches[1] / 1024, 2) : 0;
            $ramUsed = max(0, $ramTotal - $ramAvail);
        }
        $ramPercent = $ramTotal > 0 ? round(($ramUsed / $ramTotal) * 100) : 0;

        // 2. Container CPU Load
        $load = sys_getloadavg();
        $cpuLoad1 = $load[0] ?? 0;
        $cpuLoad5 = $load[1] ?? 0;
        $cpuLoad15 = $load[2] ?? 0;
        
        $cpuCores = 1;
        if (is_readable('/proc/cpuinfo')) {
            $cpuinfo = file_get_contents('/proc/cpuinfo');
            preg_match_all('/^processor/m', $cpuinfo, $matches);
            $cpuCores = max(count($matches[0]), 1);
        }
        $cpuPercent = min(100, round(($cpuLoad1 / $cpuCores) * 100));

        // 3. Disk Space
        $diskTotal = @disk_total_space("/") ?: 1;
        $diskFree = @disk_free_space("/") ?: 0;
        $diskUsed = $diskTotal - $diskFree;
        $diskPercent = $diskTotal > 0 ? round(($diskUsed / $diskTotal) * 100) : 0;

        $diskTotalGb = round($diskTotal / 1073741824, 2);
        $diskUsedGb = round($diskUsed / 1073741824, 2);
        $diskFreeGb = round($diskFree / 1073741824, 2);

        // 4. WebApp Runtime Specs
        $webAppSpecs = [
            'php_version'        => phpversion(),
            'php_sapi'           => php_sapi_name(),
            'ci_version'         => \CodeIgniter\CodeIgniter::CI_VERSION,
            'environment'        => ENVIRONMENT,
            'memory_limit'       => ini_get('memory_limit') ?: 'N/A',
            'memory_current'     => round(memory_get_usage(true) / 1048576, 2) . ' MB',
            'memory_peak'        => round(memory_get_peak_usage(true) / 1048576, 2) . ' MB',
            'max_execution_time' => ini_get('max_execution_time') . 's',
            'upload_max_filesize'=> ini_get('upload_max_filesize') ?: 'N/A',
            'post_max_size'      => ini_get('post_max_size') ?: 'N/A',
            'opcache_enabled'    => function_exists('opcache_get_status') && !empty(opcache_get_status(false)['opcache_enabled']),
            'session_driver'     => config('Session')->driver ?? 'Unknown',
            'session_save_path'  => config('Session')->savePath ?? 'ci_sessions',
            'timezone'           => date_default_timezone_get(),
        ];

        // 5. MySQL Container Specs & Live Status
        $dbSpecs = [
            'connected'          => false,
            'driver'             => config('Database')->default['DBDriver'] ?? 'MySQLi',
            'host'               => config('Database')->default['hostname'] ?? 'localhost',
            'database'           => config('Database')->default['database'] ?? 'chege_jira',
            'version'            => 'Unknown',
            'size_mb'            => 0,
            'table_count'        => 0,
            'active_threads'     => 0,
            'max_connections'    => 0,
            'uptime_human'       => 'Unknown',
            'innodb_buffer_pool' => 'Unknown',
            'slow_queries'       => 0,
            'open_tables'        => 0,
        ];

        try {
            $db = \Config\Database::connect();
            if ($db->initialize()) {
                $dbSpecs['connected'] = true;
                
                // MySQL Version
                $vQuery = $db->query("SELECT VERSION() as v");
                if ($vRow = $vQuery->getRow()) {
                    $dbSpecs['version'] = $vRow->v;
                }

                // Database Size & Tables
                $dbName = $db->database;
                $sizeQuery = $db->query("
                    SELECT 
                        COUNT(*) as table_count,
                        ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) as size_mb
                    FROM information_schema.TABLES 
                    WHERE table_schema = ?
                ", [$dbName]);

                if ($sizeRow = $sizeQuery->getRow()) {
                    $dbSpecs['size_mb'] = $sizeRow->size_mb ?? 0;
                    $dbSpecs['table_count'] = (int)($sizeRow->table_count ?? 0);
                }

                // Threads & Uptime
                $statusQuery = $db->query("SHOW GLOBAL STATUS WHERE Variable_name IN ('Threads_connected', 'Uptime', 'Slow_queries', 'Open_tables')");
                foreach ($statusQuery->getResultArray() as $statusRow) {
                    $val = $statusRow['Value'] ?? 0;
                    if ($statusRow['Variable_name'] === 'Threads_connected') {
                        $dbSpecs['active_threads'] = (int)$val;
                    } elseif ($statusRow['Variable_name'] === 'Uptime') {
                        $uptimeSecs = (int)$val;
                        $days = floor($uptimeSecs / 86400);
                        $hours = floor(($uptimeSecs % 86400) / 3600);
                        $mins = floor(($uptimeSecs % 3600) / 60);
                        $dbSpecs['uptime_human'] = "{$days}d {$hours}h {$mins}m";
                    } elseif ($statusRow['Variable_name'] === 'Slow_queries') {
                        $dbSpecs['slow_queries'] = (int)$val;
                    } elseif ($statusRow['Variable_name'] === 'Open_tables') {
                        $dbSpecs['open_tables'] = (int)$val;
                    }
                }

                // Variables (max_connections, innodb_buffer_pool_size)
                $varsQuery = $db->query("SHOW GLOBAL VARIABLES WHERE Variable_name IN ('max_connections', 'innodb_buffer_pool_size')");
                foreach ($varsQuery->getResultArray() as $varRow) {
                    $val = $varRow['Value'] ?? 0;
                    if ($varRow['Variable_name'] === 'max_connections') {
                        $dbSpecs['max_connections'] = (int)$val;
                    } elseif ($varRow['Variable_name'] === 'innodb_buffer_pool_size') {
                        $bufferBytes = (float)$val;
                        $dbSpecs['innodb_buffer_pool'] = round($bufferBytes / 1048576, 2) . ' MB';
                    }
                }
            }
        } catch (\Throwable $e) {
            log_message('warning', 'Telemetry MySQL fetch notice: ' . $e->getMessage());
        }

        return view('admin/telemetry', [
            'ramTotal'     => $ramTotal,
            'ramUsed'      => $ramUsed,
            'ramPercent'   => $ramPercent,
            'cpuLoad1'     => $cpuLoad1,
            'cpuLoad5'     => $cpuLoad5,
            'cpuLoad15'    => $cpuLoad15,
            'cpuCores'     => $cpuCores,
            'cpuPercent'   => $cpuPercent,
            'diskTotal'    => $diskTotalGb,
            'diskUsed'     => $diskUsedGb,
            'diskFree'     => $diskFreeGb,
            'diskPercent'  => $diskPercent,
            'webAppSpecs'  => $webAppSpecs,
            'dbSpecs'      => $dbSpecs,
        ]);
    }
}
