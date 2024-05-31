<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Transactions.php';

    $database = new Database();
    $db = $database->dbConnection();

    $transaction = new Transactions($db);

    if(isset($_POST['update'])) {
        
        $transaction->id = $_POST['id'];
        $transaction->user_id = $_POST['user_id'];
        $transaction->game_id = $_POST['game_id'];
        $transaction->amount = $_POST['amount'];
        $transaction->transaction_date = $_POST['transaction_date'];

        if($transaction->update()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal mengedit transaction.";
        
        }
    } elseif(isset($_GET['id'])) {

        $transaction->id = $_GET['id'];
        $stmt = $transaction->edit();
        $num = $stmt->rowCount();

        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row); 

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">
            <title>Edit User</title>
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

            <h1>Edit User</h1>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="game_id" class="form-label">Game ID:</label>
                    <input type="text" name="game_id" value="<?php echo $game_id; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="transaction_date" class="form-label">Transaction Date:</label>
                    <input type="text" name="transaction_date" value="<?php echo $transaction_date; ?>" class="form-control" required>
                </div>
                <input type="submit" name="update" value="Update" class="btn btn-primary">
            </form>

        </body>

        </html>

<?php
    } else {
        echo "Gagal mengedit transaction: Pengguna tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
