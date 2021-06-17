<?php

namespace app\controllers;

use app\core\Aplication;
use app\core\Requests;
use app\core\Controller;
use app\core\Response;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function login(Requests $req, Response $res)
    {
        $loginData = new LoginForm();

        if ($req->getMethod() === "POST") {
            $loginData->loadData($req->getBody());
            if ($loginData->validate() && $loginData->login()) {
                $res->redirect('/');
                return;
            }
            $this->setLayout('auth');
            $this->render('login', ["model" => $loginData]);
            return;
        } else {
            $this->setLayout('auth');
            $this->render('login', ["model" => $loginData]);
        }
    }

    public function register(Requests $req)
    {
        $registerData = new User();
        if ($req->getMethod() === "POST") {
            $registerData->loadData($req->getBody());

            if ($registerData->validate() && $registerData->register()) {
                Aplication::$app->session->setFlash('register', 'Your account was registered');
                Aplication::$app->response->redirect('/');
                exit;
            }
            // echo "<pre>";
            // var_dump($registerData->errors);
            // echo "</pre>";
            // exit;
            $this->setLayout('auth');
            return $this->render('register', ["model" => $registerData]);
        }
        $this->setLayout('auth');
        return $this->render('register', ["model" => $registerData]);
    }
    public function logout(Requests $req, Response $res)
    {
        Aplication::$app->logout();
        $res->redirect('/');
    }
}
