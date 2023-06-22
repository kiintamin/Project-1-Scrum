<?php

// ik maak db.php voor scheid gevoelige bestanden (bijvoorbeld username en password voor database).

$dsn = 'mysql:host=localhost;dbname=inloggegevens';
    $user = 'bit_academy';
    $pass = 'bit_academy';
  
try {
    $conn = new PDO($dsn, $user, $pass);
    // echo "connected with database;
} catch (PDOException $e) {
    echo 'failed' . $e->getmessage();
}
 
?>
