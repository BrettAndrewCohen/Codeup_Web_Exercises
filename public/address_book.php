<?php

include('classes/address_data_store.php');

$ads = new AddressDataStore('address_book.csv');
// $ads->filename = 'address_book.csv';
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

if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {

    if ($_FILES['file1']['type'] == 'text/csv') {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $filename = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $filename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        $upload = new AddressDataStore($saved_filename);
        $csvfile = $upload->readcsv();
        $address_book = array_merge($address_book, $csvfile);
        $ads->savefile($address_book);

    } else {
        echo "Not a valid file. Please use only a CSV file";
    }
}
// var_dump($address_book);
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
</tr>
<? endforeach;?>

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

<h1>Upload File</h1>

<form method="POST" enctype="multipart/form-data">
    <p>
        <label for="file1">File to upload: </label>
        <input type="file" id="file1" name="file1">
    </p>
    <p>
        <input type="submit" value="Upload">
    </p>
</form>

</body>
</html>