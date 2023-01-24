<?php

namespace Controller;

use Datetime;
use Model\Token;
use Model\User;
use Validation\Validator;

class TokenController extends AbstractController {
    public function index() {
        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        return $this->views('token.index');
    }

    public function token() {
        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        $tokenModel = (new Token($this->db));
        $token = $tokenModel->findByToken($_GET["token"]?? "");

        if ($tokenModel->isExpired($token->created_at)) {
            $user = (new User($this->db))->setActive($token->email);

            return $this->views('token.token', compact('user'));
        }
        return $this->views('token.token');
    }

    public function expired() {
        $this->views('token.expired');
    }

    public function send() {
        unset($_SESSION['errors']);

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'email']
        ]);
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/email-verify');
            exit;
        }
        $user = (new User($this->db))->findByEmail($_POST["email"]);
        
        if (!$user) {
            $errors['email'][] = "Email n'exite pas.";
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/email-verify');
            exit;
        }
        $token = (new Token($this->db))->insert($user->email);
        $user->token($user->email, $user->pseudo, $token);
        return header('Location: /DiamondDogsProject/token');
    }
}