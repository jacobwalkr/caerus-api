<?php
header('Content-Type: application/javascript');
$callback = $this->model->getCallback();
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
