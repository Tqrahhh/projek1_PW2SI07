<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Games.php';

    $database = new Database();
    $db = $database->dbConnection();

    $game = new Games($db);

    if(isset($_POST['tambah'])){
        $game->name = $_POST['nama']; 
        $game->platform = $_POST['platform'];

        if($game->store()) {
            header("Location: index.php"); 
            exit;
        } else {
            echo "Gagal menambahkan game."; 
        }
} 

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="UTF-8">
        <title>Tambah Game</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
            form {
                max-width: 500px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            label {
                font-weight: bold;
            }
            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
            }

        </style>

    </head>

    <body>
        <div class="container">
            <h1>Tambah Game</h1>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama">Nama Game:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="platform">Platform:</label>
                    <input type="text" name="platform" class="form-control" required>
                </div>
                <input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
            </form>
        </div>
    </body>

</html>
