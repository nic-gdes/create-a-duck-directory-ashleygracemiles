<?php

/******** CONNECT TO A DATABASE *********/
// use mysqli_connect to connect to database. There are four arguments: host, username, password, and database name, in that order.

$conn = mysqli_connect("db:3306", "db", "db", "db");

// check if there's no connection and give an error if so
if (mysqli_connect_errno()) {
echo "Connection error: " . mysqli_connect_error();
}
