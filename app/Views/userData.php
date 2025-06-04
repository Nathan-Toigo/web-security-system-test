<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>Me</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

	<main>
		<h1>Status :</h1>
		<ul>
            <li><?php echo $user->getLastName(); ?> <?php echo $user->getFirstName(); ?></li>
            <li><?php echo $user->getEmail(); ?></li>
            <li><?php echo $user->getAddress(); ?></li>
		</ul>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to homepage</a>
	<main>
</body>

</html>