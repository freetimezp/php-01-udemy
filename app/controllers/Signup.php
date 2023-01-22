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
            $query = "INSERT INTO users (email,firstname,lastname,password,role,date) 
                values (:email,:firstname,:lastname,:password,:role,:date)";

            $arr['email'] = $_POST['email'];
            $arr['firstname'] = $_POST['firstname'];
            $arr['lastname'] = $_POST['lastname'];
            $arr['password'] = $_POST['password'];
            $arr['role'] = "user";
            $arr['date'] = date("Y-m-d H:i:s");

            $db = new Database();
            $db->query($query, $arr);
        }


        $this->view('signup', $data);
    }
}