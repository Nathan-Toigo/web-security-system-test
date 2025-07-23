<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>XSS Vulnerability (Cross-Site Scripting)</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <h1>Understanding XSS (Cross-Site Scripting) Vulnerability</h1>

  <p>
    <strong>XSS (Cross-Site Scripting)</strong> is a security vulnerability that allows an attacker to inject malicious JavaScript code into a web page viewed by other users.
    This code is executed in the victim’s browser as if it came from the trusted website.
  </p>

  <h2>Types of XSS Attacks</h2>
  <ul>
    <li><strong>Reflected XSS:</strong> The payload is reflected immediately in the response, often via URL parameters.</li>
    <li><strong>Stored XSS:</strong> The malicious script is stored in a database and executed whenever a user views the infected page.</li>
    <li><strong>DOM-based XSS:</strong> The attack happens entirely in the browser through manipulation of the DOM without server-side involvement.</li>
  </ul>

  <h2>Example of Vulnerable Code (PHP)</h2>
  <pre><code>
$input = $_GET['name'];
echo \"&lt;h2&gt;Hello $input!&lt;/h2&gt;\";
  </code></pre>

  <p>If the user visits this URL:</p>
  <pre><code>?name=&lt;script&gt;alert('XSS')&lt;/script&gt;</code></pre>

  <p>The browser will execute:</p>
  <pre><code>alert('XSS')</code></pre>

  <h2>Potential Consequences</h2>
  <ul>
    <li>Session or cookie theft</li>
    <li>Page defacement</li>
    <li>Redirection to malicious websites</li>
    <li>Phishing with fake forms</li>
  </ul>

  <h2>How to Prevent XSS</h2>
  <ul>
    <li>Escape HTML special characters: <code>&lt;, &gt;, &amp;, \", '</code></li>
    <li>Use functions like <code>htmlspecialchars()</code> or frameworks with built-in protection</li>
    <li>Validate and sanitize all user input</li>
    <li>Use a strong Content Security Policy (CSP)</li>
  </ul>

  <h2>Secure Example</h2>
  <pre><code>
$input = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
echo \"&lt;h2&gt;Hello $input!&lt;/h2&gt;\";
  </code></pre>

  <p>
    This escapes the input, preventing it from being interpreted as HTML or JavaScript.
  </p>

</body>
</html>
