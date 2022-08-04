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
                if (isset($_COOKIE['creation_message'])) {
                    echo '<div class="alert alert-success text-center mb-5" role="alert">';
                    echo $_COOKIE['creation_message'];
                    echo '</div>';

                    setcookie('creation_message', '', time()-1, "/");
                }

                if (!isset($GLOBALS['tasks']) or $GLOBALS['tasks'] === []) {
                    if (isset($_COOKIE['message'])) {
                        echo '<div class="alert alert-secondary text-center mb-5" role="alert">';
                        echo $_COOKIE['message'];
                        echo '</div>';
                    }
                } else {
            ?>
                <table class="table container-fluid">
                    <thead>
                    <tr class="row text-nowrap table-primary">
                        <th class="col-sm-2">
                            имя пользователя
                            <span class="mx-2">
                                <a href="/?order_column=username&order=desc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                                <a href="/?order_column=username&order=asc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                    </svg>
                                </a>
                            </span>
                        </th>
                        <th class="col-sm-2">
                            email
                            <span class="mx-2">
                                <a href="/?order_column=email&order=desc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                                <a href="/?order_column=email&order=asc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                    </svg>
                                </a>
                            </span>
                        </th>
                        <?php
                            if (isset($_SESSION['username'])) {
                                echo "<th class='col-sm-5'>текст задачи</th>";
                            } else {
                                echo "<th class='col-sm-6'>текст задачи</th>";
                            }
                        ?>
                        <th class="col-sm-2">
                            статус
                            <span class="mx-2">
                                <a href="/?order_column=status&order=desc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                                <a href="/?order_column=status&order=asc" class="d-inline-block m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                    </svg>
                                </a>
                            </span>
                        </th>
                        <?php
                            if (isset($_SESSION['username'])) {
                                echo "<th class='col-sm-1'>Действие</th>";
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo "<h6 class='text-white'>Привет, " . $_SESSION['username'] . "</h6>";
                            echo "<a class='btn btn-outline-light' href='/auth/logout'>Выйти</a>";

                            foreach ($GLOBALS['tasks'] as $index => $record) {
                                echo "<tr class='row'>";
                                echo "<td class='col-sm-2'>" . $record['username'] . "</td>";
                                echo "<td class='col-sm-2'>" . $record['email'] . "</td>";
                                echo "<td class='col-sm-5'>" . $record['task'] . "</td>";
                                echo "<td class='col-sm-2'>" . $record['status'] . "</td>";
                                echo "<td class='col-sm-1'>";
                                echo "<a href='/task/edit/?task_id=" . $record['task_id'] . "' class='link-primary'>Изменить</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            foreach ($GLOBALS['tasks'] as $index => $record) {
                                echo "<tr class='row'>";
                                echo "<td class='col-sm-2'>" . $record['username'] . "</td>";
                                echo "<td class='col-sm-2'>" . $record['email'] . "</td>";
                                echo "<td class='col-sm-6'>" . $record['task'] . "</td>";
                                echo "<td class='col-sm-2'>" . $record['status'] . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                    </tbody>
                </table>

                <ul class="pagination my-4 d-flex justify-content-center">
                    <?php
                        if (isset($_COOKIE['pages_count']) and isset($_COOKIE['page'])) {
                            $page = intval($_COOKIE['page']);
                            $pagesCount = intval($_COOKIE['pages_count']);

                            if ($_COOKIE['pages_count'] > 1) {

                                echo "<li class='page-item'>";
                                echo "<a class='page-link' href='/?page=";
                                if ($page === 1) {
                                    echo $pagesCount;
                                } else if ($page >= 2) {
                                    echo $page - 1;
                                }
                                echo "' aria-label='Previous'>";
                                echo "<span aria-hidden='true'>&laquo;</span></a></li>";

                                for ($i = 1; $i <= $pagesCount; $i++) {
                                    echo "<li class='age-item'><a class='page-link";
                                    if ($page === $i) {
                                        echo " bg-primary text-white";
                                    }
                                    echo "' href='/?page=$i'>$i</a></li>";
                                }

                                echo "<li class='page-item'>";
                                echo "<a class='page-link' href='/?page=";
                                if ($page === $pagesCount) {
                                    echo 1;
                                } else {
                                    echo $page + 1;
                                }
                                echo "' aria-label='Next'>";
                                echo "<span aria-hidden='true'>&raquo;</span></a></li>";
                            }
                        }
                    ?>
                </ul>
            <?php
                }
            ?>

            <a class="btn btn-success" href="/task/create" role="button">Добавить задачу</a>
        </div>
    </main>

</body>
</html>