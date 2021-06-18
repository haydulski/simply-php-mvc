<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Requests;

class SiteController extends Controller
{
    public function handleUser(Requests $req)
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
}
