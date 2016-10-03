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
    if(@$_POST['delete_id']){
        $delete_id = $_POST['delete_id'];
        $database->query('DELETE FROM posts WHERE id = :id');
        $database->bind(':id', $delete_id);
        $database->execute();
    }

    if (@$_POST['submit']) {
        $title = $post['title'];
        $post = $post['post'];
        $author = $_POST['author'];
        $database->query('INSERT INTO posts (post, title, authors) VALUES(:post, :title, :author)');
        $database->bind(':title', $title);
        $database->bind(':post', $post);
        $database->bind(':author', $author);
        $database->execute();
        if ($database->lastInsertId()) {
            $message = $title . ' was added';
            echo "<script>alert($message);</script>";
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
        <input type="submit" name="submit">
    </form>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>