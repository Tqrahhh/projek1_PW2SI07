<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Transactions.php'; 

    $database = new Database();
    $db = $database->dbConnection();

    $transaction = new Transactions($db); 

    if(isset($_GET['id'])){
        $transaction->id = $_GET['id']; 

        if($transaction->delete()){ 
            header("Location: index.php");
        }else{
            echo "Gagal menghapus transaction.";
        }
}

    $data = $transaction->index(); 

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Transaction</title>
        <!-- Bootstrap CSS -->
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
                margin-top: 20px;
            }
            .btn-space {
                margin-right: 10px;
            }
        </style>

    </head>

    <body>

        <div class="container">
            <h1>Transaction</h1>
            <div class="mb-3">
                <a href="create.php" class="btn btn-success btn-space">Tambah</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Game ID</th>
                        <th>Transaction Date</th>
                        <th>Amount</th>
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
                            <td><?php echo $row['transaction_date']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm btn-space">Edit</a>
                                <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaction ini?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>

</html>
