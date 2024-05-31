<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Transactions.php';

    $database = new Database();
    $db = $database->dbConnection();

    $transaction = new Transactions($db);

    if(isset($_POST['tambah'])){
        $transaction->user_id = $_POST['user_id'];
        $transaction->game_id = $_POST['game_id'];
        $transaction->amount = $_POST['amount'];
        $transaction->transaction_date = !empty($_POST['transaction_date']) ? $_POST['transaction_date'] : date("Y-m-d H:i:s"); // Set default value if not provided

        if($transaction->store()) { 
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal menambahkan transaksi.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Tambah Transaksi</title>
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
        
        <h1>Tambahkan Transaksi</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID:</label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="game_id" class="form-label">Game ID:</label>
                <input type="text" name="game_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="text" name="amount" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="transaction_date" class="form-label">Transaction Date:</label>
                <input type="text" name="transaction_date" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control" required>
            </div>
            <input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
        </form>

    </body>
</html>
