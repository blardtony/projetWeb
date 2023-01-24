<?php

namespace Controller;

use Model\Comment;
use Model\User;

class AdminController extends AbstractController
{
    public function index()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        return $this->views('admin.index');
    }

    public function user()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        $user = new User($this->db);
        $users = $user->findAll();
        return $this->views('admin.user', compact('users'));
    }

    public function deactivate(int $id)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        $userModel = new User($this->db);
        $userModel->update($id, [
            'active' => 0
        ]);
        return header('Location: /DiamondDogsProject/admin/user');
    }

    public function activate(int $id)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        $userModel = new User($this->db);
        $userModel->update($id, [
            'active' => 1
        ]);
        return header('Location: /DiamondDogsProject/admin/user');
    }

    public function comment()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        $commentModel = new Comment($this->db);
        $comments = $commentModel->findWithPseudo();   
        return $this->views('admin.comment', compact('comments'));
    }

    public function deleteComment(int $id)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        if (!$this->isAdmin()) {
            return header('Location: /DiamondDogsProject/group');
        }
        $commentModel = new Comment($this->db);
        $commentModel->delete($id);
        return header('Location: /DiamondDogsProject/admin/comment');
    }
}