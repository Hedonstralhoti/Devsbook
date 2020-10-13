<?php
namespace src\handlers;

use \src\models\User;

class LoginHandler {
    
    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) > 0){

                $loggedUser = new User();
                $loggedUser->id = ($data['id']);
                $loggedUser->name = ($data['name']);
                $loggedUser->avatar = ($data['avatar']);

                return $loggedUser;
            }else {
                return false;
            }

        } 
        return false;
    }
    public static function verifyLogin($email, $password) {
        $user = User::select()->where('email', $email)->one();

        if($user){
            if(password_verify($password, $user['password'])){
                $token = md5(time().rand(0,9999).time());

                User::update()->set('token', $token)->where('email', $email)->execute();
                return $token;
            }
        }
        return false;
    }
    public static function emailExists($email){
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }

    public static function addUser($name, $email, $password, $birthdate){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());
        User::insert([
            'email'=> $email,
            'name'=> $name,
            'password'=> $hash,
            'birthdate'=> $birthdate,
            'avatar'=> 'default.jpg',
            'cover' => 'cover.jpg',
            'token' => $token
        ])->execute();

        return $token;
    }
    
}