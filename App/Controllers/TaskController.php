<?php

namespace App\Controllers;

use App\Consts\TaskConsts;
use App\Consts\UserConsts;
use App\Consts\ViewConsts;
use App\Services\HTMLRenderingService;
use App\Services\Tasks\GetTaskByIdService;
use App\Services\Tasks\GetTasksService;
use App\Services\Tasks\CreateTaskService;
use App\Services\Tasks\ChangeTaskService;
use App\Middlewares\InsertTableDataValidator;
use App\Middlewares\ChangeTableDataValidator;

class TaskController
{
    public function index (): void
    {
        $order_column = TaskConsts::TASKS_DEFAULT_ORDER_COLUMN;
        $order = TaskConsts::TASKS_DEFAULT_ORDER;
        $page = TaskConsts::TASKS_DEFAULT_PAGE;
        $chunk = TaskConsts::TASKS_SINGLE_PAGE_TASKS_COUNT;

        if (isset($_GET["order_column"]) and in_array($_GET["order_column"], TaskConsts::TASKS_TABLE_COLUMNS)) {
            $order_column = $_GET["order_column"];
            setcookie('order_column', $order_column, 0, "/");
        } else if (isset($_COOKIE["order_column"]) and in_array($_COOKIE["order_column"], TaskConsts::TASKS_TABLE_COLUMNS)) {
            $order_column = $_COOKIE["order_column"];
        }

        if (isset($_GET["order"]) and in_array($_GET["order"], TaskConsts::TASKS_ORDER_VARIANTS)) {
            $order = $_GET["order"];
            setcookie('order', $order, 0, "/");
        } else if (isset($_COOKIE["order"]) and in_array($_COOKIE["order"], TaskConsts::TASKS_ORDER_VARIANTS)) {
            $order = $_COOKIE["order"];
        }

        if (!isset($_GET["order_column"]) and !isset($_GET["order"])) {

            $_COOKIE['page'] = $page;
            setcookie('page', $page, 0, "/");
        }

        if (isset($_GET["page"]) and intval($_GET['page']) > 0) {
            $page = intval($_GET['page']);
        } else if (isset($_COOKIE["page"]) and intval($_COOKIE['page']) > 0) {
            $page = intval($_COOKIE['page']);
        }

        $_COOKIE['page'] = $page;
        setcookie('page', $page, 0, "/");


        $tasks = (new GetTasksService())->get($order_column, $order, $page, $chunk);

        if($tasks === []) {
            if ($page === 1) {
                $_COOKIE['message'] = TaskConsts::TASKS_EMPTY_MESSAGE;
                setcookie('message', TaskConsts::TASKS_EMPTY_MESSAGE, 0, "/");
            } else {
                $_COOKIE['message'] = TaskConsts::TASKS_PAGE_EMPTY_MESSAGE;
                setcookie('message', TaskConsts::TASKS_PAGE_EMPTY_MESSAGE, 0, "/");
            }
        }

        (new HTMLRenderingService())->render('App/Public/views/main.php', [
            'page-title' => ViewConsts::MAIN_PAGE_TITLE,
            'app-name' => ViewConsts::APP_NAME,
            'tasks' => $tasks
        ]);
    }

    public function create (): void
    {
        (new HTMLRenderingService())->render('App/Public/views/newTask.php', [
            'page-title' => ViewConsts::NEW_TASK_PAGE_TITLE,
            'app-name' => ViewConsts::APP_NAME
        ]);
    }

    public function store (): void
    {
        $data = [];

        if (isset($_POST['username'])) {
            $data['username'] = htmlspecialchars($_POST['username']);
        }
        if (isset($_POST['email'])) {
            $data['email'] = htmlspecialchars($_POST['email']);
        }
        if (isset($_POST['task'])) {
            $data['task'] = htmlspecialchars($_POST['task']);
        }
        $data['status'] = 'Не выполнен';

        $warnings = (new InsertTableDataValidator())->validate($data);

        if ($warnings === '') {
            try {
                (new CreateTaskService())->create($data);

                header("refresh: 0; url=/");
                setcookie('creation_message', TaskConsts::TASK_SUCCESS_MESSAGE, 0, "/");
            } catch(\PDOException $err) {

                header("refresh: 0; url=/task/create");
                setcookie('warning_message', TaskConsts::TASK_FAILED_MESSAGE, 0, "/");
            }
        } else {

            header("refresh: 0; url=/task/create");
            setcookie('warning_message', $warnings, 0, "/task");
        }
    }

