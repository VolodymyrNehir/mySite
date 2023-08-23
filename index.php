<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php require './view/modelWindows/modelWindow.php' ?>
<?php require './view/modelWindows/modelWindowDelete.php' ?>
<?php require './view/modelWindows/modelWindowConfirm.php' ?>

<div class="wrapper"
    <div class="conteiner">
        <strong>Users</strong>
        <?php require 'View/select.php' ?>

        <table class="tableUsers">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll" form="select"></th>
                <th>Name</th>
                <th>Role</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php require 'View/selectUsers.php' ?>

            </tbody>
        </table>
        <?php require 'View/select.php' ?>
    </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>



<script src="JavaScript/addendUpUsers.js"></script>
<script src="JavaScript/check.js"></script>
<script src="JavaScript/deleteUsers.js"></script>
<script src="JavaScript/reset.js"></script>
<script src="JavaScript/select.js"></script>
</body>
</html>