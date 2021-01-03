<html>
<head><title></title></head>
<body>
<b>Namllu Holiday Booking Form</b>
<?php
function calculator($price, $city_modifier, $star_modifier)
{
   return $price = $price * $city_modifier * $star_modifier;   
}

function calc($price = 1, $city_modifier = 2, $star_modifier = 4)
{
   echo "$price * $city_modifier * $star_modifier";   
}
calc (2,2);

if (isset($_POST['posted'])) {
   $price = 500;
   $star_modifier = 1;
   $city_modifier = 1;
   $destgrade = $_POST['destination'].$_POST['grade'];
   switch($destgrade) {
      case "Barcelonathree";
         $city_modifier = 2;
         break;   
      case "Barcelonafour";
         $city_modifier = 2;
         $star_modifier = 2;      
         break;
      case "Viennathree";
         $city_modifier = 3.5;      
         break;
      case "Viennafour";
         $city_modifier = 3.5;
         $star_modifier = 2;
         break;   
      case "Praguethree"; 
         break;
      case "Ppraguefour"; 
         $star_modifier = 2;
         break;   
      default;
         $city_modifier = 0;
         echo ("Please go back and try it again");
      break;
   }
   if ($city_modifier <> 0)
   {
      echo "The cost for a week in $_POST[destination] is " . "$" .  calculator($price, $city_modifier, $star_modifier);
   }
}
?>
<form method="POST" action="holiday3.php">
<input type="hidden" name="posted" value="true">
Where do you want to go on holiday?
<br>
<br>
<input name="destination" type="radio" value="Prague">
Prague
<br>
<input name="destination" type="radio" value="Barcelona">
Barcelona
<br>
<input name="destination" type="radio" value="Vienna">
Vienna
<br>
<br>
What grade of hotel do you want to stay at?
<br>
<br>
<input name="grade" type="radio" value="three">
Three star
<br>
<input name="grade" type="radio" value="four">
Four star
<br>
<br>
<input type="submit" calue="Check Prices">
</form>
</body>
</html>
