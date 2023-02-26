<?php
// Set the expiration time to a past date
$expiration_time = time() - 3600; // 1 hour ago

// Unset the cookie by setting its expiration time to the past
setcookie('device_id', '', $expiration_time, '/');
header("Refresh: 0");