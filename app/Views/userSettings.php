<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>Web Security System Testing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

	<main>
		<h1>User Settings</h1>

        <form class="form-inline" method="post" action="<?php echo $routes->get('user_settings_email')->getPath(); ?>">
            <div class="form-group">
                <label for="email">New Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Email</button>
        </form>
        
        <a href="<?php echo $routes->get('logout')->getPath(); ?>">Disconnect</a> </br>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to homepage</a>
	<main>
</body>

</html>