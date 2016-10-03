<!DOCTYPE html>
    <html>
        <head>
            <?php

                require('database/classes.php');
                require('database/tags.php');
                $database = new Database();
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $database -> query('SELECT * FROM posts');
                $rows = $database->resultset();
//
//            $Tags = new Tags();
//            $Tags->query('SELECT * FROM posts');
//            $rows = $Tags->resultset();

            ?>
            <title>Gaming Blog</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <!--Stylesheet link -->
            <link rel="stylesheet" href="styles.css" type="text/css">
        </head>
        <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="index.php">Posts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="create_post.php">Create Post</a> </li>
            </ul>
        </nav>
        <?php
        foreach($rows as $row) {

            $datetime = strtotime($row['dates']);
            $mysqldate = date("M-d-y", $datetime);
            ?>
            <div class="wrapper">

                <div class="card radius shadowDepth1">


                    <div class="card__content card__padding">

                        <article class="card__article">
                            <p style="text-align: right"><?php echo $mysqldate;  ?></p>
                            <h2><?php echo $row['title']; ?></h2>

                            <p><?php echo $row['post']; ?></p>
                        </article>
                    </div>

                    <div class="card__action">

                        <div class="card__author">
                            <div class="card__author-content">
                                 <p>By: <?php echo $row['authors']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
           ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <nav class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container">

            </div>
        </nav>
        </body>

    </html>