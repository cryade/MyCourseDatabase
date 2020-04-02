<?php
require ("../Helper/dbinfo.inc");
$target_dir = "uploads/";
$target_file = $target_dir . basename()
/*to do: follow https://www.w3schools.com/php/php_file_upload.asp*/
try{
    $dbh = new PDO("mysql:host=$host;dbname=$database",$user,$password);

}