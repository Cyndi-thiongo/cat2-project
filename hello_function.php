<?php
header('Content-Type: application/json');
echo json_encode([
    "function" => "hello_function",
    "message"  => "Executed on demand",
    "time"     => date("c")
]);