<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CSRF Vulnerability (Cross-Site Request Forgery)</title>
  <!-- Add Bootstrap CSS from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4 text-primary">Understanding CSRF (Cross-Site Request Forgery)</h1>

    <div class="alert alert-warning">
      <strong>CSRF</strong> (Cross-Site Request Forgery) is a security vulnerability that tricks a logged-in user
      into submitting unwanted or malicious actions on a web application in which they are authenticated.
    </div>

    <h2 class="mt-5">Where to find CSRF vulnerability on this website</h2>
    <p>
      This website's change email functionality was made to demonstrate a CSRF vulnerability.
      <br />
      It is available after connecting using the following link: <a href="http://localhost:8080/connexion" target="_blank">http://localhost:8080/connexion</a>.
      <br />
      After logging in with a user, you can access the change email form.
      Here is the list of all ths available users on this website:
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

    After logging in, you are redirected to the user page, where you can change your email address.
    This form is using the safe route, which is protected against CSRF attacks.

    <h2 class="mt-5">How does CSRF work</h2>
    <p>
      When a user is logged in, their session is maintained via session cookies. This session cookie is enough to authenticate the user for any request made to the server, but it does not verify the origin of the request. 
      If an attacker can trick the user into making a request to the server, they can perform actions on behalf of the user without their consent.
    </p>
    <p>
      A CSRF attack typically involves an attacker creating a malicious web page that contains a form or a script that automatically submits a request to the vulnerable website. 
      If a logged in user visits this malicious page, their browser will send their session cookie along with the request, making it appear as if the request is coming from the user themselves.
    </p>
    <p>
      To demonstrate the CSRF attack, a malicious page is available via this link : <a href="http://localhost:8081/index.php" target="_blank">http://localhost:8081/index.php</a>.
      It contains a way to copy a link to the clipboard, which would send a request to one of the routes of the main website.

      If the user is authenticated and clicks on this copied link (using phishing for example), the request will be processed as if it was made by the user themselves.
    </p>
    <p>
      For educational purposes, the main website contains two routes, one vulnerable to CSRF and one safe.
      These routes can be found here :
      <ul>
        <li><a href="http://localhost:8080/user/settings/update-email-safe" target="_blank">/user/settings/update-email-safe</a></li>
        <li><a href="http://localhost:8080/user/settings/update-email-vulnerable" target="_blank">/user/settings/update-email-vulnerable</a></li>
      </ul>
    </p>

    <h2 class="mt-5">How this website implements a fix for CSRF</h2>
    <p>
      This website uses anti-CSRF tokens to protect against CSRF attacks. This can be seen like this :
    </p>
    <p>
      When a user accesses the change email form, a unique token is generated and stored in the user's session.
      <br />
      This token is then included as a hidden field in the form.
      <br />
      When the form is submitted, the server checks if the token matches the one stored in the session.
      <br />
      If it does, the request is processed; if not, it is rejected.
    </p>

      This ensures that only requests made from the legitimate user on the website are processed. As other forms from different origins will not have access to the user's session.
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of HTTP request to the vulnerable route</div>
      <div class="card-body">
        <pre>
          <code>
            <span class="text-primary">POST</span> <span class="text-warning">/user/settings/update-email-vulnerable</span> <span class="text-secondary">HTTP/1.1</span>
            <span class="text-info">Host:</span> <span class="text-dark">localhost:8080</span>
            <span class="text-info">Content-Type:</span> <span class="text-dark">application/x-www-form-urlencoded</span>
            <span class="text-info">Content-Length:</span> <span class="text-dark">29</span>

            <span class="text-danger">email=evil.email@mail.com</span>
          </code>
        </pre>
      </div>
    </div>
    
    <p>
      The above request is made by the attack page to change the user's email address to an email controlled by the attacker. 
      We notice that the form does not include any anti-CSRF token, the only security test is the user's session cookie.
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of HTTP request to the safe route</div>
      <div class="card-body">
        <pre>
          <code>
            <span class="text-primary">POST</span> <span class="text-warning">/user/settings/update-email-safe</span> <span class="text-secondary">HTTP/1.1</span>
            <span class="text-info">Host:</span> <span class="text-dark">localhost:8080</span>
            <span class="text-info">Content-Type:</span> <span class="text-dark">application/x-www-form-urlencoded</span>
            <span class="text-info">Content-Length:</span> <span class="text-dark">29</span>

            <span class="text-danger">email=evil.email@mail.com</span>
            <span class="text-danger">X-CSRF-Token=1234567890abcdef</span> // This anti-CSRF token was retrieved from the user's session
          </code>
        </pre>
      </div>
    </div>

    <p>
      This request is made to the safe route, which includes an anti-CSRF token in the request headers.
      <br />
      The server checks this token against the one stored in the user's session.
      <br />
      If the token matches, the request is processed; if not, it is rejected.
    </p>
  </div>

  <!-- Bootstrap JS (optional, for interactive components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
