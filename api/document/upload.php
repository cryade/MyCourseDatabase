<?php
require ("../Helper/dbinfo.inc");
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOK = 1;
$documentFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// TODO - add file type check

//check if file already exists
if(file_exists($target_file)){
    echo "Sorry, file already exists.";
    $uploadOK = 0;
}
//check file size
if($_FILES["fileToUpload"]["size"] > 5000000){//5MB
    echo "Sorry, your file is too large.";
    $uploadOK = 0;
}

//Allow certain file formats
if($documentFileType != "pdf" && $documentFileType != "txt"){
    echo "Sorry, we currently only allow pdf or txt files.";
    $uploadOK = 0;
}
try{
    $dbh = new PDO("mysql:host=$host;dbname=$database",$user,$password);

}