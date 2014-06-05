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

        <form method="GET">
            <p>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="Enter Your Name">
            </p>
            <p>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter A Password">
            </p>
            <p>
                <button type="submit">Log In</button>
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
                <label for="fromusername">From</label>
                <input id="fromusername" name="username" type="text" placeholder="Enter Your Name">
            </p>
            <p>
                <label for="fromemail">From</label>
                <input id="fromemail" name="fromemail" type="email" placeholder="Enter Your Email">
            </p>
            <p>
                <label for="subject">Subject</label>
                <input id="subject" name="subject" type="text" placeholder="Enter A Subject">
            </p>
            <p>
                <label for="Message">Message</label>
                <textarea id="email_body" name="email_body" rows="5" cols="40" placeholder="Your message goes here!"></textarea>  
            </p>
                <label for="mailing_list">
                <input type="checkbox" id="mailing_list" name="mailing_list" value="CHECKED">Would you like to save a version?</label>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>

        <h2>Multiple Choice</h2>
        <form method="POST">
           <p>Are the Spurs the best team in the NBA?</p>

            <label for="q1a"><input type="radio" id="q1a" name="q1" value="YES">Yes</label>
            <label for="q1b"><input type="radio" id="q1b" name="q1" value="100%">100%</label>
            <label for="q1c"><input type="radio" id="q1c" name="q1" value="NO" onclick="this.checked=false; alert('Sorry, the Spurs ARE the best team in the NBA!')">No</label>

            <p>When did the Spurs win a NBA Championship</p>

            <label for="1999"><input type="checkbox" id="1999" name="wins[]" value="1999">1999</label>
            <label for="2003"><input type="checkbox" id="2003" name="wins[]" value="2003">2003</label>
            <label for="2005"><input type="checkbox" id="2005" name="wins[]" value="2005">2005</label>
            <label for="2007"><input type="checkbox" id="2007" name="wins[]" value="2007">2007</label>
            <label for="2014"><input type="checkbox" id="2014" name="wins[]" value="2014">2014</label>
            <p>
                <button type="submit">Go!</button>
            </p>

        </form>

        <h2>Select Testing</h2>

        <form method="GET">
            <label for="sushi">Do you like sushi: </label>
            <select id="sushi" name="sushi">
            <option value ="1">Yes</option>
            <option value="0">No</option>
            </select><br>

        <label for="spurs">When did the Spurs win a NBA Championship?</label>
            <select id="spurs" name="spurs[]" multiple>
                <option value="1999">1999</option>
                <option value="2003">2003</option>
                <option value="2005">2005</option>
                <option value="2007">2007</option>
                <option value="2014">2014</option>
            </select>
            <p>
                <button type="submit">Go!</button>
            </p>
        </form>

    </body>

</html>