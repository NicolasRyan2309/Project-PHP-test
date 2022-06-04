<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header ("location: login.php");
exit;
}
require 'functions.php';

$id = $_GET["id"];
// var_dump("$id");
$mhs = query("SELECT * FROM mahasiswa WHERE id= $id")[0];
// var_dump($mhs);

if(isset($_POST["submit"])){
    // var_dump($_POST);
    if(ubah($_POST) > 0){
        echo "
        <script>
            alert('data edited');
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
    <title>Ubah data</title>
</head>
<body>
    <h1> Ubah Data </h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?=$mhs["id"];?>">
        <input type="hidden" name="gambarLama" value="<?=$mhs["gambar"];?>">

        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required 
                value="<?=
                    $mhs["nrp"];
                ?>">
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required 
                value="<?=
                    $mhs["nama"];
                ?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" value="<?=
                    $mhs["email"];
                ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?=
                    $mhs["jurusan"];
                ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label> <br>
                <img src="img/<?= $mhs['gambar'] ; ?>" width="50px" alt=""><br>
                <input type="file" name="gambar" id="gambar";
                ?>
            </li>
            <li>
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html> 