    public function edit (): void
    {
        if (isset($_COOKIE['PHPSESSID'])) {
            session_start();

            if (isset($_SESSION['username'])) {
                if (isset($_GET["task_id"]) and $_GET["task_id"] != '') {
                    $task = (new GetTaskByIdService())->get($_GET["task_id"]);

                    if ($task != []) {
                        (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                            'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                            'app-name' => ViewConsts::APP_NAME,
                            'task' => $task
                        ]);
                    } else {

                        $_COOKIE['warning_message'] = TaskConsts::TASK_NOT_FOUND_MESSAGE;
                        setcookie('warning_message', TaskConsts::TASK_NOT_FOUND_MESSAGE, 0, "/task");

                        (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                            'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                            'app-name' => ViewConsts::APP_NAME
                        ]);
                    }
                } else {
                    if (isset($_COOKIE['warning_message'])) {

                        setcookie('warning_message', $_COOKIE['warning_message'], 0, "/task");

                        (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                            'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                            'app-name' => ViewConsts::APP_NAME
                        ]);
                    } else {

                        $_COOKIE['warning_message'] = TaskConsts::TASK_ID_NOT_SET_MESSAGE;
                        setcookie('warning_message', TaskConsts::TASK_ID_NOT_SET_MESSAGE, 0, "/task");

                        (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                            'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                            'app-name' => ViewConsts::APP_NAME
                        ]);
                    }
                }
            } else {

                $_COOKIE['warning_message'] = UserConsts::AUTH_NOT_AUTHORIZED;
                setcookie('warning_message', UserConsts::AUTH_NOT_AUTHORIZED, 0, "/task");

                (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                    'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                    'app-name' => ViewConsts::APP_NAME
                ]);
            }
        } else {

            $_COOKIE['warning_message'] = UserConsts::AUTH_NOT_AUTHORIZED;
            setcookie('warning_message', UserConsts::AUTH_NOT_AUTHORIZED, 0, "/task");

            (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                'app-name' => ViewConsts::APP_NAME
            ]);
        }
    }

    public function editHandler (): void
    {
        if (isset($_COOKIE['PHPSESSID'])) {
            session_start();

            if (isset($_SESSION['username'])) {

                $data = [];

                if (isset($_POST['task_id'])) {
                    $data['task_id'] = htmlspecialchars($_POST['task_id']);
                }
                if (isset($_POST['task'])) {
                    $data['task'] = htmlspecialchars($_POST['task']);
                }
                if (isset($_POST['status'])) {
                    $data['status'] = htmlspecialchars($_POST['status']);
                }

                $warnings = (new ChangeTableDataValidator())->validate($data);

                if ($warnings === '') {
                    try {
                        (new ChangeTaskService())->change($data);

                        header("refresh: 0; url=/");
                        setcookie('creation_message', TaskConsts::TASK_UPDATED_MESSAGE, 0, "/");
                    } catch(\PDOException $err) {

                        header("refresh: 0; url=/task/edit");
                        setcookie('warning_message', TaskConsts::TASK_UPDATE_FAILED_MESSAGE, 0, "/task");
                    }
                } else {

                    header("refresh: 0; url=/task/edit/");
                    setcookie('warning_message', $warnings, 0, "/task");
                }
            } else {

                $_COOKIE['warning_message'] = UserConsts::AUTH_NOT_AUTHORIZED;
                setcookie('warning_message', UserConsts::AUTH_NOT_AUTHORIZED, 0, "/task");

                (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                    'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                    'app-name' => ViewConsts::APP_NAME
                ]);
            }
        } else {

            $_COOKIE['warning_message'] = UserConsts::AUTH_NOT_AUTHORIZED;
            setcookie('warning_message', UserConsts::AUTH_NOT_AUTHORIZED, 0, "/task");

            (new HTMLRenderingService())->render('App/Public/views/editTask.php', [
                'page-title' => ViewConsts::EDIT_TASK_PAGE_TITLE,
                'app-name' => ViewConsts::APP_NAME
            ]);
        }
    }

    public function notFound (): void
    {
        (new HTMLRenderingService())->render('App/Public/views/404.php', [
            'app-name' => ViewConsts::APP_NAME,
            'page-title' => ViewConsts::NOT_FOUND_PAGE_TITLE,
            'page-not-found-message' => ViewConsts::PAGE_NOT_FOUND_MESSAGE
        ]);
    }
}