<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public const RULE_UNIQUE = "unique";
    public const RULE_NOEMAIL = "noemail";
    public const RULE_WRONGPASS = "wrongpass";
    public const RULE_CAPTCHA = "captcha";
    public array $errors = ["name" => [], "surname" => [], "email" => [], "password" => [], "passwordConfirm" => [], "message" => [], "task" => [], "status" => [], "passtext" => []];

    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract function rules(): array;

    public function labels(): array
    {
        return [];
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            // var_dump($value);

            foreach ($rules as $rule) {
                $rulename = $rule;
                if (!is_string($rule)) {
                    $rulename = $rule[0];
                }
                if ($rulename === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($rulename === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($rulename === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN);
                }
                if ($rulename === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX);
                }
                if ($rulename === self::RULE_MATCH && $value != $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH);
                }
                if ($rulename === self::RULE_CAPTCHA && $value != '10') {
                    $this->addError($attribute, self::RULE_CAPTCHA);
                }
                if ($rulename === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->pdo->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addError($attribute, self::RULE_UNIQUE);
                    }
                }
            }
        }
        if ($this->errors['name'] === [] && $this->errors['surname'] === [] && $this->errors['email'] === [] && $this->errors['password'] === [] && $this->errors['passwordConfirm'] === [] && $this->errors['message'] === [] && $this->errors['task'] === [] && $this->errors['passtext'] === []) {

            return true;
        } else {
            return false;
        }
    }

    public function addError($att, $type)
    {

        $this->errors[$att][] = $this->errorMessages()[$type] ?? '';
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This must be email address",
            self::RULE_MIN => "Use minimum 4 signs",
            self::RULE_MAX => "Too many signs",
            self::RULE_MATCH => "Second password is not similar",
            self::RULE_UNIQUE => "Your email is not unique and already exist",
            self::RULE_NOEMAIL => "Your email are not exist",
            self::RULE_WRONGPASS => "Incorrect password",
            self::RULE_CAPTCHA => "Incorrect number",
        ];
    }

    public function hasError($attr): bool
    {
        if ($this->errors[$attr] !== []) {

            return true;
        }
        return false;
    }

    public function getFirstError($attr): string
    {
        return empty($this->errors[$attr]) ? '' : $this->errors[$attr][0];
    }
}
