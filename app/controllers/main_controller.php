<?php
class Main_Controller extends Controller
{
  function __construct() {
    parent::__construct();
    require_once 'app/models/calculator_model.php';
    $this->model = new Calculator_Model;
  }

  function index()
  { 
      $this->view->generate('main_view.php', 'template_view.php');
  }
  function calculate()
  {
    $result = $this->model->calculate($_POST['action'],$_POST['a'],$_POST['b']);
    $this->view->generate('result_view.php', 'template_view.php',$result);
  }
}