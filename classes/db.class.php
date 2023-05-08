<?php

class DB {
    protected static $instance;
    protected static $table;
    protected static $con;
    protected $query;
    protected $query_type = "select";
    protected $values = array();

    /*
    *   The function below  is to define the variable values, 
    *   connect to the database, and to instance the class.
    */
    public static function table($table)
    {
        self::$table = $table;
        if(!self::$instance){
            self::$instance = new self();
        }
        if(!self::$con){
            try {
                $string = "mysql:host=".DBHOST.";dbname=".DBNAME;
                self::$con = new PDO($string, DBUSER, DBPASS);
            } catch (PDOException $e) {
                $e->getMessage();
                die;
            }
        }
        return self::$instance;
    }
    /*
    * This function will execute the query in the database
    */
    protected function run($values = array())
    {
        $stmt = self::$con->prepare($this->query);
        $check = $stmt->execute($values);
        if($check){
            switch ($this->query_type) {
                case 'select':
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                    if(is_array($data) && count($data) > 0){
                        return $data;
                    }
                    break;
                case 'update':
                    return true;
                    break;
                case 'insert':
                    return true;
                    break;
                case 'delete':
                    return true;
                    break;
                default:
                    # code...
                    break;
               }
          
        }
    }
    //This function is for adding order by to the query.
    public function order_by($order)
    {
        $this->query .= " ORDER BY ". $order . " ";
        return self::$instance;
    }
    //This function is for adding limit to the query.
    public function limit($limit = '')
    {   
        if($limit == NULL)
        {
            return $this->run();
        }
        else 
        {
            $this->query .= "LIMIT " . $limit;
            return $this->run();
        }
    }
    /*
    * This function will return all data
    */
    public function all()
    {
        return $this->run();
    }
    /*
    *   This function will set the query for selecting from the table.
    */
    public function select()
    {
        $this->query_type = "select";

        $this->query = "SELECT * FROM " . self::$table . " ";
        return self::$instance;
    }
    /*
    *   This function will update the data
    */
    public function update(array $values)
    {
        $this->query_type = "update";
        $this->query = "UPDATE " . self::$table . " SET ";

        foreach($values as $key => $value){
            $this->query .= "$key" . " = :" .$key . ",";
        }
            $this->query = rtrim($this->query, ",");
            $this->values = $values;
        return self::$instance;

    }
    /*
    *   This function will insert the data  into the database.
    */
    public function insert(array $values)
    {
        $this->query_type = "insert";
        $this->query = "INSERT INTO " . self::$table . " (";
        foreach($values as $key => $value){
            $this->query .= $key . ",";
        }
        $this->query = rtrim($this->query, ",");
        $this->query .= ") VALUES (";
        foreach($values as $key => $value){
            $this->query .=  ":" . $key . "," ;
        }
        $this->query = rtrim($this->query, ",");
        $this->query .= ")";
        $this->values = $values;
        return $this->run($this->values);
    }
    /*
    *   This function will add a where clause to the query.
    */
    public function where($where, $values = array())
    {
        switch ($this->query_type) {
            case 'select':
                $this->query .= " WHERE " . $where;
                return $this->run($values);
                break;
            case 'update':
                // It will merge the array of columns data want to update and the where condition array data
                $values = array_merge($this->values, $values);
                $this->query .= " WHERE " . $where;
                return $this->run($values);
                break; 
            default:
                # code...
                break;
        }
    }
    /*
    *   This function for is setting complex sql for querying data.    
    */
    public function query($query, $values = array())
    {
        $stmt = self::$con->prepare($query);
        $check = $stmt->execute($values);
        if($check){
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }
        return false;
    }
    // public function insert_get_id()
    // {
    //     $stmt = self::$con->prepare($query);
    //     $check = $stmt->execute($values);
    //     $insert_id = 
    // }
    // This function for declaring a function that is not existing but can be excute depends on the last charatecter of the function is existing in the databse table.
    public function __call($function, $params)
    { 
        $value = sanitize_input($params[0]);
        $column = str_replace("get_by_", "", $function);
        $arr = explode("_", $column);
        $tbl_col = addslashes($arr[0]);
        $check = self::table($arr[1])->query("SHOW COLUMNS FROM " . $arr[1]);
        $check_col = array_column($check, "Field");
        if(in_array($arr[0], $check_col)){
            return DB::table($arr[1])->select()->where($arr[0] . " = :" . $arr[0], [$arr[0] => $value]);
        } 
        return false;
    }
    
    // This is for calling a non-existing function for getting the data.
    public function get_order_by(string $table, $order, $limit = '')
    {
        return self::table($table)->select()->order_by($order)->limit($limit);
    }
}