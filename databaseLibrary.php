<?php
function connectToDatabase() {
   global $db;
   try {
   $db = new PDO('sqlite:Books.db');
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch (PDOException $e){
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   $db = null; 
   exit();
   }
}

function saveNewBook($isbn,$title, $author, $publisher, $format, $category, $description, $rating){
   global $db;
   try {
   $query = "INSERT INTO BOOK VALUES ('$isbn','$title', '$author', '$publisher', '$format', '$category', '$description', '$rating', 'placeholder.png')";
   $statement = $db->prepare($query);
   $statement->execute();
   return $statement;
   }
   catch (PDOException $e) {
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   $db = null;
   exit();
   }
}

function getListOfAllBooks() {
   global $db;
   try {
   $query = "SELECT * FROM BOOK ORDER BY TITLE";
   $statement = $db->prepare($query);
   $statement->execute();
   return $statement;
   }
   catch (PDOException $e){
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   echo "<p> Unable to execute SELECT statement: $query </p>";
   $db = null;
   exit();
   }
}
function getBook($isbn){
   global $db;
   try {
   $query = "SELECT * FROM BOOK WHERE ISBN = '$isbn'";
   $statement = $db->prepare($query);
   $statement->execute();
   return $statement;
   }
   catch (PDOException $e) {
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   $db = null;
   exit();
   }
}
function deleteBook($isbn){
   global $db;
   try {
   $query = "DELETE FROM BOOK WHERE ISBN = '$isbn'";
   $statement = $db->prepare($query);
   $statement->execute();
   return $statement;
   }
   catch (PDOException $e) {
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   $db = null;
   exit();
   }
}

function searchBooks($attr, $term) {
   global $db;
   $bookcount = 0;
   if($attr==''){
   $query = "SELECT * FROM BOOK WHERE
   Title LIKE '%$term%' OR Author LIKE '%$term%' OR Category LIKE '%$term%'ORDER BY Title";
   }
   else {
   $query = "SELECT * FROM BOOK WHERE $attr LIKE '%" . $term . "%' ORDER BY Title";
   }
   try {
   $statement = $db->prepare($query);
   $statement->execute();
   while($result = $statement->fetch(PDO::FETCH_ASSOC)){
   $bookcount ++;}
   $statement->closeCursor();
   $statement = $db->prepare($query);
   $statement->execute();
   if($bookcount==0) return Null;
   else return $statement;}
   catch (PDOException $e){
   $errorMessage = $e->getMessage();
   echo "<p>SQL error: $errorMessage </p>";
   echo "<p> Unable to execute SELECT statement: $query </p>";
   $db = null;
   exit();
   }
}

?>
