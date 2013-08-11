<?php
$token = $this->GetParameters('token');
?>
{
    "success": {
        "auth_token":"<?php echo $token; ?>"
    }
}
