<?php
$words = "you, should, vote, happily";
$wordarray = explode(", ", $words);
foreach ($wordarray as $word) {
	echo "$word<p>";
   if ($word == "vote") {
      echo "Found string 'vote'";
   }
}
?>
<?php
$words = "you, should, vote, happily";
if (ereg("vote", $words)) {
   echo "Found string 'vote'";
}
?>
<?php
$words = "vote, and, you, should, vote, happily";
if (ereg("vote", $words, $reg)) echo "Found string '$reg[0]'";
?>
<?php
$words1 = "The bigdog is in the pound...";
$words2 = "...but the dog is in the cornfield";
$regexp = " dog";
if (ereg($regexp, $words1, $reg)) echo "Found string '$reg[0]'";
if (ereg($regexp, $words2, $reg)) echo "Found string '$reg[0]'";
?>
<?php
$words1 = "The bigdog is in the pound...";
$regexp = "pound\.\.\.";
if (ereg($regexp, $words1, $reg)) echo "Found string '$reg[0]'";
?>
<?php
$words1 = "The bigdog is in the pound but the dog is in the cornfield.";
$regexp = "pound...";
if (ereg($regexp, $words1, $reg)) echo "Found string '$reg[0]'";
?>
