<?php

namespace Controller;

use Model\User;
use Validation\Validator;
use Mail\Mail;

class LoginController extends AbstractController
{
    public function index() {
        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        return $this->views('login.index');
    }

    public function login() {
        unset($_SESSION['errors']);

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'password' => ['required', 'min:8'],
            'email' => ['required', 'email'],
        ]);
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/login');
            exit;
        }

        $user = (new User($this->db))->findByEmail($_POST["email"]);

        if (password_verify($_POST['password'], $user->password)) {
            if ($user->active) {
                $_SESSION['userId'] = $user->id;
                header('Location: /DiamondDogsProject/group');
                exit;
            }
            $errors["active"][] = "Votre compte doit être activé pour vous connecté. <a href='/DiamondDogsProject/email-verify'>Verifier votre compte</a>";
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/login');
            exit;
        }
        $errors['credentials'][] = "Email et password ne correspondent pas.";
        $_SESSION['errors'][] = $errors;
        return header('Location: /DiamondDogsProject/login');
    }

    public function resetPassword()
    {

        if ($_SESSION['user']) {
            header('Location: /DiamondDogsProject/group');
        }
        return $this->views('login.resetPassword');
    }

    public function updatePassword()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'email'], 
        ]);
        $userModel = (new User($this->db));
        $user = $userModel->findByEmail($_POST["email"]);

        if (!$user) {
            $errors['email'][] = "email not found";
        }

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/reset-password');
            exit;
        }
        $plainPassword = bin2hex(random_bytes(8));
        $data['password'] = password_hash($plainPassword, PASSWORD_DEFAULT);
        $userModel->update($user->id, $data);
        $body = "here is your new password, remember to change it " . $plainPassword;
        (new Mail())->send($_POST["email"], $user->pseudo, "password reset", $body);
        return header('Location: /DiamondDogsProject/login');
    }
}