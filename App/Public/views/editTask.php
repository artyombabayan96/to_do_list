<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
            echo $GLOBALS['page-title'];
        ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-md py-2 justify-content-spaced">
            <a class="navbar-brand" href="/">
                <?php
                    echo $GLOBALS['app-name'];
                ?>
            </a>
            <?php
                if (isset($_COOKIE['PHPSESSID'])) {
                    session_start();

                    if (isset($_SESSION['username'])) {
                        echo "<h6 class='text-white'>Привет, ".$_SESSION['username']."</h6>";
                        echo "<a class='btn btn-outline-light' href='/auth/logout'>Выйти</a>";
                    }

                } else {
                    echo "<a class='btn btn-outline-light' href='/auth/login'>Войти</a>";
                }
            ?>
        </div>
    </nav>
</header>

<main>
    <div class="container-md py-5 px-2">
        <?php
            if (isset($_COOKIE['warning_message'])) {
                echo '<div class="alert alert-danger text-center mb-5" role="alert">';
                echo $_COOKIE['warning_message'];
                echo '</div>';

                setcookie('warning_message', '', time()-1, "/task");
            }
            if (isset($_COOKIE['PHPSESSID'])) {
                session_start();

                if (isset($_SESSION['username']) and isset($GLOBALS['task'])) {
                    ?>
            <form action="/task/edit/store" method="POST">
                <input type="hidden" name="task_id" value="<?php echo $GLOBALS['task']['task_id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Имя пользователя</label>
                    <input class="form-control" type="text" placeholder="<?php echo $GLOBALS['task']['username'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" type="text" placeholder="<?php echo $GLOBALS['task']['email'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Текст задачи</label>
                    <textarea class="form-control" name="task" rows="3" required minlength="2" maxlength="500"><?php echo $GLOBALS['task']['task'] ?></textarea>
                </div>
                <div class="mb-5">
                    <label class="form-label">Статус задачи</label>
                    <div class="form-check ms-5">
                        <input class="form-check-input" type="radio" name="status" value="Не выполнен" <?php
                            if ($GLOBALS['task']['status'] === 'Не выполнен') {echo 'checked';}
                        ?>>
                        <label class="form-check-label">
                            Не выполнен
                        </label>
                    </div>
                    <div class="form-check ms-5">
                        <input class="form-check-input" type="radio" name="status" value="Выполнен" <?php
                            if ($GLOBALS['task']['status'] === 'Выполнен') {echo 'checked';}
                        ?>>
                        <label class="form-check-label">
                            Выполнен
                        </label>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" value="Изменить задачу">
            </form>
        <?php
                }
            }
        ?>
    </div>
</main>

</body>
</html>