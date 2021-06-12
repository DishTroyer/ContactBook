<!DOCTYPE html>
<?php
session_start();
require 'C:/xampp/htdocs/newContactBook/dbConfig/config.php';
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-In</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
<form action="index.php" method="post">
  <div class="bg-gradient-to-b from-purple-200 via-indigo-400 to-indigo-600 ...">
    <div class="min-h-screen text-gray-800 antialiased px-4 py-6 flex flex-col justify-center sm:py-12">
      <div class="relative py-3 sm:max-w-xl mx-auto text-center">
        <span class="filter drop-shadow-md text-3xl font-normal text-white">Login to your account</span>
        <div class="relative mt-4 bg-white shadow-md sm:rounded-lg text-left">
          <div class="h-2 bg-indigo-400 rounded-t-md"></div>
          <div class="py-6 px-8">
            <label class="block font-semibold">Username<label>
            <input type="text" name="username" placeholder="Enter Username" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
            <label class="block mt-3 font-semibold">Password<label>
            <input type="password" name="password" placeholder="Enter Password" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
            <div class="flex justify-between items-baseline">
              <a href="register.php" class="text-sm hover:underline">New User? Signup</a>
              <button type="submit" name="login" value="login" class="filter drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Login</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
  <?php
        if(isset($_POST['login']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query="select * from userdata WHERE username='$username' AND password='$password'";

            $query_run = mysqli_query($con,$query);
            if(mysqli_num_rows($query_run)>0)
            {

                //valid
                $_SESSION['username']= $username;
                header('location:homepage.php');
            }
            else
            {
                //invalid
                echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
            }
        }
        ?>
        <script src="" async defer></script>
  

</body>
</html>