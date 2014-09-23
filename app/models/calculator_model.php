<?php
  class Calculator_Model extends Model {
    private $actions = [
      "+" => "plus",
      "*" => "multiply",
      "-" => "minus",
      "/" => "divide"
    ];
    private function is_numeric($a,$b){
      return is_numeric($a) && is_numeric($b);
    }
    private function not_numeric($a,$b){
      return !$this->is_numeric($a,$b);
    }
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
      if ($this->not_numeric($a,$b)){
        return 'Error:$a or $b not numeric!';
      }
      $function = $this->actions[$action];
      if (is_callable($function,true)){
        return $this->$function($a, $b);
      }
      else {
        return "Action undefied!";
      }
    }    
  }
?>