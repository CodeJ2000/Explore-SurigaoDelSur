<?php
class Category extends DB {
    protected static $instance;
    //This is for instantiate the class
    public static function action()
    {
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    // This function is for insert data into the database
    public function create($values)
    {   
        return DB::table("category")->insert($values);
    } 
    //This function is for selecting or read the data from the database
    public function select()
    {
        return DB::table("category")->select();
    }
    
    //This function is for updating the data in the database table
    public function update($values)
    {
        return DB::table("category")->update($values);
    }
    //This function is for delete the data from the database.
    public function delete()
    {
        return DB::table("category")->delete();
    } 
}