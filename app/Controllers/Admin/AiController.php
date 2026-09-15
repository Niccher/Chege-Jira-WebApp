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
        $configData = $this->llm->getConfig();
        $modelsData = $this->llm->getModels();

        return view('admin/ai/settings', [
            'config'   => $configData['data'] ?? [
                'default_model' => 'mistral-7b',
                'n_gpu_layers'  => 0,
                'n_threads'     => 4,
                'n_ctx'         => 4096,
            ],
            'models'   => $modelsData['data']['models'] ?? [],
            'isOnline' => $configData['success'] ?? false,
        ]);
    }

    /**
     * Save AI Settings via PATCH call to FastAPI backend
     */
    public function updateSettings()
    {
        $defaultModel = trim((string)$this->request->getPost('default_model'));
        $computeMode  = trim((string)$this->request->getPost('compute_mode'));
        $nThreads     = (int)($this->request->getPost('n_threads') ?? 4);
        $nCtx         = (int)($this->request->getPost('n_ctx') ?? 4096);

        $n_gpu_layers = ($computeMode === 'gpu') ? -1 : 0;

        $res = $this->llm->updateConfig([
            'default_model' => $defaultModel ?: 'mistral-7b',
            'n_gpu_layers'  => $n_gpu_layers,
            'n_threads'     => max(1, min(64, $nThreads)),
            'n_ctx'         => max(512, min(32768, $nCtx)),
        ]);

        if (!empty($res['success'])) {
            return redirect()->to(site_url('admin/ai/settings'))->with('message', 'AI Engine runtime configuration updated successfully.');
        }

        $msg = $res['error']['message'] ?? 'Failed to update AI Engine settings.';
        return redirect()->to(site_url('admin/ai/settings'))->with('error', $msg);
    }

    /**
     * Cache Action (pre-load or evict)
     */
    public function cacheAction()
    {
        $action = trim((string)$this->request->getPost('action'));
        $modelKey = trim((string)$this->request->getPost('model_key'));

        if ($action === 'preload') {
            $res = $this->llm->preloadModel($modelKey);
        } elseif ($action === 'evict') {
            $res = $this->llm->evictModel($modelKey);
        } else {
            return redirect()->to(site_url('admin/ai/telemetry'))->with('error', 'Invalid cache action.');
        }

        if (!empty($res['success'])) {
            return redirect()->to(site_url('admin/ai/telemetry'))->with('message', $res['data']['message'] ?? 'Cache operation completed.');
        }

        $msg = $res['error']['message'] ?? 'Cache operation failed.';
        return redirect()->to(site_url('admin/ai/telemetry'))->with('error', $msg);
    }
}
