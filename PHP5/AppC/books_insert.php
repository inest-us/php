<html>
<head>
<title>Personal Library: Add a Book</title>
</head>
<body>
<h1 align="center">Welcome to the Library</h1>
<?php
if (empty($_POST['action'])) $_POST['action'] = '';
if ($_POST['action'] == "Insert") {
   $libraryDB = "C:\Program Files\Apache Group\Apache2\htdocs\PHP5\AppC\sqlite\library";
   if ($db = @sqlite_open($libraryDB, 0666, $error)) {
      // Library opened, on with the insert SQL
      $sql = "INSERT INTO books(book_title, book_author, book_pub_year,
               book_publisher, book_read, book_score, book_loan)
               values('$_POST[form_title]', '$_POST[form_author]', 
               '$_POST[form_pub_year]', '$_POST[form_publisher]', 
               '$_POST[form_read]', '$_POST[form_score]', '$_POST[form_loan]')";
      if ( @sqlite_query($db, $sql) ) {
         print ( '<p>Successfully added '. $_POST['form_title'] . ' to table books.</p>' );
         print ( '<p>Add another book if you wish.</p>' );
      } else {
         print ( '<p>Failed adding '. $_POST[form_title] . ' because of error:
          <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
      }
   } else {
      print ( '<p>Failed opening SQLite database called library because of error:
       <br />' . $error . '</p>' );
   }
} else {
   print ( '<p>Please enter book information below. Include at least a
    title and author</p>') ;
}
?>
<p><form action="books_insert.php" method="post"><br />
Enter a book title:<br />
<input type="text" name="form_title"><br />
Enter the author (last, first) of this book:<br />
<input type="text" name="form_author"><br />
Enter the year of publication<br />
<input type="text" name="form_pub_year"><br />
Enter the publisher:<br />
<input type="text" name="form_publisher"><br>
Have you read this book yet?<br />
<select name="form_read"><br />
<option value="Yes" SELECTED>Yes</option><br />
<option value="No">No</option><br />
</select><br />
Give this book a rating (1 to 5)<br />
<input type="text" name="form_score"><br />
Currently loaned to:<br />
<input type="text" name="form_loan"><br />
<input type="submit" name="action" value="Insert"><br />
</form></p>
<p><a href="index.php">Back to the main library page.</a></p>
</body>
</html>
