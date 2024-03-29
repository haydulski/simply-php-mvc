<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Application;
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

    public function login(Requests $req, Response $res): void
    {
        $loginData = new LoginForm();

        if ($req->getMethod() === "POST") {
            $loginData->loadData($req->getBody());
            if ($loginData->validate() && $loginData->login()) {
                $res->redirect('/');
                return;
            }
            $this->setLayout('auth');
            Application::$app->session->setFlash('danger', 'Confirm your humanity...');
            $this->render('login', ["model" => $loginData]);

            return;
        } else {
            $this->setLayout('auth');
            $this->render('login', ["model" => $loginData]);
        }
    }

    public function register(Requests $req): Application
    {
        $registerData = new User();
        if ($req->getMethod() === "POST") {
            $registerData->loadData($req->getBody());

            if ($registerData->validate() && $registerData->register()) {
                Application::$app->session->setFlash('success', 'Your account was registered');
                Application::$app->response->redirect('/');
                exit;
            }
            $this->setLayout('auth');
            Application::$app->session->setFlash('danger', 'Confirm your humanity...');

            return $this->render('register', ["model" => $registerData]);
        }

        $this->setLayout('auth');

        return $this->render('register', ["model" => $registerData]);
    }

    public function logout(Response $res): void
    {
        Application::$app->logout();
        $res->redirect('/');
    }

    public function profile(Requests $req): Application
    {
        $todoForm = new TodoForm();
        if ($req->getMethod() === "POST") {
            $idOfTask = $_POST['id'];

            if ($idOfTask) {
                $todoForm->deleteTask($idOfTask);
            }

            $params = [
                "name" => Application::$app->user->{'name'},
                "surname" => Application::$app->user->{'surname'},
            ];
            return $this->render('profile', $params);
        }
        $params = [
            "name" => Application::$app->user->{'name'},
            "surname" => Application::$app->user->{'surname'},
        ];

        return $this->render('profile', $params);
    }

    public function addNewTodo(Requests $req): Application
    {
        $todoForm = new TodoForm();
        if ($req->getMethod() === "POST") {
            $todoForm->loadData($req->getBody());

            if ($todoForm->validate() && $todoForm->addNewTask()) {
                Application::$app->session->setFlash('success', 'You added new task');
                Application::$app->response->redirect('/profile');
                exit;
            }

            return $this->render('addtodo', ["model" => $todoForm]);
        }
        $this->render('addtodo', ["model" => $todoForm]);
    }

    public function editTodo(Requests $req): Application
    {
        $todoForm = new TodoForm();
        $todoId = $_GET['id'];
        if ($req->getMethod() === "POST") {
            $newValue = $_POST['status'];

            if ($todoForm->editTask($todoId, $newValue)) {
                Application::$app->session->setFlash('success', 'Task has been edited');
                Application::$app->response->redirect('/profile');
                exit;
            }

            return $this->render('editTodo', ["model" => $todoForm]);
        }
        $this->render('editTodo', ["model" => $todoForm]);
    }
}
