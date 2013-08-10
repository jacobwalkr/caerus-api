<?php
$id = $this->GetParameter('id');
header('HTTP/1.1 201 Created');
header('Content-Location: /items/view/' . $id);
print json_encode($this->model, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
?>
