<? if (!empty($_POST)) : ?>
    <? if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) : ?>
        <? foreach ($_POST as $key => $value) :?>
            <?="<li>The users $key is $value.</li>"?>
        <? endforeach; ?>
    <? else : ?>
        <?="Please include all of the fields"?>
    <? endif; ?>
<? endif; ?>


<?  if (!empty($_POST)):?>
<?   savefile('address_book.csv', $_POST);?>
<?  endif;?>


<? if (!empty($_POST)) : ?>
    <? if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) : ?>
    <tr>
        <? foreach ($_POST as $key => $value) : ?>
            <?="<td>$value</td>";?>  
        <? endforeach; ?> 
    </tr>    
    <?  ?>
    <? else : ?>
        <?="Please include all of the fields";?>
    <? endif; ?>    
<? endif; ?>