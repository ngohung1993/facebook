<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/12/2018
 * Time: 5:39 PM
 */

$files = [];

if (is_array($_FILES)) {

    foreach ($_FILES['files']['name'] as $name => $value) {
        $filename = $_FILES['files']['name'][$name];

        $location = '../advertises/' . $filename;
        $uploadOk = 1;

        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            $uploadOk = 0;
        }

        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$name], $location)) {
                $files[] = $filename;
            }
        }
    }
}

header('Content-type: application/json');
echo json_encode($files);
