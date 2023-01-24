<?php

namespace Controller;

use Model\User;

class HomeController extends AbstractController
{
    public function index()
    {
        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        return $this->views('home.index');
    }
}