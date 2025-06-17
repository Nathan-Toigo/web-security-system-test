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
		<h1>Connexion Page</h1>
        <form method="post" action="/connexion">
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input" id="safe" name="safe" <?php if (isset($_POST['safe'])) echo 'checked'; ?>>
                <label class="custom-control-label" for="safe">Safe request</label>
            </div>
            <div class="form-group">
                <label for="firstname">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
                <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to home</a>
	<section>
</body>

</html>