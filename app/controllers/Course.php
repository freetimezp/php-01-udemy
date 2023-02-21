<?php

namespace Controller;


class Course extends Controller
{
    public function index()
    {
        $course = new \Model\Course();

        $data['title'] = "Home";

        //read all courses from db
        $data['rows'] = $course->where(['approved' => 0]);

        //read all courses order by trending
        $query = "SELECT * FROM courses WHERE approved = 0 ORDER BY trending DESC LIMIT 5";
        $data['trending'] = $course->query($query);


        $this->view('home', $data);
    }
}