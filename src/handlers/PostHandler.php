<?php
namespace src\handlers;

use \src\models\Post;
use \src\models\User;
use \src\models\UserRelation;

class PostHandler {

    public static function addPost($idUser, $type, $body){
        $body = trim($body);

        if(!empty($idUser) && !empty($body)){

            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body
            ])->execute();
        }
    }

    public function _postListtoObject($postList, $loggedUserId){

        //transformando o resultado em objetos dos models
        $posts = [];
        foreach($postList as $postItem){
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->created_at = $postItem['created_at'];
            $newPost->body = $postItem['body'];
            $newPost->mine = false;

            if($postItem['id_user'] == $loggedUserId){
                $newPost->mine = true;
            }

            //Preencher as informações do usuario no post
            $newUser = User::select()->where('id', $postItem['id_user'])->one();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];

            //Preencher informações de Likes
            $newPost->LikeCount = 0;
            $newPost->Liked = false;

            //Preencher informações de comments
            $newPost->comments = [];
            

            $posts[] = $newPost;
            
        }

        return $posts;
    }

    public static function getUserFeed($idUser, $page, $loggedUserId){
        $perPage = 2;

        $postList = Post::select()->where('id_user', $idUser)->orderBy('created_at', 'desc')->page($page,  $perPage)->get();
        
        $total = Post::select()->where('id_user', $idUser)->count();

        $pageCount = ceil($total / $perPage);

        $posts = self::_postListtoObject($postList, $loggedUserId);
            
        //Retornar resultados
        return ['posts' => $posts, 'pageCount' => $pageCount, 'currentPage' => $page];
    }
    
    public static function getHomeFeed($idUser, $page){
        $perPage = 2;

        //Pegando a lista de amigos do usuario
        $userList = UserRelation::select()->where('user_from', $idUser)->get();
        $users = [];
        foreach($userList as $userItem) {
            $users[] = $userItem['user_to'];
        }
        $users[] = $idUser;
        //pegando os posts ordenados por data
        $postList = Post::select()->where('id_user', 'in', $users)->orderBy('created_at', 'desc')->page($page,  $perPage)->get();
        
        $total = Post::select()->where('id_user', 'in', $users)->count();

        $pageCount = ceil($total / $perPage);

        //transformando o resultado em objetos dos models
        $posts = self::_postListtoObject($postList, $idUser);
        //Retornar resultados
        return ['posts' => $posts, 'pageCount' => $pageCount, 'currentPage' => $page];
    }

    public function getPhotosFrom($idUser){
        $photosData = Post::select()
        ->where('id_user', $idUser)
        ->where('type', 'photo')
        ->get();

        $photos = [];

        foreach($photosData as $photo){
            $newPost = new Post();
            $newPost->id = $photo['id'];
            $newPost->type = $photo['type'];
            $newPost->created_at = $photo['created_at'];
            $newPost->body = $photo['body'];

            $photos[] = $newPost;
        }

        return $photos;
    }

}

