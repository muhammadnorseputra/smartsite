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
    <link href="<?= $_SERVER['HTTP_HOST'].'/assets/plugins/bootstrap/css/bootstrap.css'; ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= $_SERVER['HTTP_HOST'].'/assets/plugins/node-waves/waves.css'; ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= $_SERVER['HTTP_HOST'].'/assets/css/style.css'; ?>" rel="stylesheet">
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message"><?php echo $message; ?></div>
        <p>link yang kamu akses tidak dapat ditemukan, coba refresh browsermu dan jalankan kembali.</p>
        <div class="button-place">
            <a href="http://localhost/smartsite/" style="border-radius: 25px; padding: 15px 40px;" class="btn btn-info btn-lg waves-effect"> Go to homepage</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?= $_SERVER['HTTP_HOST'].'/assets/plugins/jquery/jquery.min.js'; ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= $_SERVER['HTTP_HOST'].'/assets/plugins/bootstrap/js/bootstrap.js'; ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= $_SERVER['HTTP_HOST'].'/assets/plugins/node-waves/waves.js'; ?>"></script>
</body>

</html>