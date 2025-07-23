<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Understanding SQL Injection (SQLi)</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <h1>What is SQL Injection (SQLi)?</h1>
  <p>
    SQL Injection is a type of vulnerability that occurs when user input is directly included in SQL queries
    without proper validation or escaping. This can allow an attacker to manipulate the query and access,
    modify, or delete data from the database.
  </p>

  <h2>Example of Vulnerable Code</h2>
  <pre><code>username = request.GET['username']
query = \"SELECT * FROM users WHERE username = '\" + username + \"'\"
</code></pre>

  <p>
    If an attacker enters:
    <code>' OR '1'='1</code><br>
    The resulting query becomes:
  </p>

  <pre><code>SELECT * FROM users WHERE username = '' OR '1'='1'</code></pre>

  <p>This condition always returns true, so the attacker could bypass authentication.</p>

  <h2>How to Prevent It</h2>
  <ul>
    <li>Use prepared statements or parameterized queries.</li>
    <li>Always validate and sanitize user input.</li>
    <li>Use ORM libraries that handle SQL safely.</li>
  </ul>

  <h2>Safe Example with Prepared Statement</h2>
  <pre><code>
cursor.execute(\"SELECT * FROM users WHERE username = %s\", (username,))
  </code></pre>

  <p>This way, the input is treated as a value, not part of the SQL command.</p>

</body>
</html>
