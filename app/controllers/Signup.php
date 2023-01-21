<?php

class Signup extends Controller
{
    public function index()
    {
        $data['title'] = "Signup";
        //show($_POST);

        $user = new User();
        $result = $user->validate($_POST);

        var_dump($result);
        show($user->errors);

        $this->view('signup', $data);
    }
}