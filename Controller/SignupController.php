<?php

namespace Controller;

use Model\Token;
use Model\User;
use Validation\Validator;

class SignupController extends AbstractController
{
    public function index() {
        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        return $this->views('signup.index');
    }

    public function insert() {
        $user = (new User($this->db));

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'password' => ['required', 'min:8'],
            'email' => ['required', 'email'],
            'pseudo' => ['required']
        ]);
        if (strcmp($_POST['password'], $_POST['validate_password']) != 0) {
            $errors['password'][] = "Password doivent être identique";
        }

        if ($user->findByEmail($_POST['email'])) {
            $errors['email'][] = "email existe déjà";
        }

        if ($errors) {
            unset($_SESSION['errors']);
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/signup');
            exit;
        }

        unset($_POST['validate_password']);

        $user->insert($_POST);
        $token = (new Token($this->db))->insert($_POST['email']);
        $user->token($_POST['email'], $_POST['pseudo'], $token);
        return header('Location: /DiamondDogsProject/token');
    }
}