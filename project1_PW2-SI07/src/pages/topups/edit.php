<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Topups.php';

    $database = new Database();
    $db = $database->dbConnection();

    $topup = new Topups($db);

    if(isset($_POST['update'])) {
        
        $topup->id = $_POST['id'];
        $topup->user_id = $_POST['user_id'];
        $topup->game_id = $_POST['game_id'];
        $topup->amount = $_POST['amount'];
        $topup->topup_date = $_POST['topup_date'];

        if($topup->update()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal mengedit topup.";
        }
    } elseif(isset($_GET['id'])) {

        $topup->id = $_GET['id'];
        $stmt = $topup->edit();
        $num = $stmt->rowCount();

        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Edit Topup</title>
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

        <h1>Edit Topup</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" value="<?php echo $user_id; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="game_id">Game ID:</label>
                <input type="text" name="game_id" value="<?php echo $game_id; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="topup_date">Topup Date:</label>
                <input type="text" name="topup_date" value="<?php echo $topup_date; ?>" class="form-control" required>
            </div>
            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </form>

    </body>

</html>

<?php
        } else {
            echo "Gagal mengedit topup: Pengguna tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID tidak ditemukan.";
        exit;
    }
?>
