<!DOCTYPE html>
<html>
<head>
    <title>Award Winning Reads</title>
    <link rel="stylesheet" href="style.css"/> 
</head>
<body>
    <div id="content">
    <header>
        <h1>Award Winning Reads</h1>
    </header>
    <?php 
    $searchTerm='';
    $searchAttribute='';
    if(isset($_GET['search_books']))
    {$searchTerm=$_GET['searchTerm'];
    if(isset($_GET['attribute'])) 
      $searchAttribute = $_GET['attribute'];
   else $searchAttribute = '';}
    ?>
    <div id="main">
        <section id="controls">
            <form  method="get">
                <input class="button" type="submit" id="browse" name="browse_books" value="Browse">
                <input class="search" type="text"   name="searchTerm" size=10 value="<?php echo $searchTerm;?>">
		<input class="button" type="submit" name="search_books" value="&#128269;">
	            <select name = 'attribute'>
                        <option disabled selected value> Select topic to search </option>
	                <option value = 'Title' <?php if($searchAttribute=='Title') echo'selected';?>>Title</option>
	                <option value = 'Author'<?php if($searchAttribute=='Author') echo'selected';?>>Author</option>
	                <option value = 'Category'<?php if($searchAttribute=='Category') echo'selected';?>>Category</option>
                </select>
                <input class="button" type="submit" name="add_book" value="Add Book">
            </form>
        </section>
<?php
   if($statement == Null) echo"No results found.";
   else {
   echo "<table>
         <thead>
         <tr>
         <th>Title</th>
         <th>Author</th>
         <th>Category</th>
         </tr>
         </thead>
		 <tbody>";
   $count =0;
   while($result = $statement->fetch(PDO::FETCH_ASSOC)){
   $title = $result['Title'];
   $author = $result['Author'];
   $category = $result['Category'];
   $isbn = $result['ISBN'];
   $count++;
   echo "<tr><td><a href=?ISBN=$isbn>$title</a></td>
   <td>$author</td><td>$category</td></tr>";}
   if ($count == 0) echo"<tr>No results found.</tr>";

   echo "</tbody></table>";}
?>
</div>
<footer>
    <p>&copy; Award Winning Reads</p>
</footer>
</div>
</body>
</html>