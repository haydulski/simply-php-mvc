<?php

namespace app\models;


use app\core\Model;

class Contact extends Model
{
    public string $email = '';
    public string $message = '';
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'message' => [self::RULE_REQUIRED],
        ];
    }
    public function attributes(): array
    {
        return ["email", "message"];
    }
    public function labels(): array
    {
        return ["email" => "Your email", "message" => "Your message"];
    }
}
