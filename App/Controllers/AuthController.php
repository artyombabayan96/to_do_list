<?php

namespace App\Controllers;

use App\Consts\UserConsts;
use App\Consts\ViewConsts;
use App\Middlewares\LoginDataValidator;
use App\Services\HTMLRenderingService;
use App\Services\Users\UserLoginService;

class AuthController
{
    public function login (): void
    {
        (new HTMLRenderingService())->render('App/Public/views/login.php', [
            'page-title' => ViewConsts::LOGIN_PAGE_TITLE,
            'app-name' => ViewConsts::APP_NAME
        ]);
    }

    public function loginHandler (): void
    {
        $data = [];

        if (isset($_POST['username'])) {
            $data['username'] = htmlspecialchars($_POST['username']);
        }
        if (isset($_POST['password'])) {
            $data['password'] = htmlspecialchars($_POST['password']);
        }

        $warnings = (new LoginDataValidator())->validate($data);

        if ($warnings === '') {
            try {
                $result = (new UserLoginService())->login($data);

                if ($result['authorized']) {

                    session_start();
                    $_SESSION['username'] = $result['username'];

                    header("refresh: 0; url=/");
                    setcookie('creation_message', UserConsts::AUTH_LOGIN_SUCCESS_MESSAGE, 0, "/");
                } else {

                    header("refresh: 0; url=/auth/login");
                    setcookie('warning_message', UserConsts::AUTH_INVALID_CREDENTIALS_MESSAGE, 0, "/auth");
                }

            } catch(\PDOException $err) {

                header("refresh: 0; url=/auth/login");
                setcookie('warning_message', UserConsts::AUTH_LOGIN_FAILED_MESSAGE, 0, "/auth");
            }
        } else {

            header("refresh: 0; url=/auth/login");
            setcookie('warning_message', $warnings, 0, "/auth");
        }

    }

    public function logout (): void
    {
        session_start();
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', null, -1, '/');

        header("refresh: 0; url=/");
    }
}