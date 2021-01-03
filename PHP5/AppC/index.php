<html>
<head>
<title>Personal Library: Switchboard</title>
</head>
<body>
<h1 align="center">Welcome to the Library</h1>
<p><a href="books_insert.php">Add a book</a></p>
<?php
$libraryDB = "C:\Program Files\Apache Group\Apache2\htdocs\PHP5\AppC\sqlite\library";
if ($db = @sqlite_open($libraryDB, 0666, $error)) {
if (empty($_GET['id'])) $_GET['id'] = '';   
if ($_GET['id']) {
      $sql = "DELETE FROM books where book_id = '$_GET[id]'";
      if ( @sqlite_query($db, $sql)) {
         print ( '<p>Succeeded deleting record ' .  $_GET[id] . '</p>' );
      } else {
         print ( '<p>Failed deleting record ' .  $_GET[id] . ' because of error:
          <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
      }
   }
   // Library opened, on with the insert SQL
   $sql = "SELECT * FROM books";
   if ( $result = sqlite_query($db, $sql) ) {
      print ( '<p>There are ' . sqlite_num_rows($result) . 
      ' books in the library.</p>');
      while ($book = sqlite_fetch_array($result)) {
         print ( '<p><strong>Book:</strong> ' . $book['book_title'] . 
         ' <strong>Author</strong>: ' . $book['book_author'] . '<br />' . 
         ' <strong>Publishing:</strong> ' . $book['book_publisher'] . '; ' . 
         $book['book_pub_year'] . ' <strong>Read:</strong> ' . $book['book_read'] . 
         ' <strong>Score:</strong> ' . $book['book_score'] . '<br />' . 
         '<strong>Loaned to:</strong> ' . $book['book_loan'] . '<br />' .
         '<a href="books_edit.php?id=' . $book['book_id'] . '">Edit</a> | ' .
         '<a href="index.php?id=' . $book['book_id'] . '">Delete</a></p>' );
      }
   } else {
      print ( '<p>Failed reading table books because of error:
       <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
   }
} else {
   print ( '<p>Failed opening SQLite database called library because of error:
    <br />' . $error . '</p>' );
}
?>
<p><a href="books_insert.php">Add a book</a></p>
</body>
</html>
 