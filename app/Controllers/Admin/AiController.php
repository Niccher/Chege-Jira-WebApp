<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\LlmService;

class AiController extends BaseController
{
    protected LlmService $llm;

    public function __construct()
    {
        $this->llm = new LlmService();
    }

    /**
     * AI Microservice Telemetry & Cache Monitor
     */
    public function telemetry()
    {
        $telemetryData = $this->llm->getTelemetry();
        $modelsData = $this->llm->getModels();

        return view('admin/ai/telemetry', [
            'telemetry' => $telemetryData['data'] ?? [],
            'models'    => $modelsData['data']['models'] ?? [],
            'isOnline'  => $telemetryData['success'] ?? false,
            'errorMsg'  => $telemetryData['error']['message'] ?? null,
        ]);
    }

    /**
     * AI Runtime Configuration Form
     */
    public function settings()
    {
        $serviceUrl = setting('Ml.serviceUrl') ?? env('ML_SERVICE_URL', 'http://ml-chege-jira:8000');
        $apiKey     = setting('Ml.apiKey') ?? env('ML_API_KEY', 'chege_jira_ml_super_secret_key_2026');

        $configData = $this->llm->getConfig();
        $modelsData = $this->llm->getModels();

        return view('admin/ai/settings', [
            'serviceUrl' => $serviceUrl,
            'apiKey'     => $apiKey,
            'config'     => $configData['data'] ?? [
                'default_model' => 'mistral-7b',
                'n_gpu_layers'  => 0,
                'n_threads'     => 4,
                'n_ctx'         => 4096,
            ],
            'models'     => $modelsData['data']['models'] ?? [],
            'isOnline'   => $configData['success'] ?? false,
            'errorMsg'   => $configData['error']['message'] ?? null,
        ]);
    }

    /**
     * Save AI Settings: Service URL, Port, API Key, and Model Parameters
     */
    public function updateSettings()
    {
        $serviceUrl   = trim((string)$this->request->getPost('service_url'));
        $apiKey       = trim((string)$this->request->getPost('api_key'));
        $defaultModel = trim((string)$this->request->getPost('default_model'));
        $computeMode  = trim((string)$this->request->getPost('compute_mode'));
        $nThreads     = (int)($this->request->getPost('n_threads') ?? 4);
        $nCtx         = (int)($this->request->getPost('n_ctx') ?? 4096);

        // 1. Save Connection Parameters to WebApp Settings
        if (!empty($serviceUrl)) {
            setting('Ml.serviceUrl', rtrim($serviceUrl, '/'));
        }
        if (!empty($apiKey)) {
            setting('Ml.apiKey', $apiKey);
        }

        // 2. Instantiate updated LLM client
        $updatedLlm = new LlmService($serviceUrl, $apiKey);

        // 3. Dispatch runtime configuration to ML microservice
        $n_gpu_layers = ($computeMode === 'gpu') ? -1 : 0;
        $res = $updatedLlm->updateConfig([
            'default_model' => $defaultModel ?: 'mistral-7b',
            'n_gpu_layers'  => $n_gpu_layers,
            'n_threads'     => max(1, min(64, $nThreads)),
            'n_ctx'         => max(512, min(32768, $nCtx)),
        ]);

        if (!empty($res['success'])) {
            return redirect()->to(site_url('admin/ai/settings'))->with('message', 'AI Service URL and runtime parameters updated and synchronized successfully.');
        }

        $warning = 'Saved connection settings locally, but could not sync parameters with ML backend at ' . esc($serviceUrl) . ' (' . ($res['error']['message'] ?? 'Service unreachable') . ')';
        return redirect()->to(site_url('admin/ai/settings'))->with('message', $warning);
    }

    /**
     * Test connection to ML Microservice
     */
    public function testConnection()
    {
        $serviceUrl = trim((string)$this->request->getPost('service_url'));
        $apiKey     = trim((string)$this->request->getPost('api_key'));

        $testLlm = new LlmService($serviceUrl, $apiKey);
        $health = $testLlm->getHealth();

        if (!empty($health['success'])) {
            return redirect()->to(site_url('admin/ai/settings'))->with('message', 'Connection successful! ML Microservice is healthy and reachable at ' . esc($serviceUrl));
        }

        $errMsg = $health['error']['message'] ?? 'Could not reach service';
        return redirect()->to(site_url('admin/ai/settings'))->with('error', 'Connection failed to ' . esc($serviceUrl) . ': ' . $errMsg);
    }

    /**
     * Model & Cache Action (download, preload, reload, evict)
     */
    public function cacheAction()
    {
        $action   = trim((string)$this->request->getPost('action'));
        $modelKey = trim((string)$this->request->getPost('model_key'));
        $redirect = trim((string)$this->request->getPost('redirect')) ?: 'telemetry';

        $targetUrl = ($redirect === 'settings') ? 'admin/ai/settings' : 'admin/ai/telemetry';

        if ($action === 'download') {
            $res = $this->llm->downloadModel($modelKey);
        } elseif ($action === 'preload') {
            $res = $this->llm->preloadModel($modelKey);
        } elseif ($action === 'reload') {
            $res = $this->llm->reloadModel($modelKey);
        } elseif ($action === 'evict') {
            $res = $this->llm->evictModel($modelKey);
        } else {
            return redirect()->to(site_url($targetUrl))->with('error', 'Invalid model action.');
        }

        if (!empty($res['success'])) {
            return redirect()->to(site_url($targetUrl))->with('message', $res['data']['message'] ?? 'Model operation initiated successfully.');
        }

        $msg = $res['error']['message'] ?? 'Model operation failed.';
        return redirect()->to(site_url($targetUrl))->with('error', $msg);
    }
}
