<?php 

namespace Model;

use \Database;

class Model extends Database
{
    protected $table = "";
    protected $allowedColumns = [];
    protected $afterSelect = [];

    public function insert($data) {
        //remove unwanted columns

        if(!empty($this->allowedColumns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO " . $this->table;
        $query .= " (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ");";

        $this->query($query, $data);
    }

    public function update($id, $data) {
        //remove unwanted columns

        if(!empty($this->allowedColumns)) {
            foreach($data as $key => $value) {
                if(!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "UPDATE " . $this->table . " SET ";
        foreach($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " WHERE id = :id ";

        $data['id'] = $id;

        // show($query);
        // show($data);

        $this->query($query, $data);
    }

    public function where($data, $order = 'DESC', $limit = 10, $offset = 0) {
        $keys = array_keys($data);
        $query = "SELECT * FROM " . $this->table . " WHERE ";
        
        foreach($keys as $key) {
            $query .= $key . "=:" . $key . " AND ";
        };

        $query = trim($query, "AND ");
        $query .= " ORDER BY id $order limit $limit";

        $res = $this->query($query, $data);
        if(is_array($res)) {
            //run afterSelect func
            if(property_exists($this, 'afterSelect')) {
                foreach($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }

            return $res;
        }

        return false;
    }

    public function findAll($order = 'DESC') {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id $order";
        
        $res = $this->query($query);

        if(is_array($res)) {
            if(property_exists($this, 'afterSelect')) {
                foreach($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }

            return $res;
        }

        return false;
    }

    public function first($data, $order = "DESC") {
        $keys = array_keys($data);
        $query = "SELECT * FROM " . $this->table . " WHERE ";
        
        foreach($keys as $key) {
            $query .= $key . "=:" . $key . " AND ";
        };

        $query = trim($query, "AND ");
        $query .= " ORDER BY id $order LIMIT 1";

        $res = $this->query($query, $data);
        if(is_array($res)) {
            //run afterSelect func
            if(property_exists($this, 'afterSelect')) {
                foreach($this->afterSelect as $func) {
                    $res = $this->$func($res);
                }
            }

            return $res[0];
        }

        return false;
    }
}