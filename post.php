<?php
ob_start();
include './includes/header.php';
include './includes/func.php';

if(isset($_GET['id'])) {

    $post = getPost($_GET['id'], $conn);
    $theid = $_GET['id'];
    $comments = new Comment($theid, $conn);
    $comments->getComments();
    if(isset($_POST['submit'])){
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    
    $comments->createComment($message, $user_id);
    }
  }
?>

<body class="is-preload">
    <?php if (isset($_GET['new']) && $_GET['new'] == 'true'): ?>
    <p class="success text-center" style="color: red;">New post added successfully</p>
    </div>
    <?php endif; ?>
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main" class="alt">

            <!-- One -->
            <section id="one">
                <div class="inner">
                    <header class="major">
                        <h1><?php echo $post['title'];?></h1>

                        <h4><i class="fa fa-user"></i><?php echo $post['name'];?> &nbsp;&nbsp;&nbsp;&nbsp; <i
                                class="fa fa-calendar"></i>
                            <?php echo $post['date_created'];?> &nbsp;&nbsp;&nbsp;&nbsp;
                    </header>
                    <span class="image main"><img class="display-1" src=<?php echo $post['image'];?> width="1920"
                            height="500"></span>
                    <p><?php echo $post['content'];?></p>
                </div>
            </section>

        </div>

        <section id="contact">
            <div class="inner">
                <?php if ($_SESSION['loggedin'] == false):?>
                <div class="text-center">
                    <h2 class="display-5">Please Login to Comment!</h2>
                    <p>Create an account or login to comment on the blog.</p>
                    <button type="button" class="btn btn-block btn-outline-primary"><a href="login.php"><i
                                class="fas fa-sign-in-alt"></i> Create Account/Login</a> </button>
                </div>
                <?php else:?>
                <section>
                    <header class="major">
                        <h2>Leave a Comment</h2>
                    </header>

                    <form method="post" action="">
                        <div class="fields">
                            <div class="field">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" rows="6" required
                                    placeholder="You spam and I spam your mom"></textarea>
                            </div>

                            <div class="field">
                                <button type="submit" name="submit" class="primary">Add Comment</button>
                            </div>
                        </div>

                    </form>
                </section>
                <?php endif;?>
                <section class="split">
                    <?php 
                foreach($comments->comments as $comment){
                    echo "
                    <section>
                    <div class='text-center'>
                    <img src='{$comment['profileimg']}' class='rounded-circle' width='100' height='100' style = 'float:left; display:inline; padding-right: 10px;'><span>{$comment['date_created']}</span>
                    <h4 style = 'color: red;'>{$comment['user_name']}</h4> 
                    <h5>{$comment['message']}</h5>
                    </div>
                    </section>";
                }
                ?>
                </section>
            </div>
        </section>

        <?php 
include './includes/footer.php';  
?>