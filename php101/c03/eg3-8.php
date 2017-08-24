<?php
$author = "Alfred E Newman";

// _END; tag must appear right at the start of a new line and it must be the only thing on that line
echo <<<_END
    This is a Headline

    This is the first line.
    This is the second.
    - Written by $author.
_END;
?>
