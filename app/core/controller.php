<?php 

Class Controller {
    public function view($view, $data = []) {
        extract($data);
        
        $filename = "../app/views/" . $view . ".view.php";

        if(file_exists($filename)) {
            require $filename;
        }else{
            require "../app/views/404.php";
        }
    }

    function loadModel($model) {
        if(file_exists("../app/models/" . $model . ".php")) {
            require "../app/models/" . $model . ".php";
            return $model = new $model();
        }

        return false;
    }
}