<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow" />
    <title>LOGIN</title>
    <link href="assets/css/yeti-bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Silahkan masuk</h3>
                </div>
                <div class="panel-body">
                    <form class="form-signin" action="?act=login" method="post">
                        <?php if ($_POST) include 'aksi.php' ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="user" autofocus />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="pass" />
                        </div>
                        <button class="btn btn btn-primary btn-block" type="submit">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.form-control').attr('autocomplete', 'off');
    </script>
</body>

</html>