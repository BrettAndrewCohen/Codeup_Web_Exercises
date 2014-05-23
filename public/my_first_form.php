<!DOCTYPE html>
<html>
<head>
<title>Form</title>
</head>

<body>

  <?php
        var_dump($_GET);
        echo "<hr>";
        var_dump($_POST);
    ?>

<h2>User Login</h2>
<form method="POST">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Enter Your Name">
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter A Password">
    </p>
    <p>
        <button type="submit">Login</button>
        <!-- <input type="submit" value="Log In"> -->
    </p>
</form>
<h2>Compose an email</h2>
<form method="POST">
    <p>
        <label for="toemail">To</label>
        <input id="toemail" name="toemail" type="email" placeholder="Enter The Email To Send To">
    </p>
    <p>
        <label for="username">From</label>
        <input id="username" name="username" type="text" placeholder="Enter Your Name">
    </p>
    <p>
        <label for="fromemail">From</label>
        <input id="fromemail" name="fromemail" type="email" placeholder="Enter Your Email">
    </p>
    <p>
        <label for="username">Subject</label>
        <input id="username" name="username" type="text" placeholder="Enter A Subject">
    </p>
    <p>
       <textarea id="email_body" name="email_body" rows="5" cols="40" placeholder="Your message goes here!"></textarea>  
    </p>
    <p>
        <input type="submit" value="Log In">
    </p>
</form>



</body>

</html>