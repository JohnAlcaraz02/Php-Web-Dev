<?php
$host = "127.0.0.1";
$db_user = "postgres";
$db_pass = "johnpogi2";
$db_name = "first_app";

$conn = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_pass");

if (!$conn) {
    die("Database connection failed: " . pg_last_error());
}
?>