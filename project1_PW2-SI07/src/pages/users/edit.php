<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Users.php';

    $database = new Database();
    $db = $database->dbConnection();

    $user = new Users($db);

    if(isset($_POST['update'])) {
        
        $user->id = $_POST['id'];
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->balance = $_POST['balance'];

        if($user->update()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal mengedit user.";
            
        }
    } elseif(isset($_GET['id'])) {
        
        $user->id = $_GET['id'];
        $stmt = $user->edit();
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
                input[type="text"], input[type="password"] {
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
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" value="<?php echo $password; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="balance" class="form-label">Balance:</label>
                    <input type="text" name="balance" value="<?php echo $balance; ?>" class="form-control" required>
                </div>
                <input type="submit" name="update" value="Update" class="btn btn-primary">
            </form>

        </body>

        </html>

        <?php
    } else {
        echo "Gagal mengedit user: Pengguna tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

?>
