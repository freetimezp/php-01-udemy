<?php

namespace Controller;

use \Model\Course;
use \Model\Slider;

class Home extends Controller
{
    public function index()
    {
        $course = new Course();
        $slider = new Slider();

        $data['title'] = "Home";

        //read all courses from db
        $data['rows'] = $course->where(['approved' => 0]);

        //read all courses order by trending
        $query = "SELECT * FROM courses WHERE approved = 0 ORDER BY trending DESC LIMIT 5";
        $data['trending'] = $course->query($query);

        //load slider images
        $images = $slider->where(['disabled' => 0], "ASC");
        $data['images'] = $images;

        $this->view('home', $data);
    }
}