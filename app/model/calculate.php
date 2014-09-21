<?php
  class Calculator {
    private $actions = [
      "+" => "plus",
      "*" => "multiply",
      "-" => "minus",
      "/" => "divide"
    ];
    function plus($a, $b){
      return $a + $b;
    }
    function minus($a, $b){
      return $a - $b;
    }
    function multiply($a, $b){
      return $a * $b;
    }
    function divide($a, $b){
      return $a / $b;
    }
    function calculate($action, $a, $b){
      $function = $this->actions[$action];
      if (is_callable($function)){
        return $this->$function($a, $b);
      }
      else {
        return "Action undefied!";
      }
    }    

  }
?>