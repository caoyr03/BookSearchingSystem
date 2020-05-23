<!DOCTYPE html>
<html>
<head>
    <title>Award Winning Reads</title>
    <link rel="stylesheet" href="style.css"/> 
<style>
 .left {
        float: left;
        margin-left: 20px;
        width: 300px;
        height: 500px;
      }
      .right {
        margin-left: 310px;
        height: 500px;
      }
</style>
</head>
<body>
    <div id="content">
    <header>
    </header>
<?php include('header.php');?>
<form method="GET">
 <section id="controls">
 <input class="button" type="submit" name="browse_books" value="Browse" />
 <input class="button" type="submit" name="delete_books" value="Delete" />
 <input type="hidden" name="isbnisbn" value="<?php echo $result['ISBN'];?>">
 </section>
<section>
<div class="left">
<img src='images/<?php echo $result['Cover'] ?>'> 
</div>
</section>
<section>
 <div class="right">
<span class="flex-input">
<label>ISBN</label><?php echo $isbn ?></span> 
<span class="flex-input">
 <label>Title</label><?php echo $result['Title'] ?></span> 
<span class="flex-input">
 <label>Author</label><?php echo $result['Author'] ?></span> 
<span class="flex-input">
 <label>Publisher</label><?php echo $result['Publisher'] ?></span> 
<span class="flex-input">
 <label>Format</label><?php echo $result['Format'] ?></span> 
<span class="flex-input">
 <label>Category</label><?php echo $result['Category'] ?></span> 
<span class="flex-input">
 <label>Description</label><?php echo $result['Description'] ?></span> 
<span class="flex-input">
 <label>Rating</label><?php echo $result['Rating'] ?></span> 
 </div>
</section>
</form>
<?php
include('footer.php');
?>