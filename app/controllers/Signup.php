<?php

class Signup extends Controller
{
    public function index()
    {
        $data['title'] = "Signup";
        $data['errors'] = [];
        $arr = [];

        $user = new User();

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $result = $user->validate($_POST);

            if($result) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST['role'] = "user";
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $user->insert($_POST);

                message("Profile successfully created. You can login.");
                redirect('login');
            }
        }

        $data['errors'] = $user->errors;

        $this->view('signup', $data);
    }
}