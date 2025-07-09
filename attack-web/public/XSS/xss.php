<!-- 
 <?php
// Start output buffering to prevent headers already sent error
ob_start();

if (isset($_POST['reset']) && $_POST['reset'] == 1) {
    for ($i = 0; $i < count($_COOKIE); $i++) {
        setcookie('user_input' . $i, '', time() - 3600, "/");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_input']) && !empty($_POST['user_input'])) {
    if (isset($_POST['safe']) && $_POST['safe'] == 'on') {
        setcookie('user_input'. count($_COOKIE), $_POST['user_input'],['samesite' => 'Strict', 'secure' => true, 'httponly' => true, 'expires' => time() + 3600, 'path' => '/']);
    } else {
        setcookie('user_input'. count($_COOKIE), $_POST['user_input'],time() + 3600, "/");
    }

    $_POST['user_input'. count($_COOKIE)] = "";
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>A simple website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head> 
<body>
    <form class="form-inline" method="post">
        <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="safe" name="safe" <?php if (isset($_POST['safe'])) echo 'checked'; ?>>
            <label class="custom-control-label" for="safe">Safe request</label>
        </div>
        <div class="custom-control custom-switch mb-3">
            <label for="user_input">Enter something:</label>
            <input class="form-control" type="text" id="user_input" name="user_input" value="">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <form class="form-inline" method="post">
        <div class="custom-control custom-switch mb-3">
            <input type="hidden" id="reset" name="reset" value="1">
            <button type="submit" class="btn btn-primary">Reset cookies</button>
        </div>
    </form>
    <p>Stored value: 
        <?php
        foreach($_COOKIE as $cookie){
            echo htmlspecialchars($cookie) . "<br>";
        } ?>
    </p>
</body>
</html>
<?php
// Flush the output buffer
ob_end_flush();
?> 
-->


<!DOCTYPE html>
<html>
<head>
    <title>Display GET Parameter</title>
</head>
<body>
    <?php
    if (isset($_GET['param'])) {
        echo "Retrieved Information : <br>" . htmlspecialchars($_GET['param']);
    }
    ?>
    <form action="../index.php">
        <button type="submit">Home</button>
    </form>
</body>
</html>