<?php
    session_start();
    require 'C:/xampp/htdocs/newContactBook/dbConfig/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
        <form action="register.php" method="post">
            <div class="bg-gradient-to-b from-purple-200 via-indigo-400 to-indigo-600 ...">
                <div class="min-h-screen text-gray-800 antialiased px-4 py-6 flex flex-col justify-center sm:py-12">
                <div class="relative py-3 sm:max-w-xl mx-auto text-center">
                    <span class="filter drop-shadow-md text-3xl font-normal text-white">Register yourself here</span>
                    <div class="relative mt-4 bg-white shadow-md sm:rounded-lg text-left">
                    <div class="h-2 bg-indigo-400 rounded-t-md"></div>
                    <div class="py-6 px-8">
                        <label class="block font-semibold">Username<label>
                        <input type="text" name="username" placeholder="Enter Username" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                        <label class="block mt-3 font-semibold">Password<label>
                        <input type="password" name="password" placeholder="Enter Password" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                        <label class="block mt-3 font-semibold">Confirm your Password<label>
                        <input type="password" name="cpassword" placeholder="Enter Password" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                        <div class="flex justify-between items-baseline">
                        <a href="index.php" class="text-sm hover:underline">Go to Log-in</a>
                        <button type="submit" name="register" value="register" class="filter drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Register</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['register']))
            {
                //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';

                $username = $_POST['username'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];

                if($password==$cpassword)
                {
                    $query= "select * from userdata WHERE username='$username'";
                    $query_run = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run)>0)
                    {
                        //there is already a user with the same username
                        echo '<script type="text/javascript"> alert("User already exists... try another username") </script>';
                    }
                    else
                    {

                        $query= "insert into userdata values('$username','$password')";
                        $query_run = mysqli_query($con,$query);
                        if($query_run)
                        {
                            echo '<script type="text/javascript"> alert("User Registered...Go to Login Page to Login") </script>';

                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Error!") </script>';
                        }
                    }

                }
                else
                {
                    echo '<script type="text/javascript"> alert("Password and Confirm Password does not match") </script>';
                }
            }
        ?>
</body>
</html>