<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Users.php';

    $database = new Database();
    $db = $database->dbConnection();

    $user = new Users($db);

    if(isset($_POST['tambah'])){
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->balance = $_POST['balance'];

        $user->store(); 
        header("Location: index.php");
        exit;
    } 

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Tambah User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                padding: 20px;
            }
            h1 {
                text-align: center;
                margin-bottom: 30px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .form-label {
                font-weight: bold;
            }
            .form-control {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .btn-primary {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>

    </head>

    <body>

        <div class="container">
            <h1>Tambah User</h1>
            <form method="POST" action="">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" required>
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" required>
                <label for="password" class="form-label">Password:</label>
                <input type="text" class="form-control" name="password" required>
                <label for="balance" class="form-label">Balance:</label>
                <input type="text" class="form-control" name="balance" required>
                <input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
            </form>
        </div>

    </body>

</html>
