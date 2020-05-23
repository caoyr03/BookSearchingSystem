<!DOCTYPE html>
<html>
<head>
    <title>Award Winning Reads</title>
    <link rel="stylesheet" href="style.css"/> 
<style>
.error {color: #FF0000;}
input[type="text"],input[type="hidden"]{
box-sizing: border-box;
  text-align:left;
  font-size:1.4em;
  height:2.1em;
  border-radius:4px;
  border:1px solid #c8cccf;
  color:#6a6f77;
  -web-kit-appearance:none;
  -moz-appearance: none;
  display:block;
  outline:0;
  padding:0 1em;
  text-decoration:none;
}
textarea {
font-size:1.4em;
color:#6a6f77;
border:1px solid #c8cccf;
border-radius:4px;
}
</style>
</head>
<body>
<?php
require_once('databaseLibrary.php');
$isbnErr = $titleErr = $authorErr = $publisherErr = $formatErr = $categoryErr = $ratingErr = "";
$isbn = $title = $author = $publisher = $format = $category = $rating = "";

if(isset($_POST['save_new_book'])){
   if(empty(trim($_POST['isbn']))) {
      $isbnErr = "ISBN is required";}
   elseif(getBook($_POST['isbn'])->fetch(PDO::FETCH_ASSOC)!=Null){
      $isbnErr = "ISBN already exists";
      $isbn = $_POST['isbn'];}
   else {
   $isbn = $_POST['isbn'];}
   
   if(empty(trim($_POST['title']))) {
      $titleErr = "Title is required";}
   else {
   $title = $_POST['title'];}

   if(empty(trim($_POST['author']))) {
      $authorErr = "Author is required";}
   else {
   $author = $_POST['author'];}

   if(empty(trim($_POST['publisher']))) {
      $publisherErr = "Publisher is required";}
   else {
   $publisher = $_POST['publisher'];}

   if(!isset($_POST['format'])) {
      $formatErr = "Format is required";}
   else {
   $format = $_POST['format'];}

   if(!isset($_POST['category'])) {
      $categoryErr = "Category is required";}
   else {
   $category = $_POST['category'];}

   if(empty(trim($_POST['rating']))) {
      $ratingErr = "Rating is required";}
   else {
   $rating = $_POST['rating'];}

   $description = $_POST['description'];
}

?>

    <div id="content">
    <header>
        <h1>Award Winning Reads</h1>
    </header>
    <div id="main">
    <form  method="post">
        <section id="controls">
            <input class="button" type="submit" name="browse_books" name="browse_books" value="Browse">
            <input class="button" type="submit" name="save_new_book" value="Save Book">   
        </section>
        <section id="center">

        <span class="flex-input">
        <label>ISBN</label>
        <input type="text" name="isbn" size=30 >
        <a class="error">&nbsp;&nbsp;<?php echo $isbnErr;?> </a></span>

	<span class="flex-input">
        <label>Title</label>
        <input type="text" name="title" size=50 >
        <a class="error">&nbsp;&nbsp;<?php echo $titleErr;?></a></span>

	<span class="flex-input">
        <label>Author</label>
        <input type="text" name="author" size=30 >
        <a class="error">&nbsp;&nbsp;<?php echo $authorErr;?></a></span>

	<span class="flex-input">
        <label>Publisher</label>
        <input type="text" name="publisher" size=30 >
        <a class="error">&nbsp;&nbsp;<?php echo $publisherErr;?></a></span>

	<span class="flex-input">
        <label>Category</label>
        <select name="category">
	    <option disabled selected value> Select category </option>
            <option value = 'eBook' >eBook</option>
            <option value = 'Paperback' >Paperback</option>
            <option value = 'Hardcover' >Hardcover</option>
            <option value = 'Audio' >Audio</option>
        </select>
        <a class="error">&nbsp;&nbsp;<?php echo $categoryErr;?></a></span>

	<span class="flex-input">
        <label>Format</label>
        <select name="format">
	    <option disabled selected value> Select format </option>
	    <option value = 'Poetry' >Poetry</option>
	    <option value = 'Novel'>Novel</option>
	    <option value = 'Literature' >Literature</option>
	    <option value = 'Literary Fiction' >Literary Fiction</option>
	    <option value = 'History' >History</option>
	    <option value = 'Historical Fiction' >Historical Fiction</option>
	    <option value = 'Fiction' >Poetry</option>
	    <option value = 'Children' >Children</option>
	    <option value = 'Biography' >Biography</option>
        </select>
        <a class="error">&nbsp;&nbsp;<?php echo $formatErr;?></a></span>

	<span class="flex-input">
        <label>Description</label>
        <textarea rows="5" cols="80" name="description" size=100 ></textarea></span> 
	
        <span class="flex-input">
        <label>Rating</label>
        <input type="text" name="rating" size=30 >
	<a class="error">&nbsp;&nbsp;<?php echo $ratingErr;?></a></span> 
    </form>        
    </div>
</body>
</html>

}