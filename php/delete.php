<?php
include "dbconfig.php";
$id =$_POST['annonce_id'];
$statement = $conn->prepare("DELETE FROM annonces WHERE annonce_id = $id");
$statement->execute();
header('Location:../index.php');
exit();

