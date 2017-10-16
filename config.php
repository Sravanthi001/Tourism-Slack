<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'admin');
   define('DB_PASSWORD', 'M0n@rch$');
   define('DB_DATABASE', 'cs518-test');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    printf("Error: Unable to connect to MySQL.");
    exit;
}

//printf("Success: A proper connection to MySQL was made! The my_db database is great.");
//printf("Host information: " . mysqli_get_host_info($db));
?>
