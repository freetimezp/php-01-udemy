<?php

namespace Controller;

use \Model\Course;

class Category extends Controller
{
    public function index($slug = null)
    {
        $course = new Course();

        $data['title'] = "Category";

        //read courses from db
        $query = "SELECT courses.*, categories.category, categories.slug FROM courses JOIN categories ON categories.id = courses.category_id WHERE categories.slug = :slug";
        $data['rows'] = $course->query($query, ['slug' => $slug]);
        //show($data['rows']);

        //read all courses order by trending
        $query = "SELECT * FROM courses WHERE approved = 0 ORDER BY trending DESC LIMIT 5";
        $data['trending'] = $course->query($query);

        $this->view('category', $data);
    }
}