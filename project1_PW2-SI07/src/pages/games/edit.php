<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Games.php';

    $database = new Database();
    $db = $database->dbConnection();

    $game = new Games($db);

    if(isset($_POST['update'])) {
        
        $game->id = $_POST['id'];
        $game->name = $_POST['name'];
        $game->platform = $_POST['platform'];

        if($game->update()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal mengedit game.";
            
        }
    } elseif(isset($_GET['id'])) {
        
        $game->id = $_GET['id'];
        $stmt = $game->edit();
        $num = $stmt->rowCount();

        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row); 

        
?>

            <!DOCTYPE html>
            <html lang="en">

            <head>

                <meta charset="UTF-8">
                <title>Edit Game</title>
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

                <h1>Edit Game</h1>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="name">Nama Game:</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="platform">Platform:</label>
                        <input type="text" name="platform" value="<?php echo $platform; ?>" class="form-control" required>
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                </form>
            </body>
            </html>

        <?php
        
        } else {
            echo "Gagal mengedit game: Pengguna tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID tidak ditemukan.";
        exit;
    }
?>
