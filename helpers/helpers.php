<?php
    /*
    *   This function will sanitize the user input to prevent user from inputting inapropriate data *   such as lilnk from pornographic video.
    */
    function sanitize_input($input)
    {   
        // Remove any HTML tags and attributes
        $input = strip_tags($input);
        // Remove any ASCII control characters, except for line breaks
        $input = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]+/u', '', $input);
        // Replace any instances of null bytes with a string representation
        $input = str_replace("\o", "[NULL]",$input);
        // Remove any backslashes
        $input = stripslashes($input);
        // Convert any special characters to HTML entities
        $input = htmlentities($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return $input;
    }
    //This function is for debugging purpose.
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    //This function is for debugging pupose.
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
    //This function is for error handling.
    function err_message(array $errors)
    {   
        
        echo "<ul class='alert alert-danger pl-5'>";
        foreach($errors as $error){
            echo "<li>". $error ."</li>";
        }
        echo "</ul>";
    }
    function navActive($fileName,$active)
    {
       return basename($_SERVER['PHP_SELF']) == $fileName ? $active : '';
    }
    function format_date($date)
    {
        $date = new DateTime($date);
        $formatted_date = $date->format('l jS \of F Y h:i:s A');
        return $formatted_date;
    } 
    function success_message()
    {
        if(isset($_SESSION['success_message'])){
           echo '<div class="alert alert-success" role="alert">'.$_SESSION['success_message'].'</div>';
            unset($_SESSION['success_message']);
        }
        return false;
    }
    //This function will extract the code from the youtube link and return the code.
    function isYoutubeVideoLink($yt)
    {
        $pattern = "/^.*(youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/";
        preg_match($pattern, $yt, $url_matches);
        $v = $url_matches[2];
        return $v;
    }
?>