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

	<section>
		<h1>Home Page</h1>
		<p>
            <a href="<?php echo $routeToConnexion ?>">Log in here (SQL Injection Vulnerability)</a>
            <br>
            <a href="<?php echo $routeToForum ?>">See the forum here (XSS Vulnerability)</a>
            <br>
            <a href="<?php echo $routeToGalery ?>">See the galery (DT Vulnerability)</a>
            <br>
        </p>
	<section>

</body>

</html>