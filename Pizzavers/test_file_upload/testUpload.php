<?php

// Check if a file is being uploaded

if (isset($_FILES['fileToUpload'])) {

    // Get the uploaded file information

    $fileName = $_FILES['fileToUpload']['name'];

    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];

    $fileSize = $_FILES['fileToUpload']['size'];

    $fileError = $_FILES['fileToUpload']['error'];

    $fileType = $_FILES['fileToUpload']['type'];


    // Check if the file has been uploaded without errors

    if ($fileError == 0) {

        // Check if the file is an image

        $isImage = getimagesize($fileTmpName);

        if ($isImage != false) {

            // Create a unique name for the file and move it to the desired location

            $uniqueFileName = uniqid() . "_" . $fileName;

            $destinationPath = "../img/" . $uniqueFileName;

            if (move_uploaded_file($fileTmpName, $destinationPath)) {

                // The file has been successfully uploaded and moved to the desired location

                echo "The file has been uploaded successfully!";

            } else {

                // There was an error moving the uploaded file

                echo "Error uploading the file!";

            }

        } else {

            // The file is not an image

            echo "Invalid image file!";

        }

    } else {

        // There was an error uploading the file

        echo "Error uploading the file!";

    }

} else {

    // No file was uploaded

    echo "No file uploaded!";

}

?>