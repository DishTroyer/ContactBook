<?php
    ob_start();
    session_start();
    require 'C:/xampp/htdocs/newContactBook/dbConfig/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="styles.css">
</head>

<style>
  .model-open{
	overflow: hidden; 
    height: 100vh;
  }
</style>

<body>
        <form action="homepage.php" method="post">
            <div class="bg-gradient-to-b from-purple-200 via-indigo-400 to-indigo-600 ...">
                <div class= "min-h-screen text-gray-800 antialiased px-4 py-6 flex flex-col justify-center sm:py-12">
                <div class="relative py-3 sm:max-w-xl mx-auto text-center">
                    <span class="filter drop-shadow-md text-3xl font-normal text-white">Hi <?php echo $_SESSION['username'] ?> </span>
                    <div class="relative mt-4 bg-white shadow-md sm:rounded-lg text-left">
                    <div class="h-2 bg-indigo-400 rounded-t-md"></div>

                    <!-- Adding support fot Editing. will check for edit_contact, if set, populate with entries from SQL -->
                    <?php
                        if(isset($_GET['edit_contact'])) {
                            $name = $_GET['edit_contact'];
                            $tasks= mysqli_query($con,"SELECT * from contacts WHERE name='$name'");
                            $row = mysqli_fetch_array($tasks);
                            $address = $row['address'];
                            $phoneno = $row['phoneno'];
                            $email = $row['email'];
                            $isEdit = "yes";
                            mysqli_query($con, "DELETE FROM contacts WHERE name = '$name'");
                        }
                        else {
                            $name = "";
                            $address ="";
                            $phoneno = "";
                            $email ="";
                            $isEdit = "no";
                        }
                    ?>
                    
                    <input type="text" name="name" value= "<?php echo $name ?>" placeholder="Enter Contact Name" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                    <input type="text" name="address" value= "<?php echo $address ?>" placeholder="Enter Contact Address" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                    <input type="text" name="phoneno" value= "<?php echo $phoneno ?>" placeholder="Enter Contact No." class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                    <input type="email" name="email" value= "<?php echo $email ?>" placeholder="Enter Contact email" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                    <div class="flex-1 py-6 px-8">
                        <div class="flex justify-between items-baseline">
                        <a href="index.php" class="text-sm hover:underline">Go to Log-in</a>
                        <?php if($isEdit == "no") { ?>
                        <button type="submit" name="contact" value="contact" class="filter drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Add Contact</button>
                        <?php } else {?>
                        <button type="submit" name="edit" class="filter drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Save Edit</button>
                        <?php } ?>
                        </div>

                        <div class="grid gap-4 grid-cols-1">
                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg ">Contacts</div>
                        <!-- <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Address</div>
                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">PhoneNo</div>
                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Email</div>
                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Edit Action</div>
                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg">Delete Action</div> -->
                        
                        <?php 
                                // select all tasks if page is visited or refreshed
                                $username = $_SESSION['username'];
                                $tasks = mysqli_query($con, "SELECT * FROM contacts WHERE username='$username'");

                                $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                                        <!-- <div class="flex ..."> -->
                                        <div class="flex-1 drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg "><?php echo $row['name']; ?></div>
                                        <!-- <div class="flex-1 ..."><?php echo $row['name']; ?></div> -->
                                        <div class="flex-1 ...">
                                            <p class="inline-block font-bold ...">Address:</p>
                                            <p class="inline-block font-light..."><?php echo $row['address']; ?></p>
                                        </div>
                                        <div class="flex-1 ...">
                                            <p class="inline-block font-bold ...">Contact No:</p>
                                            <p class="inline-block font-light..."><?php echo $row['phoneno']; ?></p>
                                        </div>
                                        <div class="flex-1 ...">
                                            <p class="inline-block font-bold ...">Email:</p>
                                            <p class="inline-block font-light..."><?php echo $row['email']; ?></p>
                                        </div>
                                        <div class="flex-1 ...">
                                        <a  href="homepage.php?edit_contact=<?php echo $row['name'] ?>" class="inline-block drop-shadow-md mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg">Edit</a>
                                        <a  href="homepage.php?del_contact=<?php echo $row['name'] ?>" class="inline-block drop-shadow-md mt-4 bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-lg">Delete Contact</a>
                                        </div>
                                        <!-- </div> -->
                                <?php $i++; } ?>
                                
                        </div>
                        <!-- <label class="block font-semibold">Username<label>
                        <input type="text" name="username" placeholder="Enter Username" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                        <label class="block mt-3 font-semibold">Password<label>
                        <input type="password" name="password" placeholder="Enter Password" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required>
                        <label class="block mt-3 font-semibold">Confirm your Password<label>
                        <input type="password" name="cpassword" placeholder="Enter Password" class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md" required> -->
                        <!-- <button type="button" name="mo"  class="filter drop-shadow-md mt-4 bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded-lg" data-toggle="modal" data-target="#editModal">Modal</button> -->
                    </div>
                    </div>
                </div>
                </div>
            </div>

        <?php
            // echo $isEdit;
            function isValidEmail($email){ 
                return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
            }
            
            if(isset($_POST['contact']))
            {
                //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';

                $username = $_SESSION['username'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $phoneno = $_POST['phoneno'];
                $email = $_POST['email'];
                    // echo $buttonName;
                if( isValidEmail($email))
                {
                    $query= "select * from contacts WHERE name='$name'";
                    $query_run = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run)>0)
                    {
                        //there is already a user with the same username
                        echo '<script type="text/javascript"> alert("Contact already exists... try another username") </script>';
                    }
                    else
                    {   
                        $query= "INSERT INTO contacts (username,name,address,phoneno,email) VALUES('$username','$name','$address','$phoneno','$email')";
                        $query_run = mysqli_query($con,$query);
                        if($query_run)
                        {
                                            //to auto refresh the page
                                            header('Location: ./homepage.php');
                            // echo "<meta http-equiv='refresh' content='0'>";
                            // echo '<script type="text/javascript"> alert("Contact Added...") </script>';

                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Error!") </script>';
                        }
                    }

                }
                else
                {
                    echo '<script type="text/javascript"> alert("Please enter a valid email address") </script>';
                }

            }
            if(isset($_POST['edit']))
            {
                //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';

                $username = $_SESSION['username'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $phoneno = $_POST['phoneno'];
                $email = $_POST['email'];
                    // echo $buttonName;
                if( isValidEmail($email))
                {
                    $query= "select * from contacts WHERE name='$name'";
                    $query_run = mysqli_query($con,$query);
                    // if(mysqli_num_rows($query_run)>0 && !isset($_GET['edit_contact']))
                    // {
                    //     //there is already a user with the same username
                    //     echo '<script type="text/javascript"> alert("Contact already exists... try another username") </script>';
                    // }
                    // else

                       
                        // mysqli_query($con, "DELETE FROM contacts WHERE name = '$name'");
                        

                        $query= "INSERT INTO contacts (username,name,address,phoneno,email) VALUES('$username','$name','$address','$phoneno','$email')";
                        $query_run = mysqli_query($con,$query);
                        if($query_run)
                        {
                                            //to auto refresh the page
                                            header('Location: ./homepage.php');
                            // echo "<meta http-equiv='refresh' content='0'>";
                            // echo '<script type="text/javascript"> alert("Contact Added...") </script>';

                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Error!") </script>';
                        }
                    

                }
                else
                {
                    echo '<script type="text/javascript"> alert("Please enter a valid email address") </script>';
                }

            }

            if(isset($_GET['del_contact'])) {
                $name = $_GET['del_contact'];
                if(mysqli_query($con, "DELETE FROM contacts WHERE name = '$name'")) {
                                    //to auto refresh the page
                    header('Location: ./homepage.php');
                }
                // echo '<script type="text/javascript"> alert("Contact Deleted") </script>';
                // echo "<meta http-equiv='refresh' content='0'>";
            }

        ?>
</form>
</body>
</html>