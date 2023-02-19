<?php

class Home extends Controller
{
    public function index()
    {
        $course = new Course_model();
        
        $data['title'] = "Home";

        //read all courses from db
        $data['rows'] = $course->where(['approved' => 0]);


        $this->view('home', $data);
    }
}