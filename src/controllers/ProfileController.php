<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;

class ProfileController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser === false){
        $this->redirect('/login');
        }
    }
    
    public function index($atts = []) {
        $page = intval(filter_input(INPUT_GET, 'page'));

        //verificando o usuario acessado 
        $id = $this->loggedUser->id;

        if(!empty($atts['id'])){
            $id = $atts['id'];
        }

        //Pegando as informações do Usuario
        $user = UserHandler::getUser($id, true);

        if(!$user){
            $this->redirect('/');
        }

        //conta para achar idade
        $dateFrom = new \DateTime($user->birthdate);
        $dateTo = new \DateTime('today');
        $user->ageYears = $dateFrom->diff($dateTo)->y;

        //Pegando o feed do usuário
        $feed = PostHandler::getUserFeed($id, $page, $this->loggedUser->id);
        
        //Verificar se eu sigo o usuário
        $isFollowing = false;
        if($user->id != $this->loggedUser->id){
            $isFollowing = UserHandler::isFollowing($this->loggedUser->id, $user->id);
        }
        $this->render('profile',['loggedUser' => $this->loggedUser, 'user'=> $user, 'feed' => $feed, 'isFollowing' => $isFollowing]);

    }

    public function follow($atts){
        $to = $atts['id'];

        if(UserHandler::idExists($to)) {
            if(UserHandler::isFollowing($this->loggedUser->id, $to)){
                UserHandler::unfollow($this->loggedUser->id, $to);
            }else {
                UserHandler::follow($this->loggedUser->id, $to);
            }
        }

        $this->redirect('/perfil/'.$to);
    }

    public function friends($atts = []){

        $id = $this->loggedUser->id;

        if(!empty($atts['id'])){
            $id = $atts['id'];
        }

        //Pegando as informações do Usuario
        $user = UserHandler::getUser($id, true);

        if(!$user){
            $this->redirect('/');
        }

        //conta para achar idade
        $dateFrom = new \DateTime($user->birthdate);
        $dateTo = new \DateTime('today');
        $user->ageYears = $dateFrom->diff($dateTo)->y;

        $isFollowing = false;
        if($user->id != $this->loggedUser->id){
            $isFollowing = UserHandler::isFollowing($this->loggedUser->id, $user->id);
        }

        $this->render('profile_friends',['loggedUser' => $this->loggedUser, 'user'=> $user, 'isFollowing' => $isFollowing]);

    }

    public function photos($atts = []){

        $id = $this->loggedUser->id;

        if(!empty($atts['id'])){
            $id = $atts['id'];
        }

        //Pegando as informações do Usuario
        $user = UserHandler::getUser($id, true);

        if(!$user){
            $this->redirect('/');
        }

        //conta para achar idade
        $dateFrom = new \DateTime($user->birthdate);
        $dateTo = new \DateTime('today');
        $user->ageYears = $dateFrom->diff($dateTo)->y;

        $isFollowing = false;
        if($user->id != $this->loggedUser->id){
            $isFollowing = UserHandler::isFollowing($this->loggedUser->id, $user->id);
        }

        $this->render('profile_photos',['loggedUser' => $this->loggedUser, 'user'=> $user, 'isFollowing' => $isFollowing]);

    }


}