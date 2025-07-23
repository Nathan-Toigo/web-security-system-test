<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OS Command Injection (OSCI) Vulnerability</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

  <h1>Understanding OS Command Injection (OSCI)</h1>

  <p>
    <strong>OS Command Injection</strong> is a security vulnerability that allows an attacker to execute arbitrary system commands
    on the server where the application is running. This happens when user input is passed directly into system-level
    functions without proper sanitization or validation.
  </p>

  <h2>Example of Vulnerable Code (PHP)</h2>
  <pre><code>
$ip = $_GET['ip'];
system("ping -c 4 " . $ip);
  </code></pre>

  <p>If a user inputs the following:</p>
  <pre><code>127.0.0.1; ls</code></pre>

  <p>The system will execute:</p>
  <pre><code>ping -c 4 127.0.0.1; ls</code></pre>

  <p>This causes the server to ping an IP <em>and</em> list files in the current directory, which could expose sensitive data.</p>

  <h2>Potential Consequences</h2>
  <ul>
    <li>Arbitrary command execution on the server</li>
    <li>Access to sensitive system files</li>
    <li>File deletion or modification</li>
    <li>Backdoor creation or full server compromise</li>
  </ul>

  <h2>How to Prevent It</h2>
  <ul>
    <li>Never pass raw user input into system functions</li>
    <li>Use <code>escapeshellarg()</code> or <code>escapeshellcmd()</code> in PHP to sanitize inputs</li>
    <li>Validate user input against a strict allowlist (e.g. IP format only)</li>
    <li>Use safer alternatives like <code>proc_open()</code> with controlled arguments</li>
    <li>Run server processes with the least privileges possible</li>
  </ul>

  <h2>Secure Example</h2>
  <pre><code>
$ip = escapeshellarg($_GET['ip']);
system("ping -c 4 $ip");
  </code></pre>

  <p>This ensures special characters are escaped, preventing command injection.</p>

</body>
</html>
