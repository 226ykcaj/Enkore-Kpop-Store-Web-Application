<?php
// Enable the use of only cookies for session storage, enhancing security against session fixation attacks
ini_set("session.use_only_cookies", 1);

// Enable strict session mode to generate new session IDs for each session, even if the user is not authenticated
ini_set("session.use_strict_mode", 1);

// Set parameters for the session cookie
session_set_cookie_params([
    "lifetime" => "1800",  // Set the lifetime of the session cookie to 1800 seconds (30 minutes)
    "domain" => "localhost",  // Specify the domain for which the session cookie is valid (localhost)
    "path" => "/",  // Specify the path on the server for which the cookie will be available (entire domain)
    "secure" => true,  // Transmit the cookie only over HTTPS for enhanced security
    "httponly" => true  // Set the HTTPOnly flag on the cookie to prevent client-side access
]);

// Start the session, allowing storage and retrieval of session data using $_SESSION superglobal variables
session_start();