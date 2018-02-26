<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $title; ?> </title>
    <?= $this->Html->css('template_style.css') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script>
        $(function () {
            $(function () {
                var pull = $('#pull');
                menu = $('nav ul');
                menuHeight = menu.height();

                $(pull).on('click', function (e) {
                    e.preventDefault();
                    menu.slideToggle();
                });
            });

            $(window).resize(function () {
                var w = $(window).width();
                if (w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        });


    </script>

</head>
<body class="bgr-silver">
<div id="wrapper">
    <div id="banner">
        <img src="http://localhost/hello_cakephp/img/website/banner.jpg">
    </div>

    <?php
    if (!isset($_SESSION['name'])) {
        $nav_plus = '<ul class="nav navbar-nav navbar-right" id="ul-frontend">
        <li><a href="http://localhost/hello_cakephp/frontend/sign-up"><span class="glyphicon glyphicon-frontend"></span> Sign Up</a></li>
        <li><a href="http://localhost/hello_cakephp/frontend/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>';
    } else {
        $nav_plus = '<ul class="nav navbar-nav navbar-right padding-br-20">
        <span class="span-hi">Hi ' . $_SESSION['name'] . ' </span>
        <a href="http://localhost/CoffeWebsite/profileController.php?user_id=' . $_SESSION['id'] . '">
                            <span class="glyphicon glyphicon-frontend span-frontend"title="profile" aria-hidden="true">
                            </span>
        </a>
        <span class="glyphicon glyphicon-log-out span-log-out" id="btn-log-out" title="Log out" aria-hidden="true"></span>
    </ul>';
    };
    ?>

    <nav id="navigation" class="navbar navbar-inverse navi">
        <div class="container-fluid media">
            <div class="navbar-header">
                <img src="http://localhost/hello_cakephp/img/website/logo.png">
            </div>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/hello_cakephp/frontend" class="font-size18">Home</a></li>
                <li><a href="#" class="font-size18">About</a></li>
                <li><a href="#" class="font-size18">Contact</a></li>
                <li><a href="#" class="font-size18">Help</a></li>
            </ul>
            <?php
            echo $nav_plus;
            ?>
        </div>
    </nav>


    <div>
        <?= $this->fetch('content') ?>
    </div>

    <div class="modal fade bs-example-modal-sm" id="modal-loading" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm text-center" role="document">
            <i class="fa fa-spinner fa-spin spinn"></i>
        </div>
    </div>

    <footer class="margin-top30">
        <div>
            <p>Copyright &copy; 2017 Localhost.Admin</p>
        </div>
    </footer>
</div>

</body>
</html>