<main class="main_form">
    <h2 id="enterNumber">Enter a number</h2>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="GET" class="main-entry_form">
        <input type="text" class="input-box" id="num" name="num" required maxlength="2">
        <select name="operation" class="main-entry_select">
            <option value="multiplication">Multiplication</option>
            <option value="addition">Addition</option>
            <option value="subtraction">Subtraction</option>
            <option value="division">Division</option>
        </select>
        <button class="main-entry">GO!</button>
    </form>