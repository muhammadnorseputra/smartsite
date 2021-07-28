<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>404 Page Not Found</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/plugins/bootstrap/css/bootstrap.css'; ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/plugins/node-waves/waves.css'; ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/css/style.css'; ?>" rel="stylesheet">
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message"><?= $message != '' ? $message : ''; ?></div>
        <p>Link yang kamu akses tidak dapat ditemukan, coba periksa penulisan URL dengan benar.</p>
        <div class="button-place">
            <a href="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'] ?>" style="border-radius: 25px; padding: 15px 40px;" class="btn btn-info btn-lg waves-effect"> Go to homepage</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/plugins/jquery/jquery.min.js'; ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/plugins/bootstrap/js/bootstrap.js'; ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/plugins/node-waves/waves.js'; ?>"></script>
</body>

</html>