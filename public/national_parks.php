<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'brett', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

if (!empty($_GET)) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$pageNext = $page + 1;
$pagePrev = $page - 1;

function getParks($dbc, $page) {
	$limit = 4;
	$offset = (($limit * $page) - $limit); 
    return $dbc->query("SELECT * FROM national_parks LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
}

?>

<table border="1" style="width:700px">
    <tr>
        <td>Name</td>
        <td>Location</td>
        <td>Date Established</td>
        <td>Area In Acres</td>
    </tr>
<? foreach (getParks($dbc, $page) as $row): ?>
<tr>
        <td><?= $row['name'];?></td>
        <td><?= $row['location'];?></td>
        <td><?= $row['date_established'];?></td>
        <td><?= $row['area_in_acres'];?></td>
</tr>
<? endforeach;?>
</table>
<? if ($pagePrev > 0) : ?> 
<?= "<a href='?page=$pagePrev'>Previous</a>";?>
<? endif ?>
<?= "<a href='?page=$pageNext'>Next</a>";?>





