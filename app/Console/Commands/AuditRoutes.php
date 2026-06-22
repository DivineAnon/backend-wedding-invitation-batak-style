<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

class AuditRoutes extends Command
{
    protected $signature = 'route:audit';
    protected $description = 'Audit all GET routes for 500 errors';

    public function handle()
    {
        $routes = Route::getRoutes();
        $kernel = app(Kernel::class);

        $this->info("Auditing routes...");

        foreach ($routes as $route) {
            if (!in_array('GET', $route->methods())) {
                continue;
            }
            if (strpos($route->uri(), '{') !== false) {
                // skip parameterized routes
                continue;
            }

            try {
                $request = Request::create($route->uri(), 'GET');
                $response = $kernel->handle($request);
                $status = $response->getStatusCode();
                
                if ($status >= 500) {
                    $this->error("[$status] {$route->uri()}");
                    $content = $response->getContent();
                    preg_match('/<title>(.*?)<\/title>/', $content, $matches);
                    $this->error("Error: " . ($matches[1] ?? 'Unknown Error'));
                } else {
                    $this->line("[$status] {$route->uri()}");
                }
            } catch (\Throwable $e) {
                $this->error("[500] {$route->uri()}");
                $this->error("Exception: " . $e->getMessage());
            }
        }
        $this->info("Audit complete.");
    }
}
