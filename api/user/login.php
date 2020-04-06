<?php
require ('../Helper/dbinfo.inc');
$requestMethod =$_SERVER["REQUEST_METHOD"];
header('Content-type: application/json');
if($requestMethod == 'POST'){
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    try{
        $dbh = new PDO("mysql:host=$host;dbname=$database",$user,$password);

        if(!isset($data['username'],$data['password'])){
            exit('Please fill both the username and password fields!');
        }

        $stmt = $dbh->prepare('SELECT user_id, password FROM User WHERE username = ?');
        $stmt->execute(array($data->username));
        if($stmt->fetchColumn()>0) {
            $result = $stmt->fetch();
            if (password_verify($data->passsword, $result[1])) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $data->username;
                $_SESSION['id'] = $result[0];
                echo "Welcome " . $_SESSION['name'];
            } else {
                echo "Incorrect password";
            }
        }else{
            echo 'Incorrect Username';
        }


    }catch(PDOException $e){
        http_response_code(500);
        echo json_encode("There was a connection error with the database");
        return;
    }
}
