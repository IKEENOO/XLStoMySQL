<?php
    $port = '';
    $user = '';
    $password = '';
    $db_name = '';

    //$port = $_POST['port'];
    //$user = $_POST['user'];
    //$password = $_POST['password'];
    //$db_name = $_POST['db_name'];
    $dbConnect = fn($port, $user, $password, $db_name) => new mysqli("$port", "$user", "$password", "$db_name");
    $connect = $dbConnect($port, $user, $password, $db_name);

    // Creating a table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS xls (
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            frt_column VARCHAR(255),
                            snd_column VARCHAR(255),
                            trd_column VARCHAR(255),
                            frs_column VARCHAR(255)
                        )";
    $connect->query($createTableQuery);