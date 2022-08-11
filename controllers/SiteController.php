<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Requests;
use app\models\Contact;
use app\core\Application;

class SiteController extends Controller
{
    public function handleContact(Requests $req): string
    {
        $body = $req->getBody();
        return "Handled subimitng data";
    }

    public function handleHome(): Application
    {
        $params = [
            "name" => "Damian wita",
        ];
        return $this->render('home', $params);
    }

    public function contact(Requests $req): void
    {
        $contactData = new Contact();

        if ($req->getMethod() === "POST") {
            $contactData->loadData($req->getBody());
            if ($contactData->validate()) {
                Application::$app->session->setFlash('success', 'Your message is coming to us!');
                Application::$app->response->redirect('/contact');
                exit;
            }
            Application::$app->session->setFlash('danger', 'Confirm your humanity...');
            $this->render('contact', ["model" => $contactData]);
            return;
        } else {
            $this->render('contact', ["model" => $contactData]);
        }
    }
}
