<?php

namespace Controller;

use Model\Group;
use Model\User;
use Model\Team;
use Model\Game;
use Model\Bet;
use Model\Comment;
use Validation\Validator;

class GroupController extends AbstractController
{
    public function index()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $group = NULL;
        $idGroup = $_SESSION['user']['id_group'];
        if ($idGroup) {
            $group = (new Group($this->db))->findById($idGroup);
            $users = (new User($this->db))->findByGroup($idGroup);

            $isOwner = $this->isOwner($idGroup);
        }
        return $this->views('group.index', compact('group', 'users', 'isOwner'));
    }

    public function index_data()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $group = NULL;
        if ($_SESSION['user']['id_group']) {
            $group = (new Group($this->db))->findById($_SESSION['user']['id_group']);
        }
        return compact('group');
    }

    public function create()
    {
        return $this->views('group.create');
    }

    public function insert()
    {
        unset($_SESSION['errors']);
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'name' => ['required', 'min:3']
        ]);
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /DiamondDogsProject/group/create');
            exit;
        }
        $data = $_POST;
        $idUser = $_SESSION['user']['id'];
        $data["owner"] = $idUser;
        (new Group($this->db))->insert($data);
        $idGroup = (new Group($this->db))->findByName($data["name"])->id;
        (new User($this->db))->setGroup($idGroup, $idUser);

        return header('Location: /DiamondDogsProject/group');
    }

    public function game()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $id = $_SESSION['user']['id_group'];
        $idUser = $_SESSION['user']['id'];
        $gamesByGroup = (new Game($this->db))->findByGroupAndOrderByDay($id, $idUser);
        $games = [];
        foreach ($gamesByGroup as $game) {
            $games[$game->day][] = $game;
        }

        $isOwner = $this->isOwner($id);
        return $this->views('group.games', compact('games', 'id', 'isOwner'));
    }

    public function createGame()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $id = $_SESSION['user']['id_group'];
        $teams = (new Team($this->db))->findAll();
        return $this->views('group.createGame', compact('teams', 'id'));
    }

    public function insertGame()
    {
        unset($_SESSION['errors']);
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $id = $_SESSION['user']['id_group'];
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'day' => ['required', 'day'],
            'start_at' => ["required"]
        ]);

        $gameModel = (new Game($this->db));
        $teamHost = $gameModel->findTeamsByDay($_POST['day'], $_POST['id_host'], $id);
        $teamGuest = $gameModel->findTeamsByDay($_POST['day'], $_POST['id_guest'], $id);
        if ($teamHost) {
            $errors['host'][]= "Home team already exist this day";
        }
        if ($teamGuest) {
            $errors['guest'][]= "Away team already exist this day";
        }
        if ($_POST['id_host'] === $_POST['id_guest']) {
            $errors['teams'][]= "Home and away teams cannot be the same";
        }
        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header("Location: /DiamondDogsProject/group/games/create");
            exit;
        }

        $data = $_POST;
        $data["id_group"] = $id;
        $gameModel->insert($data);

        return header('Location: /DiamondDogsProject/group/games');
    }

    public function addScore(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $game = (new Game($this->db))->findOneByIdWithTeamName($idGame);
        return $this->views('group.addScore', compact('idGame', 'game'));
    }

    public function addScore_data(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $game = (new Game($this->db))->findOneByIdWithTeamName($idGame);
        return compact('idGame', 'game');
    }

    public function updateScore(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $result = (new Game($this->db))->update($idGame, $_POST);
        $game = (new Game($this->db))->findById($idGame);
        $bets = (new Bet($this->db))->findByGameId($idGame);

        foreach ($bets as $bet) {

            $score = 0;
            if (($bet->host_score == $game->host_score && $bet->guest_score == $game->guest_score)) {
                $score = 5;
            }elseif (($game->guest_score - $game->host_score) == ($bet->guest_score - $bet->host_score)){
                $score = 3;
            }elseif (($game->guest_score == $game->host_score) && ($bet->guest_score == $bet->host_score)) {
                $score = 1;
            }elseif ((($game->guest_score > $game->host_score) && ($bet->guest_score > $bet->host_score)) || (($game->guest_score < $game->host_score) && ($bet->guest_score < $bet->host_score))) {
                $score = 1;
            }

            if ($score > 0) {
                $userModel = new User($this->db);
                $oldScore = ($userModel->findById($bet->user_id))->score;
                $data["score"] = $score + $oldScore;
                $userModel->update($bet->user_id, $data);
            }
            
        }
        return header('Location: /DiamondDogsProject/group/games');       
    }

    public function isOwner(int $idGroup)
    {
        return ((new Group($this->db))->findById($idGroup))->owner === $_SESSION['user']['id'];
    }


    public function bet(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $game = (new Game($this->db))->findOneByIdWithTeamName($idGame);
        return $this->views('group.bet', compact('idGame', 'game'));
    }

    public function bet_data(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $game = (new Game($this->db))->findOneByIdWithTeamName($idGame);
        return compact('idGame', 'game');
    }

    public function insertBet(int $idGame)
    {
        unset($_SESSION['errors']);
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'host_score' => ['required'],
            'guest_score' => ["required"]
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header("Location: /DiamondDogsProject/group/games/{$idGame}/bet");
            exit;
        }

        $data = $_POST;
        $data["game_id"] = $idGame;
        $data["user_id"] = $_SESSION['user']['id'];

        (new Bet($this->db))->insert($data);

        return header('Location: /DiamondDogsProject/group/games');
    }


    public function inviteUser()
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }
        $id = $_SESSION['user']['id_group'];
        if (!$this->isOwner($id)) {
            return header('Location: /DiamondDogsProject/group');
        }
        return $this->views('group.invite');
    }

    public function sendInviteUser()
    {
        $id = $_SESSION['user']['id_group'];
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'email']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header("Location: /DiamondDogsProject/group/add-user");
            exit;
        }
        $userModel = (new User($this->db));
        $user = $userModel->findByEmail($_POST['email']);
        if (!$user) {
            $errors['email'][] = "Email doesn't exist";
            $_SESSION['errors'][] = $errors;
            header("Location: /DiamondDogsProject/group/add-user");
            exit;
        }
        $groupModel = (new Group($this->db));
        $group = $groupModel->findById($id);
        $userModel->sendInvite($user->email, $user->pseudo, $group->name);
        $userModel->setGroup($id, $user->id);
        return header('Location: /DiamondDogsProject/group');
    }

    public function gameDetails(int $idGame)
    {
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $game = (new Game($this->db))->findOneByIdWithTeamName($idGame);
        $comments = (new Comment($this->db))->findByGameId($idGame);

        $betModel = new Bet($this->db);
        $bets = $betModel->findByGameDatailId($idGame);

        return $this->views('group.gameDetails', compact('idGame', 'game', 'comments', 'bets'));
    }

    public function insertComment(int $idGame)
    {
        unset($_SESSION['errors']);
        if (!$this->isConnected()) {
            return header('Location: /DiamondDogsProject/login');
        }

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'message' => ['required'],
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header("Location: /DiamondDogsProject/group/games/{$idGame}/gameDetails");
            exit;
        }

        $data = $_POST;
        $data["id_game"] = $idGame;
        $data["id_user"] = $_SESSION['user']['id'];
        $data["posted_at"] = date("Y-m-d H:i:s");

        (new Comment($this->db))->insert($data);

        return header("Location: /DiamondDogsProject/group/games/{$idGame}/gameDetails");
    }
}