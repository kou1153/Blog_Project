<?php 
ob_start();
    include 'includes/header.php';
    if (isset($_POST['submit']) && isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {
    $error=[];

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    $name = validate($_POST['name']);

	$uname = validate($_POST['uname']);

	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	
    $file = $_FILES['proimg'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1000000){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $filenalDestination = './profilePics/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $filenalDestination);
                }
                else{
                    header("Location: signup.php?error=Your file is too fat, just like me");
                    exit();
                }
            }
            else{
                header("Location: signup.php?error=Error uploading file");
                exit();
            }
        }
        else{
                $error['idk'] = "error";
        }

    if(empty($name)){
        header("Location: signup.php?error=Name is empty");
	    exit();
	}
	elseif(empty($uname)) {
		header("Location: signup.php?error=Username is empty");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is empty");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=ConfirmPassword is empty");
	    exit();
	}
	else if($pass !== $re_pass){
        header("Location: signup.php?error=Password!=Confirmpassword");
	    exit();
	}
    else if(!empty($error['idk'])){
        header("Location: signup.php?error=Image is empty or you upload something other than image");
	    exit();
	}
	else{

		// hashing the password
        $pass = md5($pass);
	    $sql = "SELECT * FROM users WHERE user_name='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		 	header("Location: signup.php?error=Username Is Taken");
	         exit();
		}else {
            $sql2 = "INSERT INTO users(user_name, password, name, profileimg) VALUES('$uname', '$pass', '$name', '$filenalDestination')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
           	 header("Location: login.php?success=Account Created Successfully");
	         exit();
            }
		 }
	}
	
}
?>

<!-- main -->
<div class="background-image">
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form action="signup.php" method="POST" enctype="multipart/form-data">

                        <?php if (isset($_GET['error'])) { ?>
                        <p class="error" style="color:red;"><?php echo $_GET['error']; ?></p>
                        <?php } ?>

                        <div class="input-group">
                            <label></label>
                            <?php if (isset($_GET['name'])) { ?>
                            <input class="input--style-3" type="text" name="name" placeholder="Name"
                                value="<?php echo $_GET['name']; ?>"><br>
                            <?php }else{ ?>
                            <input class="input--style-3" type="text" name="name" placeholder="Name"><br>
                            <?php }?>
                        </div>

                        <div class="input-group">
                            <label></label>
                            <?php if (isset($_GET['uname'])) { ?>
                            <input class="input--style-3" type="text" name="uname" placeholder="User Name"
                                value="<?php echo $_GET['uname']; ?>"><br>
                            <?php }else{ ?>
                            <input class="input--style-3" type="text" name="uname" placeholder="User Name"><br>
                            <?php }?>
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Confirm Password"
                                name="re_password">
                        </div>
                        <div class="input-group">
                            <input type="file" name="proimg" placeholder="Profile Image" class="input--style-3" id="" value="">
                        </div>
                        <div class="p-t-10 text-center">
                            <button class="btn btn--pill btn--green" name="submit" type="submit">Submit</button> <br> <br>
                            <a href="./login.php" class="btn btn--pill">
                                Already have an account?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
     include './includes/footer.php';  
?>
