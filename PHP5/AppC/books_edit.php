<html>
<head>
<title>Personal Library: Edit Record</title>
</head>
<body>
<h1 align="center">Welcome to the Library</h1>
<?php
$libraryDB = "C:\Program Files\Apache Group\Apache2\htdocs\PHP5\AppC\sqlite\library";
if ($db = @sqlite_open($libraryDB, 0666, $error)) {
   // Library opened, choose an operation
   if ($_GET['id']) {
      $sql = "SELECT * FROM books where book_id = '$_GET[id]'";
      if ( $result = sqlite_query($db, $sql) ) {
         $book = sqlite_fetch_array($result);
         print("<p><form action=\"books_edit.php\" method=\"post\"><br />");
         print("<input type=\"text\" name=\"form_id\" value=\"$_GET[id]\"><br />");
         print("Enter a book title:<br />");
         print("<input type=\"text\" name=\"form_title\" 
         value=\"$book[book_title]\"><br />");
         print("Enter the author (last, first) of this book:<br />");
         print("<input type=\"text\" name=\"form_author\" 
         value=\"$book[book_author]\"><br />");
         print("Enter the year of publication<br />");
         print("<input type=\"text\" name=\"form_pub_year\" 
         value=\"$book[book_pub_year]\"><br />");
         print("Enter the publisher:<br />");
         print("<input type=\"text\" name=\"form_publisher\" 
         value=\"$book[book_publisher]\"><br />");
         print("Have you read this book yet?<br />");
         print("<select name=\"form_read\"><br />");
         print("<option value=\"Yes\"");
         if ($book[book_read] == 'Yes') { print("selected"); }
         print(">Yes</option><br />");
         print("<option value=\"No\"");
         if ($book[book_read] == 'No') { print("selected"); }
         print(">No</option><br />");
         print("</select><br />");
         print("Give this book a rating (1 to 5)<br />");
         print("<input type=\"text\" name=\"form_score\" 
         value=\"$book[book_score]\"><br />");
         print("Currently loaned to:<br />");
         print("<input type=\"text\" name=\"form_loan\" 
         value=\"$book[book_loan]\"><br />");
         print("<input type=\"submit\" name=\"action\" 
         value=\"Update\"><br />");
         print("</form></p>");
      } else {
         print ( '<p>Failed retrieveing record because of error:
          <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
      }
   } else if ($_POST[form_id]) {
      $sql = "update books set book_title = '$_POST[form_title]', 
      book_author = '$_POST[form_author]', 
      book_pub_year = '$_POST[form_pub_year]', 
      book_publisher = '$_POST[form_publisher]', 
      book_read = '$_POST[form_read]', 
      book_score = '$_POST[form_score]', 
      book_loan = '$_POST[form_loan]' 
      where book_id = '$_POST[form_id]'";
      print $sql;
      if (sqlite_query($db, $sql)) {
         print ( '<p>Your edits were successfully posted.</p>' );
      } else {
         print ( '<p>Failed updating record because of error:
          <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
      }
   }
} else {
   print ( '<p>Failed opening SQLite database called library because of error:
    <br />' . $error . '</p>' );
}
?>
<p><a href="index.php">Back to the main library page.</a></p>
</body>
</html>
