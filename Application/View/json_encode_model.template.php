<?php
header('Content-Type: application/javascript');
$callback = $this->parameters['callback'];
$json = json_encode($this->model);

if (!is_null($callback))
{
    print $callback . '(' . $json . ');';
}
else
{
    print $json;
}
?>
