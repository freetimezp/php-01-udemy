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

        $id = $id ?? Auth::getId();
        $user = new User();
        $data['row'] = $row = $user->first(['id' => $id]);

        if($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
            $folder = "uploads/images/";
            if(!file_exists($folder)) {
                mkdir($folder,0777,true);
                file_put_contents($folder . "index.php", "<?php //no access");
                file_put_contents("uploads/index.php", "<?php //no access");
            }

            if($user->edit_validate($_POST, $id)) {
                $allowed = ['image/jpeg', 'image/png'];

                if(!empty($_FILES['image']['name'])) {
                    if($_FILES['image']['error'] == 0) {
                        if(in_array($_FILES['image']['type'], $allowed)) {
                            //if is all good
                            $destination = $folder . time() . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                            //resize image for smaller size
                            resize_image($destination);

                            $_POST['image'] = $destination;

                            if(file_exists($row->image)) {
                                unlink($row->image);
                            }
                        }else{
                            $user->errors['image'] = "An error occured with type image";
                        }
                    }else{
                        $user->errors['image'] = "An error occured with upload image";
                    }
                }

                $user->update($id, $_POST);
                //message("Profile saved successfully!");
                //redirect('admin/profile/' . $id);
            }

            if(empty($user->errors)) {
                $arr['message'] = "Profile saved successfully!";
            }else{
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

    public function courses($action = null, $id = null)
    {
        if(!Auth::logged_in()) {
            message('Please login to view the profile section');
            redirect('login'); 
        }

        $data['title'] = "Courses";
        $data['action'] = $action;
        $data['id'] = $id;
        //$data['errors'] = $user->errors;

        $this->view('admin/courses', $data);
    }
}