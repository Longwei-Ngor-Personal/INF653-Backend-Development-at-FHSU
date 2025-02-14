<main class="main-results">
<?php 
function generateMathTable($num, $operation){
    $cards = "";
    for($i=1; $i <=12; $i++){
        switch($operation){
            case "addition":
                $result = $num + $i;
                $symbol = "+";
            break;
            case "subtraction":
                $result = $num - $i;
                $symbol = "-";
            break;
            case "multiplication":
                $result = $num * $i;
                $symbol = "*";
            break;
            case "division":
                $result = $num / $i;
                $symbol = "+";
            break;
        }
        $cards .= "<div class='card' tabindex='0'>
        <div class='card-front'>{$num} {$symbol} {$i}</div>
        </div>";
    }
    return $cards;
}
echo generateMathTable($number, $operation);
?>
</main>