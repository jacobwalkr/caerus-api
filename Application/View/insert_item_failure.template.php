<?php
header('HTTP/1.1 500 Internal Server Error');
print json_encode($this->model, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
?>

