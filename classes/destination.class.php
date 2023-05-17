<?php

class Destination extends DB {
    
    protected static $instance;
    /*
    *   This function is for instantiate the class for chaining.
    */
    public static function action()
    {
        if(!self::$instance){
            self::$instance = new self();
        }
       return self::$instance; 
    }

    // This function is to check the data then to insert data into the database. 
    
    public function create($POST)
    {
        //Storage of the error.
        $errors = array();
        //Regular expression pattern for matching the data if a youtube or not.
        $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[a-zA-Z0-9_-]{11}/i';
        if(!empty($POST)){
        //Store the data into the array $arr.
        $arr['name'] = sanitize_input($POST['name']);
        $arr['description'] = sanitize_input($POST['description']);
        $arr['purok'] = sanitize_input($POST['purok']);
        $arr['cat_id'] = sanitize_input($POST['category']);
        $arr['barangay'] = sanitize_input($POST['barangay']);
        $arr['city_mun'] = sanitize_input($POST['city_mun']);
        $arr['guides'] = sanitize_input($POST['guides']);
        $arr['youtube_url'] = $POST['yt_link'];
        $arr['date_posted'] = date('Y-m-d H:i:s');
        //Check if youtube_url empty
        if(empty($arr['youtube_url'])){
            $errors[] = "Youtube video link is required";
        }
        //Check if yt_link is a youtube link
        if(!preg_match($pattern, $POST['yt_link'])){
            $errors[] = "Link must be a youtube video";
        }
        //Check if the name is empty
        if(empty($arr['name'])){
            $errors[] = "Name is required";
        }
        //chjeck if the length of the description is exceed of 400 characters
        if(strlen($arr['description']) > 400){
            $errors[] = "Description must not exceed of 400 characters";
        }
        //Check if the description is empty
        if(empty($arr['description'])){
            $errors[] = "Description is required";
        }
        //Check if the guides is empty
        if(empty($arr['guides'])){
            $errors[] = "Guides is required";
        }
        //Check if the purok is empty
        if(empty($arr['purok'])){
            $errors[] = "Purok is required";
        }
        //Check if the cat_id is empty
        if(empty($arr['cat_id'])){
            $errors[] = "Category is required";
        }
        //Check if the barangay is empty
        if(empty($arr['barangay'])){
            $errors[] = "Barangay is required";
        }
        //check if the city_mun is empty 
        if(empty($arr['city_mun'])){
            $errors[] = "Municipality/City is required";
        }
        //check if the guides length is exceed of 400 characters 
        if(strlen($arr['guides']) > 400){
          $errors[] = "Guides must not exceed of 400 characters";
        }
        //check if the $errors equals to 0
        if(count($errors) == 0){
            DB::table("destination")->insert($arr);
            return self::$con->lastInsertId();
            
        }
    }
        //If the $errors is not equal to zero , return the $errors so it can render into the form.
        return $errors;
    }
    
    //This function will return all data from the database table destination/
    
}
?>