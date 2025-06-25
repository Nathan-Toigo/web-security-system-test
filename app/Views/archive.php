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
		<h1>Archive</h1>

        <form class="form-inline" method="get" action="/archive">
            <div class="form-group custom-switch mx-sm-3 mb-2">
                <input type="checkbox" class="custom-control-input" id="safe" name="safe" <?php if (isset($_GET['safe'])) echo 'checked'; ?>>
                <input type="hidden" name="path" value="<?php echo htmlspecialchars($_GET['path'] ?? ''); ?>">
                <label class="custom-control-label" for="safe">Safe request</label>
            </div>
            <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Refresh</button>
        </form>

        <div class="card my-4">
            <div class="card-body">
            <?php echo $loadedDocument; ?>
            </div>
        </div>

        <h2>All Documents</h2>
        <ul>
            <?php foreach ($allDocuments as $document): ?>
                <li>
                    <a href="?path=<?php echo urlencode($document->getPath()) . '&safe=' . $safe; ?>">
                        <?php echo htmlspecialchars($document->getPath  ()); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
        
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to home</a>
</body>

</html>