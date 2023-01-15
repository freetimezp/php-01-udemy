<?php 

Class App {
    //create default controller and method
    private $controller = "home";
    private $method = "index";
    private $params = [];

    //constuct will run when this class created
    public function __construct() {
        //get url
        $url = $this->splitURL();
        //show($url);

        //check if controller exist get new else ue default
        if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }

        //use new controller
        require "../app/controllers/" . $this->controller . ".php";
        //create new class of controller (by default Home)
        $this->controller = new $this->controller;

        //check method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //run class and method
        $this->params = array_values($url);
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function splitURL() {
        //echo($_GET['url']);
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}