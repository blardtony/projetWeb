<?php

namespace Router;

use Configuration\Environment;
use Database\DbConnection;

class Route {
    public $matches;

    public function __construct(public string $path, public string $action)
    {
        $this->path = trim($path, '/');
    }

    public function matches(string $url): bool
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);

        $pathToMatch = "#^$path$#";
        
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        }
        return false;
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0](new DbConnection(Environment::DB_NAME, Environment::DB_HOST, Environment::DB_USER, Environment::DB_PASS));
        $method = $params[1];
        
        return isset($this->matches[1])
            ? $controller->$method($this->matches[1])
            : $controller->$method();
    }
}