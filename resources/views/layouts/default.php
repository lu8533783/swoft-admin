<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Demo for layout</title>
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/site.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href="/css/AdminLTE.css" rel="stylesheet">
        <link href="/css/skins/_all-skins.css" rel="stylesheet">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php $this->include('layouts/default/header') ?>

        <?php $this->include('layouts/default/left', ['menu' => $menu]) ?>

        <?php $this->include('layouts/default/content') ?>

    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.pjax.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/adminlte.js"></script>
    </body>
</html>
