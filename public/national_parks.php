<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'brett', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//Get rid of users being able to enter pages that don't exist (like page -1 or page 100)

$errorMessage = '';

if (!empty($_GET)) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$pageNext = $page + 1;
$pagePrev = $page - 1;

$limit = 4;
$offset = (($limit * $page) - $limit); 
$rowCount = $dbc->query('SELECT * FROM national_parks');
// $query = $dbc->query("SELECT * FROM national_parks LIMIT $limit OFFSET $offset");
// $parks = $query->fetchAll(PDO::FETCH_ASSOC);
// Refactored below
$stmt = $dbc->prepare("SELECT * FROM national_parks LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Make the form sticky!
if (!empty($_POST)){
    if(!empty($_POST['park_name']) && !empty($_POST['park_location']) && !empty($_POST['date_established']) && !empty($_POST['area_in_acres']) && !empty($_POST['park_descrpition'])) {
    $stmt = $dbc->prepare('INSERT INTO national_parks (name, location, date_established, area_in_acres, park_description) 
                        VALUES (:name, :location, :date_established, :area_in_acres, :park_description)');

    $stmt->bindValue(':name', $_POST['park_name'], PDO::PARAM_STR);
    $stmt->bindValue(':location', $_POST['park_location'], PDO::PARAM_STR);
    $stmt->bindValue(':date_established', $_POST['date_established'], PDO::PARAM_STR);
    $stmt->bindValue(':area_in_acres', $_POST['area_in_acres'], PDO::PARAM_INT);
    $stmt->bindValue(':park_description', $_POST['park_descrpition'], PDO::PARAM_STR);
    
    $stmt->execute();
    //This clears the sticky post if it was sent and added to database. 
    $_POST = [];
    } else {
        $errorMessage = "Missing a field.";
    }
}
?>
<html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
<table class = "table">
    <tr>
        <td>Name</td>
        <td>Location</td>
        <td>Date Established</td>
        <td>Area In Acres</td>
        <td>Park Description</td>
    </tr>
<? foreach ($parks as $park): ?>
<tr>
        <td><?= $park['name'];?></td>
        <td><?= $park['location'];?></td>
        <td><?= $park['date_established'];?></td>
        <td><?= $park['area_in_acres'];?></td>
        <td><?= $park['park_description'];?></td>
</tr>
<? endforeach;?>
</table>
<ul class="pager">
<? if ($pagePrev > 0) : ?> 
<li class="previous"><?= "<a href='?page=$pagePrev'>Previous</a>";?></li>
<? endif ?> 
<? if ($rowCount->rowCount() > ($offset + $limit)) : ?> 
 <li class="next"><?= "<a href='?page=$pageNext'>Next</a>";?></li>
<? endif ?>
</ul>
<h1>Enter your own park.</h1>
<? if (!empty($errorMessage)) : ?>  
    <?= "<p>{$errorMessage}</p>";?>
<? endif; ?>
<form method="POST" action="/national_parks.php">
    <p>
        <label for="park_name">Park Name</label>
        <input id="park_name" name="park_name" type="text" placeholder="Park Name" value="<?php 
if (isset($_POST['park_name'])) echo $_POST['park_name']; ?>">
    </p>
    <p>
        <label for="park_location">Park Location</label>
        <input id="park_location" name="park_location" type="text" placeholder="Park Location"value="<?php 
if (isset($_POST['park_location'])) echo $_POST['park_location']; ?>">
    </p>
    <p>
        <label for="date_established">Date Established</label>
        <input id="date_established" name="date_established" type="text" placeholder="YYYY-MM-DD"value="<?php 
if (isset($_POST['date_established'])) echo $_POST['date_established']; ?>">
    </p>
    <p>
        <label for="area_in_acres">Area In Acres</label>
        <input id="area_in_acres" name="area_in_acres" type="text" placeholder="Area In Acres"value="<?php 
if (isset($_POST['area_in_acres'])) echo $_POST['area_in_acres']; ?>">
    </p>
    <p>
        <label for="park_descrpition">Park Description</label>
        <input id="park_descrpition" name="park_descrpition" type="text" placeholder="Park Description"value="<?php 
if (isset($_POST['park_descrpition'])) echo $_POST['park_descrpition']; ?>">
    </p>
        <input type="submit" value="Submit">
    </p>
</form>
</body>
<html>



