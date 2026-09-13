<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TelemetryController extends BaseController
{
    public function index()
    {
        $ramTotal = 0;
        $ramUsed = 0;
        
        // Parse /proc/meminfo for robust container RAM reading
        if (is_readable('/proc/meminfo')) {
            $meminfo = file_get_contents('/proc/meminfo');
            preg_match('/MemTotal:\s+(\d+)\s+kB/', $meminfo, $totalMatches);
            preg_match('/MemAvailable:\s+(\d+)\s+kB/', $meminfo, $availMatches);
            
            $ramTotal = isset($totalMatches[1]) ? round($totalMatches[1] / 1024, 2) : 0;
            $ramAvail = isset($availMatches[1]) ? round($availMatches[1] / 1024, 2) : 0;
            $ramUsed = $ramTotal - $ramAvail;
        }

        $ramPercent = $ramTotal > 0 ? round(($ramUsed / $ramTotal) * 100) : 0;

        // CPU Load (1 min, 5 min, 15 min)
        $load = sys_getloadavg();
        $cpuLoad1 = $load[0] ?? 0;
        $cpuLoad5 = $load[1] ?? 0;
        $cpuLoad15 = $load[2] ?? 0;
        
        // Number of cores to calculate percentage
        $cpuCores = 1;
        if (is_readable('/proc/cpuinfo')) {
            $cpuinfo = file_get_contents('/proc/cpuinfo');
            preg_match_all('/^processor/m', $cpuinfo, $matches);
            $cpuCores = max(count($matches[0]), 1);
        }
        $cpuPercent = round(($cpuLoad1 / $cpuCores) * 100);

        // Disk Space (App Volume)
        $diskTotal = disk_total_space("/");
        $diskFree = disk_free_space("/");
        $diskUsed = $diskTotal - $diskFree;
        $diskPercent = $diskTotal > 0 ? round(($diskUsed / $diskTotal) * 100) : 0;

        // Format to GB
        $diskTotalGb = round($diskTotal / 1073741824, 2);
        $diskUsedGb = round($diskUsed / 1073741824, 2);

        // Environment Details
        $phpVersion = phpversion();
        $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';

        return view('admin/telemetry', [
            'ramTotal' => $ramTotal,
            'ramUsed' => $ramUsed,
            'ramPercent' => $ramPercent,
            'cpuLoad1' => $cpuLoad1,
            'cpuLoad5' => $cpuLoad5,
            'cpuLoad15' => $cpuLoad15,
            'cpuCores' => $cpuCores,
            'cpuPercent' => $cpuPercent,
            'diskTotal' => $diskTotalGb,
            'diskUsed' => $diskUsedGb,
            'diskPercent' => $diskPercent,
            'phpVersion' => $phpVersion,
            'serverSoftware' => $serverSoftware,
        ]);
    }
}
