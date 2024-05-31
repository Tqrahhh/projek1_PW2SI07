<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Games.php';

    $database = new Database();
    $db = $database->dbConnection();

    $game = new Games($db);

    if(isset($_GET['id'])){
        $game->id = $_GET['id'];

        if($game->delete()){
            header("Location: index.php");
            exit; 
        }else{
            $error_message = "Gagal menghapus game."; 
        }
    }

    $data = $game->index();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Games</title>
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
            table {
                width: 100%;
                border-collapse: collapse;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            th, td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #dee2e6;
            }
            th {
                background-color: #007bff;
                color: #fff;
                font-weight: bold;
            }
            tbody tr:hover {
                background-color: #f0f0f0;
            }
            .btn {
                padding: 6px 12px;
                font-size: 14px;
                border-radius: 4px;
            }
            .btn-danger {
                background-color: #dc3545;
                color: #fff;
                border: none;
            }
            .btn-danger:hover {
                background-color: #c82333;
            }

        </style>

    </head>

    <body>

        <div class="container">
            <h1>Games</h1>
            <a class="btn btn-primary mb-3" href="create.php">Tambah</a>
            <?php if(isset($error_message)) { ?> 
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Game</th>
                        <th>Platform</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['platform']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus game ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>

</html>
