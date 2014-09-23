<?php
class Route
{
  // default controller and action names
  private $controller_name = 'Main';
  private $action_name = 'index';
  private $model_name = '';
  function start()
  {

    switch ($_SERVER['REQUEST_METHOD']){
      case "GET":
        $this->get_request();
        break;
      case "POST":
        $this->post_request();
        break;
      // PUT, DELETE not implemented yet
    }
  }


  function get_request()
  {
    $this->get_request_info();
    // подцепляем файл с классом модели (файла модели может и не быть)
    try {
      $model_path = $this->locate_model($this->model_name);
      $this->include_module($model_path);
    } catch (Exception $e){
      //it's ok, if model not found;
    }
    // подцепляем файл с классом контроллера
    try {
      $controller_path = $this->locate_controller($this->controller_name);
      $this->include_module($controller_path);
    } catch (Exception $e){
      //Route::ErrorPage404();
    }
    
    // создаем контроллер
    $controller = new $this->controller_name;
    $action = $this->action_name;
    
    if(method_exists($controller, $action))
    {
        // вызываем действие контроллера
        $controller->$action();
    }
    else
    {
        // здесь также разумнее было бы кинуть исключение
        echo $controller.$action;
        //Route::ErrorPage404();
    }
  }
  function post_request(){
    $this->get_request_info();
    try {
      $controller_path = $this->locate_controller($this->controller_name);
      $this->include_module($controller_path);
    } catch (Exception $e){
      //Route::ErrorPage404();
    }
    
    // создаем контроллер
    $controller = new $this->controller_name;
    $action = $this->action_name;
    
    if(method_exists($controller, $action))
    {
        // вызываем действие контроллера
        $controller->$action();
    }
    else
    {
        // здесь также разумнее было бы кинуть исключение
        echo $controller.$action;
        //Route::ErrorPage404();
    }
  }
  
  function ErrorPage404()
  {
    /*$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:'.$host.'404');*/
  }
  protected function get_request_info(){
    $routes = explode('/', $_SERVER['REQUEST_URI']);

    // get controller name from request
    $this->update_controller_name($routes);
    // get action name
    $this->update_action_name($routes);

    // add prefixe
    $this->model_name = $this->controller_name."_Model";
    $this->controller_name .= "_Controller";
    return true;
  }
  protected function locate_file($type,$name){
    return "app/".$type."/".strtolower($name).".php";
  }
  protected function locate_view($name){
    return $this->locate_file("views",$name);
  }
  protected function locate_controller($name){
    return $this->locate_file("controllers",$name);
  }
  protected function locate_model($name){
    return $this->locate_file("models",$name);
  }
  protected function include_module($path){
    if(file_exists($path)){
      include $path;
    }
    else {
       throw new Exception('File not found.');
    }
  }
  protected function update_controller_name($routes){
    if ( !empty($routes[1]) )
    { 
      $this->controller_name = $routes[1];
      return true;
    }
    else {
      return false;
    }
  }
  protected function update_action_name($routes){
    if ( !empty($routes[2]) )
    {
      $this->action_name = $routes[2];
      return true;
    }
    else {
      return false;
    }
  }
}
?>