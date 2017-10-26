<?php
// Start the session
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PetCare</title>
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./vendor/css/style.css">
    <link rel="stylesheet" type="text/css" href="./vendor/css/new-task-styling.css">
    <link rel="stylesheet" href="./vendor/css/bootstrap-datetimepicker.min.css">

    <script src="./vendor/js/jquery-3.2.0.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/js/jquery.ns-autogrow.min.js"></script>
    <script src="./vendor/js/bootstrap-datetimepicker.min.js"></script>
    <script src="./vendor/js/find-task.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#successmodal").modal('show');
        });
    </script>
</head>
<body>
<?php include "config/db-connection.php"; ?>
<nav class="navbar navbar-inverse navigation-bar navbar-fixed-top">
    <div class="container navbar-container">
        <div class="navbar-header pull-left"><a class="navbar-brand" href="userprofile.php"> PetCare</a></div>
        <div class="nav navbar-nav navbar-form">
            <div class="input-icon">
                <i class="glyphicon glyphicon-search search"></i>
                <input type="text" placeholder="Type to search..." class="form-control search-form" tabindex="1">
            </div>
        </div>
        <div class="collapse navbar-collapse pull-right">
            <ul class="nav navbar-nav">
                <li><a href="request.php"> Send Request </a></li>
                <li><a href="history.php"> View History </a></li>
                <li><a href="logout.php"> Log Out </a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content-container container">
    <div class="container">
        <h2></h2>
