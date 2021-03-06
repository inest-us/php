<?php
require_once("abstract_widget.php");

class BorderDecorator extends Widget {

  private $widget;

  function __construct(Widget $widget) {
    $this->widget = $widget;
  }

  public function draw() {
  
    echo "<table border=0 cellpadding=1 bgcolor=#3366ff>";
    echo "<tr bgcolor=#ffffff><td>";
    $this->widget->draw();
    echo "</td></tr></table>";
    
  }
  
  public function update(Observable $subject) {
    $this->widget->update($subject);
  }
  
}
?>