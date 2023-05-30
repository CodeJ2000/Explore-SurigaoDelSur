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
        $image_tmp =array();//storage of the tmp name file of the images.
        
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
        //Loop the the array for insert the file details.
        for ($i = 1; $i <= 4; $i++) {
            //Check if the $_FILES['image']['name'] is set and error is equal to zero before to proceed 
            if (isset($_FILES['image' . $i]['name']) && $_FILES['image' . $i]['error'] === 0) {
                //Store the file image name into the variable $image_name.
                $image_name = $_FILES['image' . $i]['name'];
                //Adding the file image tmp_name into the array $image_tmp every loop.
                $image_tmp[] = $_FILES['image' . $i]['tmp_name'];
                //Store the file image size into the variable $image_size.
                $image_size = $_FILES['image' . $i]['size'];
                //Store the file image type into the variable $image_type.
                $image_type = $_FILES['image' . $i]['type'];
                // Set an array $allowed_extension that have jpg, jpeg and png.  
                $allowed_extensions = array('jpg', 'jpeg', 'png');
                //Extract the extension of the $image_name and set to lowercase then store it in the variable $file_extension.
                $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                //Generate a unique code and store it in the $unicode.
                $unicode = uniqid();
                //Make a new file name that consist of unique code and concat the incrementing number of $i for uniqueness then concat the extension and add the new file name into the $images array. 
                $arr['image' .$i] = $unicode . "_" . $i . "." . $file_extension;
                //Check if the $file_extension value are exist in the value of $allowed_extension, if not exist, add the message string into the $errors array.
                if (!in_array($file_extension, $allowed_extensions)) {
                    $errors[] = "Destination image " . $i . " must be a JPG, JPEG, or PNG file.";
                }
           
                // Check if the file size is within the allowed limit (e.g., 2MB)
                $max_size = 2 * 1024 * 1024; // 2MB
                if ($image_size > $max_size) {
                    $errors[] = "Destination image " . $i . " exceeds the maximum file size of 2MB.";
                }
                
                // Check if the file is a valid image
                if (!getimagesize($image_tmp[$i-1])) {
                    $errors[] = "Destination image " . $i . " is not a valid image file.";
                }
                //Check if the input field of files is empty, if it is empty the error will be equal to 4 and add the message into the $errors array.
            } elseif (isset($_FILES['image' . $i]['name']) && $_FILES['image' . $i]['error'] === 4) {
                $errors[] = "Destination image " . $i . " is required.";
            }
        }
        //check if the $errors equals to 0
        if(count($errors) == 0){
            for($i = 1;$i <= 4;$i++){
                move_uploaded_file($image_tmp[$i-1], "../img/tourist-spot/" . $arr['image'. $i]);
            }
            DB::table("destination")->insert($arr);
            $_SESSION['success_message'] = "Destination Successfully added";
            header("Location: tourist-table.php");
            exit;
        }
         //If the $errors is not equal to zero , return the $errors so it can render into the form.
         return $errors;
        }
    }
    
    public function update_destination($POST, $id)
    {
        //Storage of the error.
        $id = sanitize_input($id);
        $errors = array();
        $image_tmp =array();//storage of the tmp name file of the images.
        
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
        //Loop the the array for insert the file details.
        for ($i = 1; $i <= 4; $i++) {
            //Check if the $_FILES['image']['name'] is set and error is equal to zero before to proceed 
            if (isset($_FILES['image' . $i]['name']) && $_FILES['image' . $i]['error'] === 0) {
                //Store the file image name into the variable $image_name.
                $image_name = $_FILES['image' . $i]['name'];
                //Adding the file image tmp_name into the array $image_tmp every loop.
                $image_tmp[] = $_FILES['image' . $i]['tmp_name'];
                //Store the file image size into the variable $image_size.
                $image_size = $_FILES['image' . $i]['size'];
                //Store the file image type into the variable $image_type.
                $image_type = $_FILES['image' . $i]['type'];
                // Set an array $allowed_extension that have jpg, jpeg and png.  
                $allowed_extensions = array('jpg', 'jpeg', 'png');
                //Extract the extension of the $image_name and set to lowercase then store it in the variable $file_extension.
                $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                //Generate a unique code and store it in the $unicode.
                $unicode = uniqid();
                //Make a new file name that consist of unique code and concat the incrementing number of $i for uniqueness then concat the extension and add the new file name into the $images array. 
                $arr['image' .$i] = $unicode . "_" . $i . "." . $file_extension;
                //Check if the $file_extension value are exist in the value of $allowed_extension, if not exist, add the message string into the $errors array.
                if (!in_array($file_extension, $allowed_extensions)) {
                    $errors[] = "Destination image " . $i . " must be a JPG, JPEG, or PNG file.";
                }
           
                // Check if the file size is within the allowed limit (e.g., 2MB)
                $max_size = 2 * 1024 * 1024; // 2MB
                if ($image_size > $max_size) {
                    $errors[] = "Destination image " . $i . " exceeds the maximum file size of 2MB.";
                }
                
                // Check if the file is a valid image
                if (isset($image_tmp[$i - 1]) && !getimagesize($image_tmp[$i-1])) {
                    $errors[] = "Destination image " . $i . " is not a valid image file.";
                }
                //Check if the input field of files is empty, if it is empty the error will be equal to 4 and add the message into the $errors array.
                if(count($errors) == 0){
                    if(move_uploaded_file($image_tmp[$i-1], "../img/tourist-spot/" . $arr['image'. $i])){
                        echo "success";
                        exit();
                    } else {
                        echo "failed";
                        exit;
                    }
                    
                }
            } 

        }
        //check if the $errors equals to 0
        if(count($errors) == 0){
            DB::table("destination")->update($arr)->where("id = :id", ['id' => $id]);
            $_SESSION['success_message'] = "Destination Successfully updated";
            header("Location: tourist-table.php");
            exit;
        }
         //If the $errors is not equal to zero , return the $errors so it can render into the form.
         return $errors;
        }
    }
    public function soft_delete(array $arr, int $id)
    {
        $id = sanitize_input($id);
        DB::table("destination")->update($arr)->where("id = :id", ["id" => $id]);
    }
  
}
?>