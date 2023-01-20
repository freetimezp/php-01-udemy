<?php

class Home extends Controller
{
    public function index()
    {
        $db = new Database();
        $res = $db->query("SELECT * FROM users");
        //show($res);

        $data['title'] = "Home";
        $this->view('home', $data);
    }
}