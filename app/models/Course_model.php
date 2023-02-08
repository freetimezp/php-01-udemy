<?php

class Course_model extends Model
{
    public $errors = [];
    protected $table = 'courses';
    protected $allowedColumns = [
        'title',
        'description',
        'user_id',
        'category_id',
        'sub_category_id',
        'level_id',
        'language_id',
        'price_id',
        'promo_link',
        'course_image',
        'course_promo_video',
        'primary_subject',
        'date',
        'tags',
        'congratulations_message',
        'welcome_message',
        'approved',
        'published', 																			
    ];

    protected $afterSelect = [
        'get_category',
        'get_sub_category',
        'get_user',
        'get_price',
        'get_level',
        'get_language',
    ];
    protected $beforeUpdate = [];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['title'])) {
            $this->errors['title'] = "Course title is required.";
        }else if(!preg_match("/^[a-zA-Z \-\_\&]+$/", trim($data['title']))) {
            $this->errors['title'] = "Use letters, spaces and [-_&] in title.";
        }

        if(empty($data['category_id'])) {
            $this->errors['category_id'] = "Choose Category..";
        }

        if(empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function edit_validate($data, $id)
    {
        $this->errors = [];

            if(empty($data['firstname'])) {
                $this->errors['firstname'] = "A first name is required.";
            }else if(!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
                $this->errors['firstname'] = "Use only letters in firstname.";
            }
  
            if(empty($data['lastname'])) {
                $this->errors['lastname'] = "A last name is required.";
            }else if(!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
                $this->errors['lastname'] = "Use only letters in lastname.";
            }
            
            //check email
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "This email is not valid";
            }else if($results = $this->where(['email' => $data['email']])) {
                foreach($results as $result) {
                    if($id != $result->id) {
                        $this->errors['email'] = "That email is already exist";
                    }
                }
            }
              
            if(!empty($data['phone'])) {
                if(!preg_match("/^(0|\+380)[0-9]{9}$/", trim($data['phone']))) {
                    $this->errors['phone'] = "Phone number is not valid..";
                }
            }
    
            if(!empty($data['facebook_link'])) {
                if(!filter_var($data['facebook_link'], FILTER_VALIDATE_URL)) {
                    $this->errors['facebook_link'] = "Facebook link is not valid..";
                }
            }
            if(!empty($data['instagram_link'])) {
                if(!filter_var($data['instagram_link'], FILTER_VALIDATE_URL)) {
                    $this->errors['instagram_link'] = "Instagram link is not valid..";
                }
            }
            if(!empty($data['twitter_link'])) {
                if(!filter_var($data['twitter_link'], FILTER_VALIDATE_URL)) {
                    $this->errors['twitter_link'] = "Twitter link is not valid..";
                }
            }
            if(!empty($data['linkedin_link'])) {
                if(!filter_var($data['linkedin_link'], FILTER_VALIDATE_URL)) {
                    $this->errors['linkedin_link'] = "Linkedin link is not valid..";
                }
            }
        

        if(empty($this->errors)) {
            return true;
        }

        return false;
    }

    protected function get_category($rows) {
        
        return $rows;
    }

    protected function get_sub_category($rows) {
        $db = new Database();
        
        if(!empty($rows[0]->category_id)) {
            foreach($rows as $key => $row) {
                $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
                
                $cat = $db->query($query, ['id' => $row->category_id]);
                if(!empty($cat)) {
                    $rows[$key]->category_row = $cat[0];
                }
            }
        }

        return $rows;
    }

    protected function get_user($rows) {
        $db = new Database();
        
        if(!empty($rows[0]->user_id)) {
            foreach($rows as $key => $row) {
                $query = "SELECT firstname, lastname, role FROM users WHERE id = :id LIMIT 1";
                
                $user = $db->query($query, ['id' => $row->user_id]);
                if(!empty($user)) {
                    $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
                    $rows[$key]->user_row = $user[0];
                }
            }
        }

        return $rows;
    }

    protected function get_price($rows) {
                
        return $rows;
    }

    protected function get_level($rows) {
                
        return $rows;
    }

    protected function get_language($rows) {
        
        return $rows;
    }
}