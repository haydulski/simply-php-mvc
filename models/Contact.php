<?php

namespace app\models;


use app\core\Model;

class Contact extends Model
{
    public string $email = '';
    public string $message = '';
    public string $passtext = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'message' => [self::RULE_REQUIRED],
            'passtext' => [self::RULE_CAPTCHA]
        ];
    }

    public function attributes(): array
    {
        return ["email", "message", "passtext"];
    }

    public function labels(): array
    {
        return ["email" => "Your email", "message" => "Your message"];
    }
}
