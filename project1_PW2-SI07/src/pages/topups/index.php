<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Topups.php';

    $database = new Database();
    $db = $database->dbConnection();

    $topup = new Topups($db);

    if(isset($_GET['id'])){
        $topup->id = $_GET['id'];

        if($topup->delete()){
            header("Location: index.php");
        }else{
            echo "Gagal menghapus topup.";
        }
    }

    $data = $topup->index();

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Daftar Jenis topup</title>
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
            a {
                text-decoration: none;
                color: #007bff;
            }
            a:hover {
                color: #0056b3;
            }

        </style>

    </head>

    <body>

        <div class="container">
            <h1>Daftar Jenis topup</h1>
            <a href="create.php" class="btn btn-primary mb-3">Tambah</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Game ID</th>
                        <th>Amount</th>
                        <th>Topup Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['game_id']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['topup_date']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus topup ini?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>

</html>
