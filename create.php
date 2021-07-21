<?php
ob_start();
include './includes/header.php';
if (isset($_POST['submit']) && isset($_POST['title'])
    && isset($_POST['content'])) {
        $error=[];
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
        
        $userid = validate($_SESSION['user_id']);
        $title = validate($_POST['title']);
        $content = validate($_POST['content']);

        $file = $_FILES['imgurl'];
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
                if($fileSize < 10000000){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $filenalDestination = './user_images/'.$fileNameNew;
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
        if(empty($title)){
            header("Location: create.php?error=Title is empty");
            exit();
        }
        else if(!empty($error['idk'])){
            header("Location: create.php?error=Image is empty or you upload something other than image");
            exit();
        }
        else if(empty($content)){
            header("Location: create.php?error=Content is empty");
            exit();
        }
        else{
            $sql = "INSERT INTO posts (user_id, title, image, content) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $userid, $title, $filenalDestination, $content);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $post_id = $stmt->insert_id;
                $location = "post.php?id=$post_id&new=true";
                header("Location: $location");
                exit();
            }
        }
}?>
<div class="container">
    <?php if ($_SESSION['loggedin'] == false):?>
    <div class="mt-5 col-md-6 offset-md-3 text-center">
        <h2 class="display-5">Please Login to Post!</h2>
        <p>Create an account or login to post to the website.</p>
        <button type="button" class="btn btn-block btn-outline-primary"><a href="login.php"><i
                    class="fas fa-sign-in-alt"></i> Create Account/Login</a> </button>
    </div>
    <?php else:?>
    <h4 class="display-4 text-center" style="padding-top: 1%; margin: 0;">Add Post</h4>
    <hr>
    <div class="row" style="background-image: url('images/createbackground.jpg'); background-repeat:no-repeat; background-position: center center; width: 100%;">
        <div class="col-md-6 offset-md-6 " style="background-color: grey;">
            <form action="create.php" method="POST" enctype="multipart/form-data" class="text-center">

                <?php if (isset($_GET['error'])) {?>
                <div class=" rs2-wrap-input100 m-b-20">
                    <p class="error text-center" style="color: red;"><?php echo $_GET['error'];?></p>
                </div>
                <?php }?>

                <label for="title" style="color: black; font-size: 20px;">Post Title</label>
                <input type="text" name="title" class="form-control" id="" value="" placeholder="Your post title" >

                <br>
                <label for="imgurl" style="color: black; font-size: 20px;">Image</label>
                <input type="file" name="imgurl" class="form-control" id="" value="">

                <br>
                
                <label for="content" style="color: black; font-size: 20px;">Write Something</label> <br>
                <textarea name="content" class="form-control" cols="30" rows="10">

                </textarea>

                <br>

                <button type="submit" name="submit" class="form-control btn btn-primary"> <i class="fa fa-plus"></i> Add
                    Post</button>
            </form>
        </div>
        <?php endif;?>
    </div>
</div>

<?php
include './includes/footer.php';
?>