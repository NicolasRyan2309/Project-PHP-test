<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header ("location: login.php");
exit;
}


require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
// $conn = mysqli_connect("localhost", "root", "", "phpdasar");

// $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
// var_dump($result);
// if (!$result) {
//     # code...
//     echo mysqli_error($conn);
// }
// test data keluar atau tidak
// while($mhs = mysqli_fetch_assoc($result)){
// var_dump($mhs["nama"]);
// }

if( isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php"> Tambah data</a>

    <form action="" method="post">
        <input type="text" name="keyword" id="" size="30" autofocus placeholder="Keyword" autocomplete="off">
        <button type="submit" name="cari">Search</button>
    </form>

    <table border="1" cellpadding = "10" cellspacing="0">
        <tr>
            <th>No </th>
            <th>Aksi </th>
            <th>Gambar </th>
            <th>NRP </th>
            <th>Nama </th>
            <th>Email </th>
            <th>Jurusan </th>
        </tr>
        <?php
        $i = 1;
        ?>
        <?php
        foreach($mahasiswa as $row):
        ?>
        <tr>
            <td>
                <?=
                $i
                ?>
            </td>
            <td>
                <a href="ubah.php?id=
                <?= $row["id"];?>
                ">Ubah</a>
                <a href="hapus.php?id=
                <?= $row["id"];?>"
                onclick="return confirm('yakin?')"; >Hapus</a>
            </td>
            <td>
                <img src="img/<?= $row["gambar"];
                    ?>" alt="ayaka" width="50">
            </td>
            <td><?=
            $row["nrp"];
            ?></td>
            <td><?=
            $row["nama"];
            ?></td>
            <td><?=
            $row["email"]
            ?></td>
            <td><?=
            $row["jurusan"]
            ?></td>
        </tr>
        <?php
        $i++;
        ?>
        <?php
        endforeach;   
        ?>
    </table>
</body>
</html>
