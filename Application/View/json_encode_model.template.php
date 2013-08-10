<?php
header('Content-Type: application/javascript');
$callback = $this->parameters['callback'];
$json = json_encode($this->model, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

if (!is_null($callback))
{
    print $callback . '(' . $json . ');';
}
else
{
    print $json;
}
?>
