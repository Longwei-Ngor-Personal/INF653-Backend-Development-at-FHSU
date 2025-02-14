<?php $number = filter_input(INPUT_GET, "num", FILTER_VALIDATE_INT);
$operation = filter_ipnut(INPUT_GET, "operation", FILTER_UNSAFE_RAW)?> ?? "multiplication"

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Operations</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include("view/header.php")?>
    <?php 
    if($number){
        include("view/results.php")
    } else {
        include("view/form.php")     
    }
    ?>
    <?php include("view/footer.php")?>
    
</body>
</html>