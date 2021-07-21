<?php
       ob_start();
        include 'includes/header.php';        
        if (isset($_POST['uname']) && isset($_POST['password'])) {
            function validate($data){
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
            }
        
            $uname = validate($_POST['uname']);
            $pass = validate($_POST['password']);
        
            if (empty($uname)) {
                header("Location: login.php?error=User Name is required");
                exit();
            }else if(empty($pass)){
                header("Location: login.php?error=Password is required");
                exit();
            }else{
                // hashing the password
                $pass = md5($pass);
                $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['user_name'] === $uname && $row['password'] === $pass) {
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['loggedin'] = true;
                        header("Location: index.php");
                        exit();
                    }else{
                        header("Location: login.php?error=Incorect User name or password");
                        exit();
                    }
                }else{
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            }
            
        }
?>

<div class="limiter">
<?php if (isset($_GET['success'])) { ?>
        <p class="success text-center" style="color: blue;"><?php echo $_GET['success']; ?></p>
        <?php } ?>
    <div class="container-login100">
        
        <div class="wrap-login100">
            
            <form class="login100-form validate-form" method="POST">
                
                <span class="login100-form-title p-b-34">
                    Account Login
                </span>


                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                    <input id="first-name" class="input100" type="text" name="uname" placeholder="User name">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>

                <?php if (isset($_GET['error'])) {?>
                <div class=" rs2-wrap-input100 m-b-20">
                    <p class="error text-center" style="color: red;"><?php echo $_GET['error']; ?></p>
                </div>
                <?php }?>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Sign in
                    </button>
                </div>

                <div class="w-full text-center p-b-239">

                </div>

                <div class="w-full text-center">
                    <a href="./signup.php" class="txt3">
                        Sign Up
                    </a>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('../images/bg-01.jpg');"></div>
        </div>
    </div>
</div>

<?php 
     include './includes/footer.php';  
?>