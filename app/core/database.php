<?php

class Database
{
    protected $afterSelect = [];

    public function connect()
    {
        try {
            $string = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
            return $db = new PDO($string, DB_USER, DB_PASS);
            //show($db);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query, $data = [], $type = 'object')
    {
        $con = $this->connect();
        //show($con);

        $stm = $con->prepare($query);
        if ($stm) {
            $check = $stm->execute($data);
            if ($check) {
                if ($type == 'object') {
                    $type = PDO::FETCH_OBJ;
                } else {
                    $type = PDO::FETCH_ASSOC;
                }
                $result = $stm->fetchAll($type);
                if (is_array($result) && count($result) > 0) {
                    //run afterSelect func
                    if (property_exists($this, 'afterSelect')) {
                        foreach ($this->afterSelect as $func) {
                            $result = $this->$func($result);
                        }
                    }

                    return $result;
                }
            }
        }

        return false;
    }

    public function create_tables()
    {
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

        //insert into categories table
        $query = "
        INSERT INTO `categories` (`id`, `category`, `disabled`) VALUES
            (1, 'Development', 0),
            (2, 'Business', 0),
            (3, 'Finance & Accounting', 0),
            (4, 'IT & Software', 0),
            (5, 'Office Productivity', 0),
            (6, 'Personal Development', 0),
            (7, 'Design', 0),
            (8, 'Marketing', 0),
            (9, 'Lifestyle', 0),
            (10, 'Photography & Video', 0),
            (11, 'Health & Fitness', 0),
            (12, 'Music', 0),
            (13, 'Teaching & Academics', 0),
            (14, 'I dont know yet..', 0);
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
            `published` tinyint(1) NOT NULL DEFAULT 0,
            `subtitle` varchar(1024) DEFAULT NULL,
            `currency_id` int(11) DEFAULT NULL
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

        //insert into courses table
        $query = "
        INSERT INTO `courses` (`id`, `title`, `description`, `user_id`, `category_id`, `sub_category_id`, `level_id`, `language_id`, `price_id`, `promo_link`, `course_image`, `course_promo_video`, `primary_subject`, `date`, `tags`, `congratulations_message`, `welcome_message`, `approved`, `published`, `subtitle`, `currency_id`) VALUES
        (1, 'test', NULL, 1, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2023-02-08 18:37:03', NULL, NULL, NULL, 0, 0, '', 0),
        (5, 'Photography for begginers', 'some descr', 1, 10, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Photography', '2023-02-09 17:47:46', NULL, NULL, NULL, 0, 0, '', 0);               
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

        //course levels table
        $query = "
        CREATE TABLE IF NOT EXISTS `course_levels` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `level` varchar(30) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `level` (`level`)
           ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //insert into course levels table
        $query = "
        INSERT INTO `course_levels` (`id`, `level`, `disabled`) VALUES
            (1, 'Beginner Level', 0),
            (2, 'Intermediate Level', 0),
            (3, 'Expert Level', 0),
            (4, 'All Levels', 0);
        ";

        $this->query($query);


        //currencies table
        $query = "
        CREATE TABLE IF NOT EXISTS `currencies` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `currency` varchar(20) NOT NULL,
            `symbol` varchar(4) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `disabled` (`disabled`)
           ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //insert into currencies table
        $query = "
        INSERT INTO `currencies` (`id`, `currency`, `symbol`, `disabled`) VALUES
            (1, 'US Dollar', '$', 0);
        ";

        $this->query($query);

        //languages table
        $query = "
        CREATE TABLE IF NOT EXISTS `languages` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `symbol` varchar(10) NOT NULL,
            `language` varchar(30) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `disabled` (`disabled`)
           ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8
        ";

        $this->query($query);

        //insert into languages table
        $query = "
        INSERT INTO `languages` (`id`, `symbol`, `language`, `disabled`) VALUES
            (1, 'uk_UA', 'РЈРєСЂР°С—РЅСЃСЊРєР°', 0),
            (2, 'us_US', 'USA', 0),
            (3, 'ru_RU', 'Р СѓСЃСЃРєРёР№', 0);
        ";

        $this->query($query);
    }

    public function read($query, $data = [])
    {
        $DB = $this->connect();
        //show($DB);
        $stm = $DB->prepare($query);

        if (count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if ($stm) {
                $check = 1;
            }
        } else {
            $check = $stm->execute($data);
        }

        if ($check) {
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }

    public function write($query, $data = [])
    {
        $DB = $this->connect();
        //show($DB);
        $stm = $DB->prepare($query);

        if (count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if ($stm) {
                $check = 1;
            }
        } else {
            $check = $stm->execute($data);
        }

        if ($check) {
            return true;
        } else {
            return false;
        }
    }
}
