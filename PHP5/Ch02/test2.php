<!DOCTYPE html>
<HTML>
<HEAD>
    <TITLE>Web Page</TITLE>
</HEAD>
<BODY>
    The text here displays the date as a result of PHP5 processing: Today is
    <?php
        $todaysdate = date("m",time()) . "-" . date("d",time()) . "-" . date("Y",time());
        echo $todaysdate;
    ?>
</BODY>
</HTML>
