<?php

    require_once '../../../config/Database.php';
    require_once '../../../app/Users.php';

    $database = new Database();
    $db = $database->dbConnection();

    $user = new Users($db);

    if(isset($_GET['id'])){
        $user->id = $_GET['id'];

        if($user->delete()){
            header("Location: index.php");
        }else{
            echo "Gagal menghapus user.";
        }
}

    $data = $user->index();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="UTF-8">
        <title>User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>

        <div class="container mt-4">
            <h1 class="text-center mb-4">User</h1>
            <a href="create.php" class="btn btn-success">Tambah</a>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data as $row) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>

</html>
