<?php

namespace App\Middlewares;

use App\Consts\CookieConsts;

class CookieCleaner
{
    private function deleteRemovableCookies($path, $cookies): void
    {
        foreach ($cookies as $cookieName) {
            setcookie($cookieName, '', time()-1, $path);
        }
    }

    public function clean(): void
    {
        $this->deleteRemovableCookies('/', CookieConsts::COOKIE_MAIN_REMOVABLES);
        $this->deleteRemovableCookies('/task', CookieConsts::COOKIE_TASK_REMOVABLES);
        $this->deleteRemovableCookies('/auth', CookieConsts::COOKIE_AUTH_REMOVABLES);
    }
}