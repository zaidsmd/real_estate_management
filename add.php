<?php
include "dbconfig.php";
$title = $_POST["title"];
$description = $_POST["description"];
$area = $_POST["area"];
$adresse = $_POST["adresse"];
$price = $_POST["price"];
$type = $_POST["type"];
$directory = "pictures/";
$image_name = basename($_FILES["image"]["name"]);
$image_Path = $directory.$image_name;
if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_Path)){
    $statement = $conn->prepare("INSERT INTO `annonces`(`annonce_title`, `annonce_image`, `annonce_description`, `annonce_area`, `annonce_adresse`, `annonce_price`, `annonce_type`) VALUES  ('$title','$image_name','$description','$area','$adresse','$price','$type')");
    $statement->execute();
    header('Location:index.php');
    exit();
}else {
    echo "there was error uploading your photo";
}
