<?php
$conn = mysqli_connect("localhost", "root", "", "mychicken");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//add
function tambah($data){
    global $conn;

    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $gambar = upload();
    if(!$gambar){
        return false;
    }
    
    $query = "INSERT INTO mahasiswa VALUES('', '$nrp', '$nama', '$email', '$jurusan' ,'$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//upload
function upload(){
    // return false;
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if($error === 4){
        echo "
        <script>
            alert('please upload picture');
        </script>
        ";
        return false;
    }

    //validasi extensi
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar)); 

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
        <script>
            alert('Extension is not valid');
        </script>
        ";
        return false;
    }

    //validasi ukuran
    if($ukuranFile>10000000000000000000000000000000000000000000000000000000000000000000000){
        echo "
        <script>
            alert('Size is not valid');
        </script>
        ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//edit
function ubah($data){
    global $conn;

    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek jika upload gambar

    if($_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }
    
    $query = "UPDATE mahasiswa SET
                                nrp = '$nrp',
                                nama = '$nama',
                                email = '$email',
                                jurusan = '$jurusan',
                                gambar = '$gambar'
                                WHERE id = $id
                                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//search
function cari($keyword){
    $query = "SELECT * FROM mahasiswa 
                WHERE nama LIKE '%$keyword%' OR 
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'";
            return query($query);
}

//registrasi
function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"])) ;
    $password = mysqli_real_escape_string($conn ,$data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
    //cek username ada atau tidak
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('username taken');
            </script>
        ";
        return false;
    }

    //cek password sama
    if($password != $password2){
        echo "
            <script>
                alert('Password unmatch');
            </script>
        ";
        return false;
    }
    // return 1;

    //ecripsi
    $password = password_hash($password, PASSWORD_BCRYPT);  
    // var_dump($password); die;
    mysqli_query($conn, "INSERT INTO user 
                    VALUES('', '$username', '$password');
                ");
    return mysqli_affected_rows($conn);

}

?>