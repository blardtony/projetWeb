<?php

namespace Controller;

use Database\DbConnection;
use Model\User;

abstract class AbstractController {

    public function __construct(protected DbConnection $db)
    {
        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['userId'];
        if ($userId) {
            $user = (new User($this->db))->findById($userId);
            
            unset($user->password);
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['email'] = $user->email;
            $_SESSION['user']['pseudo'] = $user->pseudo;
            $_SESSION['user']['admin'] = $user->is_admin;
            $_SESSION['user']['score'] = $user->score;
            $_SESSION['user']['active'] = $user->active;
            $_SESSION['user']['id_group'] = $user->id_group;
        }
        
    }

    protected function views(string $path, array $params = null)
    {
        ob_start();

        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        
        require BASE_VIEW_PATH . $path . '.php';

        if ($params) {
            $params = extract($params);
        }

        $content = ob_get_clean();

        require BASE_VIEW_PATH . 'layout.php';

    }

    protected function getDb()
    {
        return $this->db;
    }

    protected function isConnected()
    {
        return !is_null($_SESSION["user"]['id']);
    }
    protected function isAdmin()
    {
        return ($_SESSION["user"]['admin']);
    }

}