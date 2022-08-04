<?php

namespace App\Routes;

use App\Middlewares\CookieCleaner;
use App\Controllers\TaskController;
use App\Controllers\AuthController;
use App\Controllers\MigrationController;

class Router
{
	public function route($url): void
	{
        (new CookieCleaner())->clean();

        match ($url) {
            '/' => (new TaskController())->index(),
            '/task/create' => (new TaskController())->create(),
            '/task/store' => (new TaskController())->store(),
            '/task/edit/' => (new TaskController())->edit(),
            '/task/edit/store' => (new TaskController())->editHandler(),
            '/auth/login' => (new AuthController())->login(),
            '/auth/logout' => (new AuthController())->logout(),
            '/auth/login/store' => (new AuthController())->loginHandler(),
            '/config/migrate' => (new MigrationController())->migrate(),
            default => (new TaskController())->notFound()
        };
	}
}