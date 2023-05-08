<?php

class Gallery extends DB{

    protected static $instance;

    
    public static function action()
    {
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    //Inserting the file data into the database and into the directory if the checking data is success.
    public function create($check = true)
    {
        $isValid = $check;//store the boolean ex. true or false, the default is true
        $errors = array();//storage of the errors check.
        $images = array();//storage of the file name of the images
        $image_tmp =array();//storage of the tmp name file of the images.
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
                $images['image' .$i] = $unicode . "_" . $i . "." . $file_extension;
                //Check if the $file_extension value are exist in the value of $allowed_extension, if not exist, add the message string into the $errors array.
                if (!in_array($file_extension, $allowed_extensions)) {
                    $errors[] = "Destination image " . $i . " must be a JPG, JPEG, or PNG file.";
                    $isValid = false;
                }
           
                // Check if the file size is within the allowed limit (e.g., 2MB)
                $max_size = 2 * 1024 * 1024; // 2MB
                if ($image_size > $max_size) {
                    $errors[] = "Destination image " . $i . " exceeds the maximum file size of 2MB.";
                    $isValid = false;
                }
                
                // Check if the file is a valid image
                if (!getimagesize($image_tmp[$i-1])) {
                    $errors[] = "Destination image " . $i . " is not a valid image file.";
                    $isValid = false;
                }
                //Check if the input field of files is empty, if it is empty the error will be equal to 4 and add the message into the $errors array.
            } elseif ($_FILES['image' . $i]['error'] === 4) {
                $errors[] = "Destination image " . $i . " is required.";
                $isValid = false;
            }
        }
        pr($image_tmp);
        pr($images);
        // If all files are valid, proceed with storing them in the database
        if ($isValid) {
            // Move the uploaded files to the desired location and insert their paths into the database
            for($i = 1;$i <= 4;$i++){
                move_uploaded_file($image_tmp[$i-1], "../img/tourist-spot/" . $images['image'. $i]);
            }
            //Merge the two array before inserting into the database.
            $images = array_merge($images, ['touristId' => $_SESSION['destination_id'], "date_posted" => date('Y-m-d H:i:s')]);
            // Insert code to handle database insertion
                DB::table("gallery")->insert($images);
                unset($_SESSION['destination_id']);
            // Redirect or display a success message
            // ...
        } else {
            //Return the $errors array if the if condition is false to render the errors in the forms.
           return $errors;
        }
    }
    // public function create()
    // {
    //     $errors = array();
    //     $isValid = true;
    
    //     for ($i = 1; $i <= 4; $i++) {
    //         if (isset($_FILES['image' . $i]['name'])) {
    //             $image = $_FILES['image' . $i]['name'];
    //             $imageTmp = $_FILES['image' . $i]['tmp_name'];
    
    //             if ($imageTmp && $imageTmp != ''g) {
    //                 $images_check = getimagesize($imageTmp);
    //                 if ($images_check === false) {
    //                     $errors[] = "File must be an image with the extension of .jpg or .png";
    //                     $isValid = false;
    //                 } else {
    //                     $extension = pathinfo($image, PATHINFO_EXTENSION);
    //                     if (!in_array(strtolower($extension), ['jpg', 'png'])) {
    //                         $errors[] = "Invalid file extension. Only .jpg and .png files are allowed.";
    //                         $isValid = false;
    //                     } else {
    //                         // Move the uploaded file to the desired location
    //                         $unicode = uniqid();
    //                         $destination = $unicode . "_" . $i . "." . $extension;
    //                         if (move_uploaded_file($imageTmp, "../img/tourist-spot/" .$destination)) {
    //                             // File moved successfully, save the file path in the database
    //                             $arr["image" . $i] = $destination;
    //                         } else {
    //                             $errors[] = "Failed to move the uploaded file.";
    //                             $isValid = false;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    
    //     if ($isValid) {
    //         // Insert $arr into the database
    //         DB::table("gallery")->insert($arr);
    //         unset($_SESSION['destination_id']);
    //     }
    
    //     return $errors;
    // }
    

    public function select()
    {
        return DB::table("gallery")->select()->all();
    }
    public function delete()
    {

    }
    
}

?>