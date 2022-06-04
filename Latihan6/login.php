 <?php
 session_start();
    require 'functions.php';

    if (isset($_POST["login"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username= '$username' ");
//cek username  
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION['login'] = true;
                header("Location: index.php");
                
            }
        }
        $error = true;
    }
    ?> 

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8"> 
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>

     <style>
         label {
             display: block;
         }
     </style>

 </head>

 <body>

     <?php
        if (isset($error)) : ?>
         <p style="color: red; font-style: italic;">username or password is wrong</p>
         <script>
             alert("USERNAME OR PASSWORD IS WRONG")
         </script>
     <?php
        endif;
        ?>

     <form action="" method="POST">

         <h1>Login</h1>
         <ul>
             <li>
                 <label for="username">Username</label>
                 <input type="text" name="username" id="username" placeholder="username" ></input>
             </li>
             <li>
                 <label for="password">Password</label>
                 <input type="password" name="password" id="password" placeholder="password"></input>
             </li>
             <li>
                 <button type="submit" name="login">Login</button>
             </li>
         </ul>

     </form>
 </body>

 </html>