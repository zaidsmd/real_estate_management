<?php
include "dbconfig.php";
$title = $_POST["title"];
$description = $_POST["description"];
$area = $_POST["area"];
$adresse = $_POST["adresse"];
$price = $_POST["price"];
$type = $_POST["type"];
$id = $_POST["annonce_id"];
$directory = "../pictures/";
$image_name = basename($_FILES["image"]["name"]);
$image_Path = $directory.$image_name;
// I had to check here if the user want to change photo or not if not then he doesn't have to upload the picture again.
if ($image_name!=''){
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_Path)){
        $statement = $conn->prepare("UPDATE `annonces` SET `annonce_title`='$title',`annonce_image`='$image_name',`annonce_description`='$description',`annonce_area`='$area',`annonce_adresse`='$adresse',`annonce_date`=curdate(),`annonce_price`='$price',`annonce_type`='$type' WHERE `annonce_id`=$id");
        $statement->execute();
        header('Location:../index.php');
        exit();
    }else {
        echo "there was error uploading your photo";
    }
}else {
    $statement = $conn->prepare("UPDATE `annonces` SET `annonce_title`='$title',`annonce_description`='$description',`annonce_area`='$area',`annonce_adresse`='$adresse',`annonce_price`='$price',`annonce_date`=curdate(),`annonce_type`='$type' WHERE `annonce_id`=$id");
    $statement->execute();
    header('Location:../index.php');
    exit();
}