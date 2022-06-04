<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header ("location: login.php");
exit;
}

require 'functions.php';
if(isset($_POST["submit"])){
    // var_dump($_POST); var_dump($_FILES); die;
    if(tambah($_POST) > 0){
        echo "
        <script>
            alert('data success');
            document.location.href = 'index.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('data error');
            document.location.href = 'tambah.php';
        </script>
        ";
        echo "<br>";
        echo mysqli_error($conn);
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
</head>
<body>
    <h1> Tambah Data </h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Return</a>
</body>
</html>