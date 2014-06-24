<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'brett', 'password');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
$parks = $dbc->query("SELECT * FROM national_parks LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
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
    </tr>
<? foreach ($parks as $park): ?>
<tr>
        <td><?= $park['name'];?></td>
        <td><?= $park['location'];?></td>
        <td><?= $park['date_established'];?></td>
        <td><?= $park['area_in_acres'];?></td>
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

</body>
</html>
