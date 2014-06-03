<?php

// $filename = 'address_book.csv';

class AddressDataStore {

    public $filename = 'address_book.csv';

    function readcsv(){
        $contents = [];
        if (is_readable($this->filename) && filesize($this->filename) > 0){
            $handle = fopen($this->filename, 'r');
            while(!feof($handle)) {
                $row = fgetcsv($handle);
                if (is_array($row)) {
                $contents[] = $row;
                }
            }
            fclose($handle);
        }
        return $contents;
    }

    function savefile($addresses_array) {
        $handle = fopen($this->filename, 'w');
        foreach ($addresses_array as $row) {
        fputcsv($handle, $row);
        }
        fclose($handle); 
    }

}

// function savefile($filename, $array) {
//     // $filename = $savefilepath;
//     $handle = fopen($filename, 'w');
//     foreach ($array as $row) {
//         fputcsv($handle, $row);
//     }
//     fclose($handle); 
// }

// function readcsv($filename) {
//     $contents = [];
//     if (is_readable($filename) && filesize($filename) > 0){
//         $handle = fopen($filename, 'r');
//         while(!feof($handle)) {
//             $row = fgetcsv($handle);
//             if (is_array($row)) {
//             $contents[] = $row;
//             }
//         }
//         fclose($handle);
//     }
//     return $contents;
// } 

$ads = new AddressDataStore();

$address_book = $ads->readcsv();

// $address_book = readcsv($filename);

if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
        $newEntry = array($_POST['name'],$_POST['address'],$_POST['city'],$_POST['state'],$_POST['zip']);
        // $address_book[] = $newEntry; same as below
        array_push($address_book, $newEntry);
        $ads->savefile($address_book);
        // savefile('address_book.csv', $address_book);
    } else {
       echo "Please include all of the fields";
    }
}

if (!empty($_GET)) {
    $removeindex = $_GET['removeitem'];
    unset($address_book[$removeindex]);
    $ads->savefile($address_book);
    // savefile('address_book.csv', $address_book);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Address Book Entries</title>
</head>
<body>
<h1>Address Book</h1>
<table border="1" style="width:700px">
    <tr>
        <td>Name</td>
        <td>Address</td>
        <td>City</td>
        <td>State</td>
        <td>Zip</td>
        <td>Remove Contact?</td>
    </tr>
<? foreach ($address_book as $index => $entry) : ?>
<tr>
    <? foreach ($entry as $value) : ?>
        <td><?= $value;?></td>
        <?endforeach;?>
<?= "<td><a href='?removeitem=$index'>Remove Contact</a></td>";?>
<? endforeach;?>
</tr>
</table>
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