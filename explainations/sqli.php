<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SQLi (SQL Injection)</title>
  <!-- Add Bootstrap CSS from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4 text-primary">Understanding SQLi (SQL Injection)</h1>

    <div class="alert alert-warning">
      <strong>SQL Injection (SQLi)</strong> is a security vulnerability that allows an attacker to interfere with the queries that an application makes to its database. By injecting malicious SQL code, attackers can view, modify, or delete data in the database.
    </div>

    <h2 class="mt-5">Where to find SQLi vulnerability on this website</h2>
    <p>
      This website's login functionality was made to demonstrate an SQLi vulnerability.
      <br />
      It is available via the following link: <a href="http://localhost:8080/connexion" target="_blank">http://localhost:8080/connexion</a>.
      (you should log out if you are already logged in)
      <br />
      Here is the list of all the available users on this website:
      <table class="table table-bordered w-auto">
        <thead class="table-light">
          <tr>
        <th>Email</th>
        <th>Password</th>
          </tr>
        </thead>
        <tbody>
          <tr>
        <td>john.smith@example.com</td>
        <td>password123</td>
          </tr>
          <tr>
        <td>jane.doe@example.com</td>
        <td>securepass456</td>
          </tr>
          <tr>
        <td>charlie.brown@example.com</td>
        <td>charlie789</td>
          </tr>
        </tbody>
      </table>
    </p>

    As you can see, there is a switch button, corresponding to using the safe or the vulnerable routes.

    <h2 class="mt-5">How does SQL Injection work</h2>
    <p>
      When an application constructs SQL queries by directly including user input, an attacker can manipulate the input to change the query's logic.
      For example, entering <code>' OR '1'='1</code> as a password can trick the application into logging in without knowing the actual password.
    </p>
    <p>
      To demonstrate the SQLi attack, you can try entering the following in the login form:
      <ul>
        <li>Email: <code>any.email@email.com</code></li>
        <li>Password: <code>' OR 1=1;--</code></li>
      </ul>
      This input may allow you to log in as any user if the application is vulnerable.
    </p>
    <p>
      This website's implementation of the login functionality even allows something like this to be user :
      <ul>
        <li>Email: <code>any.email@email.com</code></li>
        <li>Password: <code>' OR id=1;--</code></li>
      </ul>
      This input will log you in as the user with ID 1, which is <code>john.smith@example.com</code>.
      With this, you could connect to any user of the database as long as you know their ID.
    </p>

    <h2 class="mt-5">How this website implements a fix for SQL Injection</h2>
    <p>
      This website uses prepared statements to protect against SQL injection attacks. Here is the code snippet that shows how the login functionality is implemented with and without prepared statements:
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of a vulnerable SQL query</div>
      <div class="card-body">
        <pre>
          <code>
            public function testUserPassword($email, $password)
            {          
              $stmt = $this->pdo->query('SELECT * FROM User WHERE email = \'' . $email . '\' AND password = \'' . $password . '\'');
              $data = $stmt->fetch(\PDO::FETCH_ASSOC);
              return $data ? new User($data) : null;
            }
          </code>
        </pre>
      </div>
    </div>

    <p>
      In this example, the SQL query is constructed by directly concatenating user input into the SQL string, which can lead to SQL injection vulnerabilities.
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of a safe SQL query</div>
      <div class="card-body">
        <pre>
          <code>
            public function testUserPassword($email, $password)
            {
              $stmt = $this->pdo->prepare('SELECT * FROM User WHERE email = :email AND password = :password');
              $stmt->execute(['email' => $email,'password' => $password]);
              $data = $stmt->fetch(\PDO::FETCH_ASSOC);
              return $data ? new User($data) : null;
            }
          </code>
        </pre>
      </div>
    </div>
      
    <p>
      This implementation uses prepared statements, which separate SQL logic from user input, making it much harder for attackers to inject malicious SQL.
      You can note that this website uses hand-coded <code>PDOs</code> for PHP, which are not the best practice for large applications.
      Other ways to prevent SQL injection include using ORM (Object-Relational Mapping) libraries that handle query construction safely.
    </p>

  <!-- Bootstrap JS (optional, for interactive components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
