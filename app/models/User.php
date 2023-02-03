<?php

class User extends Model
{
    public $errors = [];
    protected $table = 'users';
    protected $allowedColumns = [
        'email',
        'firstname',
        'lastname',
        'password',
        'role',
        'date',
        'image',
        'about',
        'company',
        'job',
        'country',
        'address',
        'phone',
        'slug',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'linkedin_link',
    ];

    public function validate($data)
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

        if(empty($data['email'])) {
            $this->errors['email'] = "Email is required.";
        }

        //check email
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "This email is not valid";
        }else if($this->where(['email' => $data['email']])) {
            $this->errors['email'] = "This email already exist!";
        }

        if(empty($data['password'])) {
            $this->errors['password'] = "A password is required.";
        }

        if($data['password'] !== $data['retype_password']) {
            $this->errors['retype_password'] = "A retype password is not valid.";
        }

        if(empty($data['terms'])) {
            $this->errors['terms'] = "Please accept the terms and conditions.";
        }


        if(empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function edit_validate($data)
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
            }
                
            if(!preg_match("/^(0|\+380)[0-9]{9}$/", trim($data['phone']))) {
                $this->errors['phone'] = "Phone number is not valid..";
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
}