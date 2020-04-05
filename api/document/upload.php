<?php
require("../Helper/dbinfo.inc");
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOK = 1;
    $documentFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// TODO - add file type check

//check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOK = 0;
    }
//check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {//5MB
        echo "Sorry, your file is too large.";
        $uploadOK = 0;
    }

//Allow certain file formats
    if ($documentFileType != "pdf" && $documentFileType != "txt") {
        echo "Sorry, we currently only allow pdf or txt files.";
        $uploadOK = 0;
    }
    try {
        $dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $statement = $dbh->prepare('INSERT INTO Documents(course_id,user_id,title,content) 
                                             VALUES(:cid,:uid,:title,:content)');

    }catch(PDOException $e){
        http_response_code(500);
        echo json_encode("There was a connection error with the database");
    }
} else {
    http_response_code(405);
    echo json_encode("Not allowed to post data here");
}