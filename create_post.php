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
    if(@$_POST['tag_id']){
        $tag = $_POST['tag_search'];
        $database->query('SELECT * FROM post_tags WHERE tag = :tag_search');
        $database->bind(':tag_search', $tag);
        $database->execute();
    }

    if (@$_POST['submit']) {
        $title = $post['title'];
        $post = $post['post'];
        $author = $_POST['author'];
        if (!empty($title) && !empty($post) && !empty($author)) {
            $database->query('INSERT INTO posts (post, title, authors) VALUES(:post, :title, :author)');
            $database->bind(':title', $title);
            $database->bind(':post', $post);
            $database->bind(':author', $author);
            $database->execute();
            if ($database->lastInsertId()) {
                $message = $title . ' was added';
                echo "<script> var alert = alert($message);</script>";
                $tag = $_POST['tags'];
                $database->query('INSERT INTO tags (tag) VALUES (:tags)');
                $database->bind(':tags', $tag);
                $database->execute();
//                if($database->lastInsertId()){
//                    $post_id = $_POST['post_id'];
//                    $tag_id = $_POST['tag_id'];
//                    $database->query('INSERT INTO post_tags (posts_id, tags_id) VALUES (:post_id, tag_id)');
//                    $database->bind(':post_id', $post_id);
//                    $database->bind(':tag_id', $tag_id);
//                    $database->execute();
//                }
            }
        }
        else{
            echo '<p>Please fill in the blank information</p>';
        }
    }
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
<style>
    [type="submit"] {
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        width: 100%;
        background:#CC6666;
        border-radius:5px;
        border:0;
        cursor:pointer;
        color:white;
        font-size:24px;
        padding-top:10px;
        padding-bottom:10px;
        transition: all 0.3s;
        margin-top:-4px;
        font-weight:700;
    }
    [type="submit"]:hover { background:#CC4949; }
</style>
<body>
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php">Posts</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li  class="active"><a href="create_post.php">Create Post</a> </li>
    </ul>
</nav>
<div class="container">
    <form style="align-content: center;" class="col-sm-6" id="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="title">Title: </label>
            <input class="feedback-input" name="title" type="text" placeholder="Post Title">
        </div>
        <div class="form-group">
            <label for="author">Author: </label>
            <input class="feedback-input" name="author" type="text" placeholder="Author">
        </div>
        <div class="form-group">
            <label for="post">Post: </label>
            <textarea class="feedback-input" rows="4" name="post" placeholder="Post..."></textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag: </label>
            <input class="feedback-input" name="tags" placeholder="Tag #">
        </div>
        <input type="submit" name="submit">
    </form>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>