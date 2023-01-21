<?php 

Class Database 
{
    public function connect() {
        try {
            $string = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
            return $db = new PDO($string, DB_USER, DB_PASS);
            //show($db);
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query, $data = [], $type = 'object') {
        $con = $this->connect();
        //show($con);

        $stm = $con->prepare($query);
        if($stm) {
            $check = $stm->execute($data);
            if($check) {
                if($type == 'object') {
                    $type = PDO::FETCH_OBJ;
                }else{
                    $type = PDO::FETCH_ASSOC;
                }
                $result = $stm->fetchAll($type);
                if(is_array($result) && count($result) > 0) {
                    return $result;
                }
            }
        }

        return false;
    }

    public function create_tables() {
        //users table
        $query = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `email` varchar(100) NOT NULL,
                `firstname` varchar(20) NOT NULL,
                `lastname` varchar(30) NOT NULL,
                `password` varchar(255) NOT NULL,
                `role` varchar(20) NOT NULL,
                `date` date DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `email` (`email`),
                KEY `firstname` (`firstname`),
                KEY `lastname` (`lastname`),
                KEY `date` (`date`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ";

        $this->query($query);
    }

    public function read($query, $data = []) {
        $DB = $this->connect();
        //show($DB);
        $stm = $DB->prepare($query);

        if(count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if($stm) {
                $check = 1;
            }
        }else{
            $check = $stm->execute($data);
        }

        if($check) {
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }

    public function write($query, $data = []) {
        $DB = $this->connect();
        //show($DB);
        $stm = $DB->prepare($query);

        if(count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if($stm) {
                $check = 1;
            }
        }else{
            $check = $stm->execute($data);
        }

        if($check) {
            return true;
        }else{
            return false;
        }
    }
}