<?php

foreach (glob('Core/*.php') as $file)
{
    require $file;
}

foreach (glob('Core/*/') as $folder)
{
    foreach (glob($folder . '*.php') as $file)
    {
        require $file;
    }
}

System::Initialise();
Handler::Handle($_SERVER['REQUEST_URI']);

?>
