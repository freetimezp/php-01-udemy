<?php 

Class App {
    //create default controller and method
    private $controller = "_404";
    private $method = "index";
    public static $page = "_404";

    //constuct will run when this class created
    public function __construct() {
        //get arr
        $arr = $this->getURL();
        //show($arr);

        //check if controller exist get new else ue default
        if(file_exists("../app/controllers/" . ucfirst($arr[0]) . ".php")) {
            //use new controller
            require "../app/controllers/" . ucfirst($arr[0]) . ".php";
            $this->controller = $arr[0];
            self::$page = $arr[0];
            unset($arr[0]);
        }else{
            require "../app/controllers/" . $this->controller . ".php";
        }

        //create new class of controller (by default Home)
        $mycontroller = new ("Controller\\" . $this->controller)();
        $mymethod = $arr[1] ?? $this->method;
        $mymethod = str_replace("-", "_", $mymethod);

        //check method
        if(isset($arr[1])) {
            if(method_exists($mycontroller, strtolower($mymethod))) {
                $this->method = strtolower($mymethod);
                unset($arr[1]);
            }
        } 

        //run class and method
        $arr = array_values($arr);
        call_user_func_array([$mycontroller, $this->method], $arr);
    }

    private function getURL() {
        //echo($_GET['url']);
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}