<?php

namespace app\core;

use function PHPSTORM_META\map;

abstract class DbModel extends Model
{
    abstract static function tableName(): string;
    abstract function attributes(): array;
    abstract static function primaryKey(): string;
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");
        // echo "<pre>";
        // var_dump($statement, $attributes, $params);
        // echo "</pre>";
        foreach ($attributes as $atr) {
            $statement->bindValue(":$atr", $this->{$atr});
        }
        $statement->execute();
        return true;
    }
    public static function prepare($sql)
    {
        return Aplication::$app->db->pdo->prepare($sql);
    }
    public static function findUser($where)
    {
        $table = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $table WHERE $sql");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}
