<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/12/2018
 * Time: 5:39 PM
 */

$path = $_POST['path'];

$return_text = 0;

if (file_exists($path)) {

    unlink($path);

    $return_text = 1;
} else {

    $return_text = 0;
}

echo $return_text;