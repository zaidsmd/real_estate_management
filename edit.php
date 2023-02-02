<?php
include "dbconfig.php";
$id =$_POST['annonce_id'];
$statement = $conn->prepare("");
$statement->execute();
header('Location: index.php');
exit();



//=======================
$targetDir = "img/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg','pdf');
if (in_array($fileType,$allowTypes)){
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        $statement = $conn->prepare("INSERT into `testing` (`img`) VALUES ('$fileName')");
        $statement->execute();
    }
}
