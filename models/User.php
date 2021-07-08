<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    public string $passtext = '';

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;
    public int $status = self::STATUS_INACTIVE;

    public function register()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    public static function tableName(): string
    {
        return "user";
    }

    public function attributes(): array
    {
        return ["name", "surname", "email", "password", "status", "passtext"];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'surname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 10]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'passtext' => [self::RULE_CAPTCHA]
        ];
    }

    public function labels(): array
    {
        return ['name' => 'Name', 'surname' => 'Last name', 'email' => 'Your email', 'password' => 'Password', 'passwordConfirm' => 'Confirm password'];
    }

    public static function primaryKey(): string
    {
        return "ID";
    }
}
