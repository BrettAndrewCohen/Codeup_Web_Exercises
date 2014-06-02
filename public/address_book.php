<?php

$uslessArray = [];

function savefile($savefilepath, $array) {
    $filename = $savefilepath;
    if (is_writable($filename)) {
        $handle = fopen($filename, 'w');
        fputcsv($handle, $array);
        fclose($handle); 
    }   
}

if (!empty($_POST)) {
    savefile('address_book.csv', $_POST);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Address Book Entries</title>
</head>
<body>
<h1>Address Book Entry</h1>
<? if (!empty($_POST)) : ?>
    <? if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) : ?>
        <? foreach ($_POST as $key => $value) :?>
            <?="<li>The users $key is $value.</li>"?>
        <? endforeach; ?>
    <? else : ?>
        <?="Please include all of the fields"?>
    <? endif; ?>
<? endif; ?>

<h1>Please add your information:</h1>
<form method="POST" action="/address_book.php">
    <p>
        <label for="name">Enter Your Name</label>
        <input id="name" name="name" type="text" placeholder="Enter Your Name">
    </p>
    <p>
        <label for="address">Enter Your Address</label>
        <input id="address" name="address" type="text" placeholder="Enter Your Address">
    </p>
    <p>
        <label for="city">Enter Your City</label>
        <input id="city" name="city" type="text" placeholder="Enter Your City">
    </p>
    <p>
        <label for="state">Enter Your State</label>
        <input id="state" name="state" type="text" placeholder="Enter Your State">
    </p>
    <p>
        <label for="zip">Enter Your Zip</label>
        <input id="zip" name="zip" type="text" placeholder="Enter Your Zip">
    </p>
        <input type="submit" value="Submit">
    </p>
</form>

</body>
</html>