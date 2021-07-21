<?php
ob_start();
include './includes/header.php';
    $sql = "SELECT * FROM posts, users WHERE posts.user_id = users.id";
    $results = $conn->query($sql);
    $row = $results->fetch_all(MYSQLI_ASSOC);

?>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Banner -->
        <section id="banner" class="major">
            <div class="inner text-center">
                <header class="major">
                    <h1 class="text-center">A blog</h1>
                </header>
                <div class="content">
                    <p>"Darker than black, darker than darkness, combine with my intense crimson. Time to wake up, descend to these borders and appear as an intangible distortion. Dance, dance, dance! May a destructive force flood my torrent of power, a destructive force like no other! Send all creation to its source! Come out of your abyss! Humanity knows no other more powerful offensive technique! It is the ultimate magical attack! EXPLOSION!" - the number one mage of Axel!</p>
                    <ul class="actions">
                        <li><a href="https://steamcommunity.com/id/shortdick1153/" class="button">Contact me</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Blog Posts -->
        
        <section class='tiles'>
        <?php
        foreach($row as $post){
            echo"
                                <article style = 'background-image: url({$post['image']});'>
                                <span class='image'>
                                    
                                </span>
                                <header class='major'>
                                    <h3>{$post['title']}</h3>

                                    <p><br> <span>{$post['name']}</span> | <span>{$post['date_created']}</span></p>

                                    <div class='major-actions'>
                                        <a href='post.php?id={$post['post_id']}' class='button small'>Read Blog</a>
                                    </div>
                                </header>
                            </article>";
                        }
            ?>
            
        </section>
    </div>
    <?php 
     include './includes/footer.php';  
    ?>