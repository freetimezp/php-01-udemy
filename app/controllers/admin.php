<?php

class Admin extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);
    }

    public function profile($id = null)
    {
        $data['title'] = "Profile";

        $id = $id ?? Auth::getId();
        $user = new User();
        $data['row'] = $user->first(['id' => $id]);


        $this->view('admin/profile', $data);
    }
}