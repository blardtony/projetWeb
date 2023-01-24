<?php

namespace Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    protected $message = 'Cette route n\'existe pas.';

    public function route404()
    {
        http_response_code(404);
        
        require BASE_VIEW_PATH . 'errors/404.php';
    }
}