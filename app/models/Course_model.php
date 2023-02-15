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
        'subtitle',
        'currency_id',
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

        if(empty($data['primary_subject'])) {
            $this->errors['primary_subject'] = "Course primary subject is required.";
        }else if(!preg_match("/^[a-zA-Z \-\_\&]+$/", trim($data['primary_subject']))) {
            $this->errors['primary_subject'] = "Use letters, spaces and [-_&] in primary subject.";
        }

        if(empty($data['category_id'])) {
            $this->errors['category_id'] = "Choose Category..";
        }

        if(empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function edit_validate($data, $id = null)
    {
        $this->errors = [];
        
        if(empty($data['title'])) {
            $this->errors['title'] = "Course title is required.";
        }else if(!preg_match("/^[a-zA-Z \-\_\&]+$/", trim($data['title']))) {
            $this->errors['title'] = "Use letters, spaces and [-_&] in title.";
        }

        if(empty($data['primary_subject'])) {
            $this->errors['primary_subject'] = "Course primary subject is required.";
        }else if(!preg_match("/^[a-zA-Z \-\_\&]+$/", trim($data['primary_subject']))) {
            $this->errors['primary_subject'] = "Use letters, spaces and [-_&] in primary subject.";
        }

        if(empty($data['category_id'])) {
            $this->errors['category_id'] = "Choose Category..";
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
        $db = new Database();
        
        if(!empty($rows[0]->price_id)) {
            foreach($rows as $key => $row) {
                $query = "SELECT * FROM prices WHERE id = :id LIMIT 1";
                
                $price = $db->query($query, ['id' => $row->price_id]);
                if(!empty($price)) {
                    $price[0]->name = $price[0]->name . ' ($ ' . $price[0]->price . ')';
                    $rows[$key]->price_row = $price[0];
                }
            }
        }
        
        
        return $rows;
    }

    protected function get_level($rows) {
                
        return $rows;
    }

    protected function get_language($rows) {
        
        return $rows;
    }
}