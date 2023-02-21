<?php

namespace Controller;

use \Model\Auth;
use \Model\User;

class Login extends Controller
{
    public function index()
    {
        $data['title'] = "Login";
        $data['errors'] = [];

        $user = new User();

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            //validate
            $row = $user->first([
                'email' => $_POST['email'],
            ]);

            //show($row);
            if($row) {
                if(password_verify($_POST['password'], $row->password)) {
                    //auth
                    Auth::authenticate($row);

                    redirect('home');
                }

                $data['errors']['password'] = "Wrong email or password!";
            }
            
            $data['errors']['email'] = "Wrong email or password!";

        }

        $this->view('login', $data);
    }
}