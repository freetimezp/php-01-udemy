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

        //categories table
        $query = "
        CREATE TABLE IF NOT EXISTS `categories` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `category` varchar(50) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `category` (`category`),
            KEY `disabled` (`disabled`)
           ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //courses table
        $query = "
        CREATE TABLE IF NOT EXISTS `courses` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `title` varchar(100) NOT NULL,
            `description` text DEFAULT NULL,
            `user_id` int(11) NOT NULL,
            `category_id` int(11) NOT NULL,
            `sub_category_id` int(11) DEFAULT NULL,
            `level_id` int(11) DEFAULT NULL,
            `language_id` int(11) DEFAULT NULL,
            `price_id` int(11) DEFAULT NULL,
            `promo_link` varchar(1024) DEFAULT NULL,
            `course_image` varchar(1024) DEFAULT NULL,
            `course_promo_video` varchar(1024) DEFAULT NULL,
            `primary_subject` varchar(255) DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            `tags` varchar(2048) DEFAULT NULL,
            `congratulations_message` varchar(2048) DEFAULT NULL,
            `welcome_message` varchar(2048) DEFAULT NULL,
            `approved` tinyint(1) NOT NULL DEFAULT 0,
            `published` tinyint(1) NOT NULL DEFAULT 0
            PRIMARY KEY (`id`),
            KEY `title` (`title`),
            KEY `user_id` (`user_id`),
            KEY `category_id` (`category_id`),
            KEY `sub_category_id` (`sub_category_id`),
            KEY `level_id` (`level_id`),
            KEY `language_id` (`language_id`),
            KEY `price_id` (`price_id`),
            KEY `primary_subject` (`primary_subject`),
            KEY `date` (`date`),
            KEY `approved` (`approved`),
            KEY `published` (`published`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //prices table
        $query = "
        CREATE TABLE IF NOT EXISTS `prices` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(40) NOT NULL,
            `price` decimal(10,0) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `name` (`name`),
            KEY `price` (`price`),
            KEY `disabled` (`disabled`),
            KEY `disabled_2` (`disabled`)
           ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //insert into prices table
        $query = "
        INSERT INTO `prices` (`id`, `name`, `price`, `disabled`) VALUES (1, 'Free', '0', 0);
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