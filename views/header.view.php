<?php
    require_once INCLUDE_DIR . '/dbh.inc.php';
    require_once FUNCTIONS_DIR . '/functions.func.php';
    if (isset($_GET['error']) || isset($_GET['notify'])) {
        include_once INCLUDE_DIR . '/msghandler.inc.php';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/static/js/main.js"></script>
    <link href="/static/css/main.css" rel="stylesheet">
    <title>CMS101</title>
</head>
<body>
    <div id="main-container">