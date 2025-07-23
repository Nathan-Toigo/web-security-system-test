<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>XSS (Cross-Site Scripting)</title>
  <!-- Add Bootstrap CSS from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4 text-primary">Understanding XSS (Cross-Site Scripting)</h1>

    <div class="alert alert-warning">
      <strong>Cross-Site Scripting (XSS)</strong> is a security vulnerability that allows an attacker to inject malicious scripts into web pages viewed by other users. These scripts can steal data, hijack sessions, or perform actions on behalf of the victim.
    </div>

    <h2 class="mt-5">Where to find XSS vulnerability on this website</h2>
    <p>
      This website's forum functionality was made to demonstrate the XSS vulnerability.
      <br />
      It is available via the following link: <a href="http://localhost:8080/forum" target="_blank">http://localhost:8080/forum</a>.
    </p>

    There are a few things on this page : 
    <ul>
      <li>A form to post comments containing : A switch button to toggle between safe and vulnerable post modes, a title field and a content field</li>
      <li>A form to save cookies containing : A switch button to toggle between safe and vulnerable cookies storage modes, a cookie name field and a cookie value field</li>
      <li>A switch button to toggle between safe and vulnerable posts display modes</li>
      <li>A refresh button, to refresh the page and apply the safe display switch mode</li>


    </ul>

    <h2 class="mt-5">How does XSS work</h2>
    <p>
      When an application displays user input without proper escaping or sanitization, an attacker can inject JavaScript code.
    </p>
    <p>
      For example, if a user submits a comment containing a script tag, and the application displays it without escaping, the script will execute in the context of other users viewing that comment.
      More dangerous payloads could steal cookies, redirect users, or perform actions on their behalf.
    </p>

    <p>
      To demonstrate the XSS attack, you can try entering the following in the comment form:
      <ul>
        <li>Title: <code>Test</code></li>
        <li>Content: <code>This message &lt;script&gt; alert("I hacked the website!"); &lt;/script&gt;is completely normal.</code></li>
      </ul>
      This input will trigger an alert box when viewed by other users if safe display switch is off.
      You can notice that if the safe post switch is on when posting the comment, the script will be escaped and displayed as plain text.
    </p>

    <h2 class="mt-5">How this website implements a fix for XSS</h2>

    This website implements a fix for XSS on different levels:
    <ul>
      <li>When the user posts a new comment : It prevents any script injection to be stored in the database</li>
      <li>When the user retrieves and displays all the comments from the database : It prevents any script to be displayed and executed when the user loads the page, wheather or not there are unsafe comments in the database.</li>
    </ul>

    <p>
        This website implements a fix for XSS by escaping user input before displaying it in HTML.
        The safe post switch uses the <code>strip_tags</code> PHP function to remove HTML tags, preventing scripts from being inserted into the database.
        For example, the input <code> This message &lt;script&gt; alert("I hacked the website!"); &lt;/script&gt;is completely normal.</code> will be stored as <code>This message alert("I hacked the website!"); is completely normal.</code> in the database, and displayed as such.
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of a vulnerable output</div>
      <div class="card-body">
        <pre>
          <code>
            // Vulnerable: directly outputs user input
            echo "&lt;div&gt;" . $_POST['comment'] . "&lt;/div&gt;";
          </code>
        </pre>
      </div>
    </div>

    <p>
      In this example, user input is displayed without escaping, which can lead to XSS vulnerabilities.
    </p>

    <div class="card my-4">
      <div class="card-header bg-secondary text-white">Example of a safe output</div>
      <div class="card-body">
        <pre>
          <code>
            // Safe: escapes user input before output
            echo "&lt;div&gt;" . htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8') . "&lt;/div&gt;";
          </code>
        </pre>
      </div>
    </div>
      
    <p>
      This implementation uses <code>htmlspecialchars</code> to escape special characters, preventing scripts from being executed. Always escape user input before displaying it in HTML.
      Other ways to prevent XSS include using frameworks that automatically escape output and implementing Content Security Policy (CSP).
    </p>

  <!-- Bootstrap JS (optional, for interactive components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
