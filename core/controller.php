<?php
class Controller
{

  public $model;
  public $view;

  function __construct()
  {
    $this->view = new View();
  }

  public static function getClassName()
  {
    return get_called_class();
  }
}
?>