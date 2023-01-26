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
    ];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['firstname'])) {
            $this->errors['firstname'] = "A first name is required.";
        }

        if(empty($data['lastname'])) {
            $this->errors['lastname'] = "A last name is required.";
        }

        if(empty($data['email'])) {
            $this->errors['email'] = "Email is required.";
        }

        //check email
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "This email is not valid";
        }else if($this->query($query, ['email' => $data['email']])) {
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

    
}