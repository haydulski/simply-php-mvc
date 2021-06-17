<?php

namespace app\models;

use app\core\Aplication;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    public User $user;
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }
    public function attributes(): array
    {
        return ["email", "password"];
    }
    public function labels(): array
    {
        return ["email" => "Your email", "password" => "Password"];
    }
    public function login()
    {
        $user = User::findUser(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', self::RULE_NOEMAIL);
            return false;
        }
        if (!password_verify($this->password, $user->password)) {

            $this->addError('password', self::RULE_WRONGPASS);
            return false;
        }
        return Aplication::$app->login($user);
    }
}
