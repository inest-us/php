<?php
   //petronas.php
   $height_of_tower_a = 0;
   $height_of_tower_b = 12;
   if ($height_of_tower_a == $height_of_tower_b) {
      $towers_in_dead_heat = 1;
   } else {
      if ($height_of_tower_a > $height_of_tower_b) {
         $tallertowername = "Tower A";
         $shortertowername = "Tower B";
         $tallertowerheight = $height_of_tower_a;
         $shortertowerheight = $height_of_tower_b;
      } else {
         $tallertowername = "Tower B";
         $shortertowername = "Tower A";
         $tallertowerheight = $height_of_tower_b;
         $shortertowerheight = $height_of_tower_a;
      }
      $towers_in_dead_heat = 0;
   }
   if ($towers_in_dead_heat == 1) {
      echo("The two towers are <b>in a dead heat</b>!");
   } else {
      if ($shortertowerheight == 0) {
         echo("At this moment, <b>${tallertowername}</b> 
            has reached a height of  <b>${tallertowerheight}</b>, 
            but ${shortertowername} hasn't even risen a foot!");
      } else {
         $taller_by_ratio = $tallertowerheight / $shortertowerheight;
         echo("At this moment, <b>${tallertowername}</b>
               is <b>${taller_by_ratio}</b> times taller than ${shortertowername}!");
      }
   }
?>
