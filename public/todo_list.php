<!DOCTYPE html>
<html>

<!-- For this exercise, you will be converting the todo_list.html template you created into a PHP driven web app. 
Commit and push your changes to GitHub after each step.

Change the file extension of your todo list template to .php. DONE

Create an array from your sample todo list items in the template. 
Next, use PHP to display the array items within the unordered list in your template and test in your browser.

Reference the code you wrote in your command line todo list app to add the ability to load todo items from a file. 
The items should be loaded into an array, and then that array should be used to display the items just as in the above steps.

Using the POST method on the form in your template, create the ability to add todo items to the list. 
Each time an item is added, the todo list file should be saved with the new item added.

Add a link next to each todo item that says "Mark Complete" and have it send a GET request to the page that deletes the entry. 
Use query strings to send the proper key back to the server, and update the todo list file to reflect the deletion. -->

<head>
	<title>To Do PHP</title>
</head>
<body>
	<?php
            // var_dump($_POST);
            //  foreach ($_GET as $key => $value) {
            //     echo "<p>{$key} => ${value}</p>";
            // }
            $todolist = ['Item 1', 'Item 2', 'Item 3', 'Item 4'];
            foreach ($todolist as $item) {
                echo $item;
            }



        ?>

<h1>TODO List</h1>
<!-- <ul>
		<li>Item 1</li>
		<li>Item 2</li>
		<li>Item 3</li>
</ul> -->
<h1>Please add an item to do the TODO list!</h1>
 	<form method="GET">
            <p>
                <label for="todoitem">Add TODO Item</label>
                <input id="todoitem" name="todoitem" type="text" placeholder="Enter Your Item">
            </p>
                <input type="submit" value="Submit">
            </p>
 	</form>
</body>
</html>