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
            <a class="btn btn-outline-light" href='/auth/login'>Войти</a>
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

            setcookie('warning_message', '', time()-1, "/auth");
        }
        ?>
        <form action="/auth/login/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Имя пользователя</label>
                <input type="text" class="form-control" name="username" required minlength="1" maxlength="36">
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" required minlength="2" maxlength="36">
            </div>
            <input class="btn btn-success mt-3" type="submit" value="Войти">
        </form>
    </div>
</main>

</body>
</html>