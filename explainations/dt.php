<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Directory Traversal Vulnerability</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <h1>Understanding Directory Traversal Vulnerability</h1>

  <p>
    <strong>Directory Traversal</strong> (also known as <em>Path Traversal</em>) is a security vulnerability that allows an attacker
    to access files and directories that are stored outside the intended directory. It occurs when user input
    is used to construct file paths without proper validation.
  </p>

  <h2>Example of Vulnerable Code (PHP)</h2>
  <pre><code>
$file = $_GET['page'];
include("pages/" . $file);
  </code></pre>

  <p>If the user accesses:</p>
  <pre><code>?page=about.html</code></pre>
  <p>The code will include:</p>
  <pre><code>pages/about.html</code></pre>

  <p>But an attacker could instead request:</p>
  <pre><code>?page=../../../../etc/passwd</code></pre>

  <p>Which results in:</p>
  <pre><code>include("pages/../../../../etc/passwd");</code></pre>

  <p>This can expose sensitive system files or application source code.</p>

  <h2>Possible Consequences</h2>
  <ul>
    <li>Reading sensitive configuration files (e.g. <code>/etc/passwd</code>)</li>
    <li>Accessing source code or internal data</li>
    <li>Bypassing authentication or authorization mechanisms</li>
    <li>Potential Remote Code Execution (RCE) if attacker accesses files with executable content</li>
  </ul>

  <h2>How to Prevent It</h2>
  <ul>
    <li>Never trust user input in file paths</li>
    <li>Use a whitelist of allowed files (e.g. predefined filenames only)</li>
    <li>Normalize paths and check that they stay within the intended base directory</li>
    <li>Use built-in path functions like <code>realpath()</code> to resolve and verify paths</li>
    <li>Disable dangerous PHP functions like <code>include()</code> if not needed</li>
  </ul>

  <h2>Secure Example</h2>
  <pre><code>
$allowed_pages = ['home.html', 'about.html', 'contact.html'];
$page = $_GET['page'];

if (in_array($page, $allowed_pages)) {
  include('pages/' . $page);
} else {
  echo \"Invalid page.\";
}
  </code></pre>

  <p>This ensures only explicitly allowed pages can be loaded.</p>

</body>
</html>
