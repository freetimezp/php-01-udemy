<?php

class Signup extends Controller
{
    public function index()
    {
        $data['title'] = "Signup";
        $arr = [];
        //show($_POST);

        $user = new User();
        $result = $user->validate($_POST);
        //var_dump($result);
        //show($user->errors);

        if($result) {
            $_POST['date'] = date("Y-m-d H:i:s");
            $_POST['role'] = "user";
            
            $user->insert($_POST);
        }


        $this->view('signup', $data);
    }
}