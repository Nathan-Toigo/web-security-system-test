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
		<h1>Forum Page</h1>

        <form class="form-inline" method="post" action="/forum">
            <div class="form-group custom-switch mx-sm-3 mb-2">
                <input type="checkbox" class="custom-control-input" id="safe" name="safe" <?php if (isset($_POST['safe'])) echo 'checked'; ?>>
                <label class="custom-control-label" for="safe">Safe request</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="firstname">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="password">Content</label>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>
            <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Submit</button>
        </form>
        
		<p>
            <?php
                foreach ($posts as $post): 
                echo '<div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">'.$post->getTitle().'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By '.$post->getCreator()->getEmail().', '.$post->getCreatedAt().'</h6>
                        <p class="card-text">'.$post->getContent().'</p>
                    </div>
                </div>';
                endforeach; ?>
        </p>
        
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to home</a>
	<section>

</body>

</html>