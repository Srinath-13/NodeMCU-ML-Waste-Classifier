<?php
  // based on PHP File Upload basic example https://www.w3schools.com/php/php_file_upload.asp

  date_default_timezone_set('Asia/Jakarta');  //--> Adjust to your time zone.
  $target_dir = "captured_images/"; //--> Folder to store images.
  $date   = new DateTime(); //--> this returns the current date time.
  $date_string = $date->format('Y-m-d_His ');
  $target_file = $target_dir . $date_string. basename($_FILES["imageFile"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $file_name = pathinfo($target_file,PATHINFO_BASENAME) ; 

  // Check if image file is a actual image or fake image.
  if(isset($_POST["imageFile"])) {	
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
      if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
      } else {
      echo "File is not an image.";
      $uploadOk = 0;
      }
  }

  // Check if file already exists.
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size.
  if ($_FILES["imageFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats.
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error.
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file.
  } else {
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
      // echo "Photos successfully uploaded to the server with the name : " .$file_name;
      // Specify the file path of the image to be sent
        $image_path = $target_dir.$file_name;
        // Set the URL of the Flask server endpoint
        $server_url = "http://127.0.0.1:5000/api/image";
        // Create a cURL handle
        $ch = curl_init();
        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $server_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => new CURLFILE($image_path)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Send the POST request
        $result = curl_exec($ch);
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            echo $result;
        }
        // Close the cURL handle
        curl_close($ch);
    } else {
      echo "Sorry, there was an error in the photo upload process.";
    }
  }
?>