<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vulnerabilities testing website</title>
</head>
<body>
    <header>
        <table>
            <tr>
                <td><a href="http://localhost:8080/?controller=home&action=index">Home</a></td>
                <td><a href="http://localhost:8080/?controller=sqli&action=index">SQLI</a></td>
                <td><a href="http://localhost:8080/?controller=xss&action=index">XSS</a></td>
            </tr>
        </table>
    </header>

    <main>
        <?php if (isset($content)) echo $content; ?>
    </main>

    <footer>
    </footer>
</body>
</html>
