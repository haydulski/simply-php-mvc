<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Requests;
use app\core\Response;
use app\models\Contact;
use app\core\Aplication;

class SiteController extends Controller
{
    public function handleContact(Requests $req)
    {
        $body = $req->getBody();
        return "Handled subimitng data";
    }
    public function handleHome()
    {
        $params = [
            "name" => "Damian wita",
        ];
        return $this->render('home', $params);
    }
    public function contact(Requests $req, Response $res)
    {
        $contactData = new Contact();

        if ($req->getMethod() === "POST") {
            $contactData->loadData($req->getBody());
            if ($contactData->validate()) {
                Aplication::$app->session->setFlash('success', 'Your message is coming to us!');
                Aplication::$app->response->redirect('/contact');
                exit;
            }
            $this->render('contact', ["model" => $contactData]);
            return;
        } else {
            $this->render('contact', ["model" => $contactData]);
        }
    }
}
