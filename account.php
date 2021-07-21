<?php
ob_start();
include 'includes/header.php';
include 'includes/func.php';

$user = getUser($_SESSION['user_id'], $conn);
if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['name'])) {
    $error=[];
    
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}   
    
    $userid = $_SESSION['user_id'];
    $oldusername = $_SESSION['user_name'];
    $oldname = $_SESSION['name'];
    
    $username = validate($_POST['username']);
	$name = validate($_POST['name']);

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
                header("Location: create.php?error=Your file is too fat, just like me");
                exit();
            }
        }
        else{
            header("Location: create.php?error=Error uploading file");
            exit();
            }
        }
        else{
            $error['idk'] = "error";
        }

    if(empty($username)){
        header("Location: account.php?error=User Name is empty");
	    exit();
	}
	elseif(empty($name)) {
		header("Location: account.php?error=Name is empty");
	    exit();
	}
	else if($username == $oldusername){
        header("Location: account.php?error=That is your old username bro");
	    exit();
	}else if ($name == $oldname){
        header("Location: account.php?error=That is your old name bro");
	    exit();
    }else if(!empty($error['idk'])){
        header("Location: account.php?error=Image is empty or you upload something other than image");
        exit();
    }

	else{
        $sql = "SELECT * FROM users WHERE user_name='$username'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		 	header("Location: account.php?error=Username Is Taken");
	        exit();
		}else {
        $sql = "UPDATE users SET user_name = ?, name = ?, profileimg = ? WHERE users.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $name, $filenalDestination, $userid);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
            $_SESSION['user_name'] = $username; 
            $_SESSION['name'] = $name; 
            $account_id = $stmt->insert_id;
            $location = "account.php?id=$account_id&new=true";
            header("Location: $location");
            exit();
        }
	}
}
}
 ?>
<div class="container">
    <?php if (isset($_GET['new']) && $_GET['new'] == 'true'): ?>
    <p class="success text-center" style="color: red;">Account changes successfully</p>
</div>
<?php endif; ?>
<h4 class="display-4 text-center" style="padding-top: 1%; margin: 0;">Customize Your Profile</h4>
<hr>
<div class="row"
    style="background-image: url('../images/accountImage.jpg'); background-repeat:no-repeat; background-position: center center; width: 100%;">
    <div class="col-md-6 offset-md-0" style="background-color: grey;">

        <form action="account.php" method="POST" enctype="multipart/form-data" class="text-center">

            <img src="<?php echo $user['profileimg'];?>" alt="" srcset=""
                style="vertical-align: middle; width: 100px; height: 100px; border-radius: 30%;">

            <?php if (isset($_GET['error'])) {?>

            <div class=" rs2-wrap-input100 m-b-20">
                <p class="error text-center" style="color: red;"><?php echo $_GET['error'];?></p>
            </div>
            <?php }?>

            <label for="username" style="color: black; font-size: 20px;">Change User
                Name <br>(current username:<?php echo $user['user_name'];?>)</label>
            <input type="text" name="username" class="form-control" id="" value="">
            <br>
            <label for="name" style="color: black; font-size: 20px;">Change
                Name <br>(current name:<?php echo $user['name'];?>)</label>
            <input type="text" name="name" class="form-control" id="" value="">

            <br>
            <label for="proimg" style="color: black; font-size: 20px;">Update Profile
                Image</label>
            <input type="file" name="proimg" class="form-control" id="" value="">

            <br>
            <br>

            <button type="submit" name="submit" class="form-control btn btn-primary"> <i class="fa fa-plus"></i>
                Apply Changes </button>
        </form>
    </div>
</div>
</div>
<?php
    include './includes/footer.php';
?>