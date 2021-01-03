<title>Create Library Database and Table</title>
</head>
<body>
<?php
echo ( '<p>Creating Personal Library Database and Table with SQLite Version: '
 . sqlite_libversion() . '</p>' );
$libraryDB = "C:\Program Files\Apache Group\Apache2\htdocs\PHP5\AppC\sqlite\library";
if ($db = @sqlite_open($libraryDB, 0666, $error)) {
   print ( '<p>Successfully created SQLite database called library</p>' );
   $sql = "CREATE TABLE books (
      book_id INTEGER PRIMARY KEY,
      book_title VARCHAR,
      book_author VARCHAR,
      book_pub_year INTEGER,
      book_publisher VARCHAR,
      book_read VARCHAR,
      book_score VARCHAR,
      book_loan VARCHAR
   )";
   if ( @sqlite_query($db, $sql) ) {
      print ( '<p>Successfully created SQLite table called books</p>' );
   } else {
      print ( '<p>Failed creating SQLite table called books because of error:
    <br />' . sqlite_error_string(sqlite_last_error($db)) . '</p>' );
   }
} else {
   print ( '<p>Failed creating SQLite database called library because of error:
    <br />' . $error . '</p>' );
}
?>
</body>
</html>
