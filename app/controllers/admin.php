<?php

namespace Controller;

use \Model\Auth;
use \Model\User;
use \Model\Slider;
use \Model\Course;
use \Model\Category;
use \Model\Language_model;
use \Model\Level_model;
use \Model\Price_model;
use \Model\Currency_model;

class Admin extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the admin section');
            redirect('login');
        }

        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);
    }

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view the profile section');
            redirect('login');
        }

        $id = $id ?? Auth::getId();
        $user = new User();
        $data['row'] = $row = $user->first(['id' => $id]);

        if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
            $folder = "uploads/images/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php //no access");
                file_put_contents("uploads/index.php", "<?php //no access");
            }

            if ($user->edit_validate($_POST, $id)) {
                $allowed = ['image/jpeg', 'image/png'];

                if (!empty($_FILES['image']['name'])) {
                    if ($_FILES['image']['error'] == 0) {
                        if (in_array($_FILES['image']['type'], $allowed)) {
                            //if is all good
                            $destination = $folder . time() . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                            //resize image for smaller size
                            resize_image($destination);

                            $_POST['image'] = $destination;

                            if (file_exists($row->image)) {
                                unlink($row->image);
                            }
                        } else {
                            $user->errors['image'] = "An error occured with type image";
                        }
                    } else {
                        $user->errors['image'] = "An error occured with upload image";
                    }
                }

                $user->update($id, $_POST);
                //message("Profile saved successfully!");
                //redirect('admin/profile/' . $id);
            }

            if (empty($user->errors)) {
                $arr['message'] = "Profile saved successfully!";
            } else {
                $arr['message'] = "Please try to fix errors..";
                $arr['errors'] = $user->errors;
            }

            echo json_encode($arr);
            die;
        }

        $data['title'] = "Profile";
        $data['errors'] = $user->errors;

        $this->view('admin/profile', $data);
    }

    public function slider_images($id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view the profile section');
            redirect('login');
        }

        $slider = new Slider();
        $data['rows'] = $rows = $slider->where(['disabled' => 0]);

        if($rows) {
            foreach($rows as $key => $obj) {
                $num = $obj->id;
                $data['rows'][$num] = $obj;
            }
        }

        $id = $_POST['id'] ?? 0;
        $row = $slider->first(['id' => $id]);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $folder = "uploads/images/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php //no access");
                file_put_contents("uploads/index.php", "<?php //no access");
            }

            $allowed = ['image/jpeg', 'image/png'];

            if (!empty($_FILES['image']['name'])) {
                if ($_FILES['image']['error'] == 0) {
                    if (in_array($_FILES['image']['type'], $allowed)) {
                        //if is all good
                        $destination = $folder . time() . $_FILES['image']['name'];
                        $_POST['image'] = $destination;
                    } else {
                        $slider->errors['image'] = "An error occured with type image";
                    }
                } else {
                    $slider->errors['image'] = "An error occured with upload image";
                }
            }

            if ($slider->validate($_POST, $id)) {
                if (!empty($destination)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    //resize image for smaller size
                    resize_image($destination);
                    if ($row && file_exists($row->image)) {
                        unlink($row->image);
                    }
                }

                if ($row) {
                    unset($_POST['id']);
                    $slider->update($id, $_POST);
                } else {
                    $slider->insert($_POST);
                }

                //message("Slider image saved successfully!");
            }

            if (empty($slider->errors)) {
                $arr['message'] = "Slider image saved successfully!";
            } else {
                $arr['message'] = "Please try to fix errors..";
                $arr['errors'] = $slider->errors;
            }

            echo json_encode($arr);
            die;
        }

        $data['title'] = "Slider Images";
        $data['errors'] = $slider->errors;

        $this->view('admin/slider_images', $data);
    }

    public function courses($action = null, $id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view the profile section');
            redirect('login');
        }

        $user_id = Auth::getId();

        $data['title'] = "Courses";
        $data['action'] = $action;
        $data['id'] = $id;

        $course = new Course();
        $category = new Category();
        $language = new Language_model();
        $level = new Level_model();
        $price = new Price_model();
        $currency = new Currency_model();

        if ($action == 'add') {
            $data['categories'] = $category->findAll("ASC");

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($course->validate($_POST)) {
                    $_POST['date'] = date("Y-m-d H:i:s");
                    $_POST['user_id'] = $user_id;
                    $_POST['price_id'] = 1;

                    $course->insert($_POST);

                    $row = $course->first(['user_id' => $user_id, 'published' => 0]);

                    message("Course successfully created.");

                    if ($row) {
                        message("Course successfully created.");
                        redirect('admin/courses/edit/' . $row->id);
                    } else {
                        redirect('admin/courses');
                    }
                }

                $data['errors'] = $course->errors;
            }
        } else if ($action == 'edit') {
            //view single course
            $categories = $category->findAll("ASC");
            $languages = $language->findAll("ASC");
            $levels = $level->findAll("ASC");
            $prices = $price->findAll("ASC");
            $currencies = $currency->findAll("ASC");

            $data['row'] = $row = $course->first(['user_id' => $user_id, 'id' => $id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
                //check if form is valid by csrf code

                if (!empty($_POST['data_type']) && $_POST['data_type'] == "read") {
                    if ($_POST['tab_name'] == "course-landing-page") {
                        include views_path("course-edit-tabs/course-landing-page");
                    } else if ($_POST['tab_name'] == "course-messages") {
                        include views_path("course-edit-tabs/course-messages");
                    }
                } else if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {
                    if ($_SESSION['csrf_code'] == $_POST['csrf_code']) {
                        if ($course->edit_validate($_POST, $id, $_POST['tab_name'])) {
                            //if temp image is exists 
                            if (
                                $row->course_image_tmp != "" && file_exists($row->course_image_tmp)
                                && $row->csrf_code == $_POST['csrf_code']
                            ) {
                                //delete current image
                                if (file_exists($row->course_image)) {
                                    unlink($row->course_image);
                                }

                                //add new image to array
                                $_POST['course_image'] = $row->course_image_tmp;
                                $_POST['course_image_tmp'] = "";
                            }

                            $course->update($id, $_POST);

                            $info['data'] = "Course saved successfully.";
                            $info['data_type'] = "save";
                        } else {
                            $info['errors'] = $course->errors;

                            $info['data'] = "Please fix errors.";
                            $info['data_type'] = "save";
                        }
                    } else {
                        $info['errors'] = ['key' => 'value'];
                        $info['data'] = "This form is not valid";
                        $info['data_type'] = $_POST['data_type'];
                    }
                    echo json_encode($info);
                } else if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_image") {
                    $folder = "uploads/courses/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    $errors = [];
                    if (!empty($_FILES['image']['name'])) {

                        $destination = $folder . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        //delete old temp file
                        if (file_exists($row->course_image_tmp)) {
                            //show(123);
                            unlink($row->course_image_tmp);
                        }

                        $course->update($id, ['course_image_tmp' => $destination, 'csrf_code' => $_POST['csrf_code']]);
                    }
                    //show($_FILES);
                    //show($_POST);
                }

                die;
            }
        } else {
            //view courses
            $data['rows'] = $course->where(['user_id' => $user_id]);
        }

        $this->view('admin/courses', $data);
    }
}
