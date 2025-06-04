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
		<?php
    use App\Models\User;
    if (isset($baba) && $baba instanceof User) {
        echo '<div class="alert alert-info">';
        echo '<h4>User Information</h4>';
        echo '<strong>Id:</strong> ' . htmlspecialchars($user->getId()) . '<br>';
        echo '<strong>First Name:</strong> ' . htmlspecialchars($user->getFirstName()) . '<br>';
        echo '<strong>Last Name:</strong> ' . htmlspecialchars($user->getLastName()) . '<br>';
        echo '<strong>Email:</strong> ' . htmlspecialchars($user->getEmail()) . '<br>';
        echo '<strong>Address:</strong> ' . htmlspecialchars($user->getAddress()) . '<br>';
        echo '<strong>Address:</strong> ' . htmlspecialchars($user->getPassword()) . '<br>';
        echo '</div>';
    }
    
    ?>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to homepage</a>
	<main>
</body>

</html>