<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Development Assignment 1</title>
</head>
<body>
    <h2>Challenge 1: Displaying Information</h2>
    <?php
    #This is challenge 1

    $name="Longwei Ngor";
    $age="21";
    $favorite_color="Blue and Black";
    echo "My name is " . $name . ", I'm " . $age . " and my favorite color is " . $favorite_color;
    ?>

    <h2>Challenge 2: Using Escape Characters</h2>
    <?php
    #This is challenge 2

    echo "He said, \"PHP is fun!\" and left.";
    echo "<br>Line 1 <br> Line 2";
    ?>

    <h2>Challenge 3: Correcting Syntax Error</h2>
    <?php
    #This is challenge 3
    
    $greeting = 'Hello';
    echo "Welcome to the PHP world!";
    echo "<br>Your age is " . $age;
    ?>
    
    <h2>Challenge 4: Fix Error</h2>
    <?php 
    #This is challenge 4
    echo "Welcome to PHP!";
    $name = "John";
    echo "<br>Hello, $name";
    ?>

    <h2>Challenge 5: Adding Comments to code</h2>
    <?php
    #This is challenge 5: Adding comments to code

    #declare variable
    $price = 50;
    $discount = 10;

    /*To find final price orginal price minus discount amount */
    $finalPrice = $price - $discount; 
    echo "Total price: $" . $finalPrice; //expected output $40
    ?>

    <h1>This is challenge on Jan 29th 2025</h1>

    <h2>Challenge 1</h2>
    <p>Create a PHP script that takes two numbers and performs addition,
    subtraction, multiplication, division, and modulus operations.</p>

    <?php
    //This is challenge 1

    $num1 = 10;
    $num2 = 2;

    echo "Addition: " . $num1 . " + " . $num2 . " = " . $num1+$num2;
    echo "<br> Substraction: " . $num1 . " - " . $num2 . " = " . $num1-$num2;
    echo "<br> Multiplicatoin: " . $num1 . " * " . $num2 . " = " . $num1*$num2;
    echo "<br> Division: " . $num1 . " / " . $num2 . " = " . $num1/$num2;
    echo "<br> Modulus: " . $num1 . " % " . $num2 . " = " . $num1%$num2;
    ?>

    <h2>Challenge 2</h2>
    <p>Write a PHP script that takes an integer and 
    determines if it is even or odd using the modulus % operator.</p>

    <?php
    //This is challenge 2

    $num1 = 101101101;
    $num2 = 129481810;

    echo ($num1 % 2 == 0)? "$num1 is an even number" : "$num1 is an odd number";
    echo "<br>";
    echo ($num2 % 2 == 0)? "$num2 is an even number" : "$num2 is an odd number";
    ?>

    <h2>Challenge 3</h2>
    <p>Write a PHP script that starts with a number and increments and decrements
    it using ++ and -- operators.</p>

    <?php
    //This is challenge 3

    $num = 10;

    echo "Starting number: $num";
    echo "<br>After Increment: " . ++$num;
    echo "<br>After Decrement: " . --$num;
    ?>

    <h2>Challenge 4</h2>
    <p>Write a PHP script that takes a student’s
    marks and assigns a grade using the
    following conditions:
    <br>•90+ → A
    <br>•80-89 → B
    <br>•70-79 → C
    <br>•60-69 → D
    <br>•Below 60 → F</p>

    <?php 
    //This is challenge 4

    $grade = 80;

    if ($grade >= 90){
        echo "Your score: $grade <br>You got an A!";
    } elseif ($grade >= 80 and $grade <=89){
        echo "Your score: $grade <br>You got a B!";
    } elseif ($grade >= 70 and $grade <=79){
        echo "Your score: $grade <br>You got a C!";
    } elseif ($grade >= 60 and $grade <=69){
        echo "Your score: $grade <br>You got a D!";
    } else{
        echo "Your score: $grade <br>   You got a F!";
    }
    ?>

    <h2>Challenge 5</h2>
    <p>Write a PHP script to check if a given year is a leap year or not.</p>

    <?php 
    //This is challenge 5

    $year1 = 2024;
    $year2 = 2025;

    echo (($year1 % 4) == 0)? "$year1 is a leap year" : "$year1 is not a leap year";
    echo "<br>";
    echo (($year2 % 4) == 0)? "$year2 is a leap year" : "$year2 is not a leap year";
    ?>
</body>
</html>