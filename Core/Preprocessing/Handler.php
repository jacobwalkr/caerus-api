<?php
class Handler
{
    // This function feels too long
    public static function Handle($raw_request)
    {
        /*
         * Split up the request components
         */
        // Split the query string from the URL
        $split_request = explode('?', $raw_request);

        // Use regex to split the main request up (the first match for explode)
        $uri_pattern = '~^/?(\w*)((/?(\w*))?(/?((\w*\/?)*)))?$~';
        $matches = array();
        preg_match($uri_pattern, $split_request[0], $matches);

        // Split the data bits up (as in /controller/action/data1/data2/data3)
        $raw_request_data = $matches[6];
        $nice_data = explode('/', $raw_request_data);

        // Split the query string up
        if (isset($split_request[1]))
        {
            $nice_query_dirty = explode('&', $split_request[1]);
            $nice_query = array();

            foreach ($nice_query_dirty as $query)
            {
                $bits = explode('=', $query);

                if (isset($bits[1]))
                {
                    $nice_query[$bits[0]] = $bits[1];
                }
                else
                {
                    $nice_query[$bits[0]] = true;
                }
            }
        }
        else
        {
            $nice_query = array();
        }

        /*
         * Create controller and send it on its way
         * No error checking yet!
         */
        $controllerName =  ucfirst(strtolower($matches[1])) . "Controller";
        require "Application/Controller/" . $controllerName . ".php";

        $controller = new $controllerName($nice_data, $nice_query);
        $controller->Go($matches[4]);
    }
}
