<?php
$code = $this->GetParameter('code');
$message = $this->GetParameter('message');
?>
{
    "error": {
        "code":<?php echo $code; ?>,
        "message":"<?php echo $message; ?>"
    }
}
