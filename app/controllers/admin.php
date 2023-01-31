<?php

class Admin extends Controller
{
    public function index()
    {
        if(!Auth::logged_in()) {
            message('Please login to view the admin section');
            redirect('login'); 
        }

        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);
    }

    public function profile($id = null)
    {
        if(!Auth::logged_in()) {
            message('Please login to view the profile section');
            redirect('login'); 
        }

        $data['title'] = "Profile";

        $id = $id ?? Auth::getId();
        $user = new User();
        $data['row'] = $user->first(['id' => $id]);


        $this->view('admin/profile', $data);
    }
}