<?php

namespace Controller;

use Model\Group;
use Model\User;
use Model\Team;
use Model\Game;
use Model\Bet;
use Validation\Validator;

class UserController extends AbstractController
{
    public function me()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $betModel = new Bet($this->db);
        $bets = $betModel->findByUser($_SESSION['user']['id']);
        return $this->views('user.me', compact('bets'));
    }

    public function settings()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        return $this->views('user.settings');
    }

    public function pseudo()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        return $this->views('user.pseudo');
    }

    public function updatePseudo()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $userModel = (new User($this->db));

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'pseudo' => ['required']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/user/settings/update-pseudo');
            exit;
        }
        $id = $_SESSION['user']['id'];
        $userModel->update($id, $_POST);
        header('Location: /DiamondDogsProject/user/settings');
    }

    public function email()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        return $this->views('user.email');
    }

    public function updateEmail()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $userModel = (new User($this->db));

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'email']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/user/settings/update-email');
            exit;
        }
        $id = $_SESSION['user']['id'];
        $userModel->update($id, $_POST);
        header('Location: /DiamondDogsProject/user/settings');
    }

    public function logout()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        unset($_SESSION['user']);
        unset($_SESSION['userId']);

        return header('Location: /DiamondDogsProject/');
    }

    public function password()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        return $this->views('user.password');
    }

    public function updatePassword()
    {
        $userModel = (new User($this->db));

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'oldPassword' => ['required', 'min:8'],
            'password' => ['required', 'min:8']
        ]);

        $oldPasswordHash = $userModel->findByEmail($_SESSION['user']['email'])->password;
        if (strcmp($_POST['password'], $_POST['passwordAgain']) != 0) {
            $errors['password'][] = "password and validate Password must be the same";
        }
        if (!password_verify($_POST['oldPassword'], $oldPasswordHash)) {
            $errors['oldPassword'][] = "OldPassword doesn't match";
        }
        if ($errors) {
            unset($_SESSION['errors']);
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/user/settings/update-password');
            exit;
        }
        unset($_POST['oldPassword']);
        unset($_POST['passwordAgain']);

        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel->update($_SESSION['user']['id'], $data);

        return header('Location: /DiamondDogsProject/user/settings');
    }

}