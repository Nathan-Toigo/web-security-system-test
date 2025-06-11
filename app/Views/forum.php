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
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to home</a>
	<section>

</body>

</html>