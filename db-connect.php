<?php
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE_NAME", "database_project");
     
    $db_connect = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME);
?>