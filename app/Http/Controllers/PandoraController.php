<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class PandoraController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response['status'] = 'ok';

        if (!App::environment('production')) {
            $response['laravel_version'] = Application::VERSION;
            $response['php_version'] = PHP_VERSION;
            $response['pandora_version'] = Config::get('pandora.version');
        }

        TestJob::dispatch();

        return Response::json($response);
    }
}
