<?php

namespace app\controllers;

use app\core\Aplication;
use app\core\Requests;
use app\core\Controller;
use app\core\Response;
use app\models\User;
use app\models\LoginForm;
use app\core\middlewares\AuthMiddleware;
use app\models\TodoForm;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        $this->registerMiddleware(new AuthMiddleware(['addNewTodo']));
        $this->registerMiddleware(new AuthMiddleware(['editTodo']));
    }
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
                Aplication::$app->session->setFlash('success', 'Your account was registered');
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
    public function profile(Requests $req)
    {
        $todoForm = new TodoForm();
        if ($req->getMethod() === "POST") {
            $idOfTask = $_POST['id'];

            if ($idOfTask) {
                $todoForm->deleteTask($idOfTask);
            }

            $params = [
                "name" => Aplication::$app->user->{'name'},
                "surname" => Aplication::$app->user->{'surname'},
            ];
            return $this->render('profile', $params);
        }
        $params = [
            "name" => Aplication::$app->user->{'name'},
            "surname" => Aplication::$app->user->{'surname'},
        ];
        return $this->render('profile', $params);
    }
    public function addNewTodo(Requests $req)
    {
        $todoForm = new TodoForm();
        if ($req->getMethod() === "POST") {
            $todoForm->loadData($req->getBody());

            if ($todoForm->validate() && $todoForm->addNewTask()) {
                Aplication::$app->session->setFlash('success', 'You added new task');
                Aplication::$app->response->redirect('/profile');
                exit;
            }

            return $this->render('addtodo', ["model" => $todoForm]);
        }
        $this->render('addtodo', ["model" => $todoForm]);
    }
    public function editTodo(Requests $req)
    {
        $todoForm = new TodoForm();
        $todoId = $_GET['id'];
        if ($req->getMethod() === "POST") {
            $newValue = $_POST['status'];

            if ($todoForm->editTask($todoId, $newValue)) {
                Aplication::$app->session->setFlash('success', 'Task has been edited');
                Aplication::$app->response->redirect('/profile');
                exit;
            }

            return $this->render('editTodo', ["model" => $todoForm]);
        }
        $this->render('editTodo', ["model" => $todoForm]);
    }
}
