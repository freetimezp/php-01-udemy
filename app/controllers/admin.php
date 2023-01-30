<?php

class Admin extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);
    }
}