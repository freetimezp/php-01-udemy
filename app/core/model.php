<?php 

class Model extends Database
{
    protected $table = "";

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
}