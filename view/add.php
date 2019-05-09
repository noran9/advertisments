<?php
// Set response header to tell the browser that a response is in JSON format
header('Content-Type: application/json');
// Print the JSON object
echo json_encode($c);
?>