<?php 

include 'db.php';

$todolist = "";

if (isset($_POST['submit'])) {
    $todolist = $_POST['todolist'];

    $query_insert = "INSERT INTO todolist (todolist)
    VALUES (:todolist)";
    $query_run = $conn->prepare($query_insert);

    $date  = [
        'todolist' => $todolist
    ];
    $query_execute = $query_run->execute($date);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<div class="main">
<div class="main-log-in">
<form action="" method="POST">
    <h1>todolist</h1>
    <input type="text" name="todolist">
    <button type="submit" name="submit" class="btn btn-primary">toevoegen</button><br>
    <h2 class="toevoegen"><?php echo $todolist . " is toevoegen"; ?></h2>
</form>

<?php
    $query_select = "select * from todolist";
    $pr = $conn ->query($query_select);

?>

<table border="2" cellpadding= "4" cellspacing= "4" align="center">
<tr>
    <th>id</th>
    <th>todolist</th>
</tr>

<?php
foreach ($pr as $data1) {

?>

<tr>
    <td><?php echo $data1['id']; ?></td>
    <td><?php echo $data1['todolist']; ?></td>
</tr>

<?php

}

?>

</div>
</div>  
</body>
</html>
