<?php
require_once('databaseLibrary.php');
$db = null;
$isbn = "";

connectToDatabase();
 
// Initial display of the index.php page
if ( empty($_POST) && empty($_GET) ) {
   $statement = getListOfAllBooks();
   include('listView.php');
}
// User has clicked the Browse button
elseif (isset($_GET['browse_books'])) {
    // Sets the Location HTTP header to the index page.
    // This will clear any $_POST or $_GET array contents.
	header('Location: index.php');
}
// User has clicked the Search button
elseif (isset($_GET['search_books'])) {
   if(isset($_GET['attribute'])) 
      $searchAttribute = $_GET['attribute'];
   else $searchAttribute = '';
   $searchTerm = $_GET['searchTerm'];
   $statement = searchBooks($searchAttribute, $searchTerm);
   include('listView.php');
}
//User has clicked the AddBook button, go to the AddBook page
elseif(isset($_POST['add_book'])) {
   include('addRecordView.php');
}

//User has clicked the SaveBook button
elseif(isset($_POST['save_new_book'])){
   if(!empty(trim($_POST['isbn']))&&getBook(trim($_POST['isbn']))!=Null&&!empty(trim($_POST['title']))&&!empty(trim($_POST['author']))&&!empty(trim($_POST['publisher']))&&isset($_POST['format'])&&isset($_POST['category'])&&!empty(trim($_POST['rating']))){
   $statement = saveNewBook($_POST['isbn'], $_POST['title'], $_POST['author'], $_POST['publisher'], $_POST['format'],$_POST['category'], $_POST['description'], $_POST['rating']);
   //I dont know simply fetching into result doesnt work, the $result turns out to be empty, so I use getBook(isbn) function again to show the result
   $statement = getBook($_POST['isbn']);
   $result = $statement->fetch(PDO::FETCH_ASSOC);
   include('detailedRecordView.php');
   }
   else {
   include('addRecordView.php');}
}

//User clicked on each book title, link to their isbn page
elseif (isset($_GET['ISBN'])){

   $statement = getBook($_GET['ISBN']);
   $result = $statement->fetch(PDO::FETCH_ASSOC);
   $isbn = $result['ISBN'];
   include('detailedRecordView.php');
}

if(isset($_GET['delete_books'])){
   if($isbn == null){$isbn = $_GET['isbnisbn'];}
   print_r($isbn);
   $statement = deleteBook($isbn)->fetch(PDO::FETCH_ASSOC);
   header('Location: index.php');
}




?>

