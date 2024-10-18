<?php
/**
 * Класс для работы с моделями,
 * ActiveRecord
 */
namespace App\Models;

use App\Helpers\DBConnection;
use PDO;
use PDOException;

abstract class Model
{
    protected int $id;

    public function getId()
    {
        return $this->id;
    }

    public function getAttr(string $attr)
    {
        return $this->{$attr};
    }

    protected static function getTableName(): string
    {
        return static::$table ?? strtolower(static::class . 's');
    }

    protected static function getFields(): array
    {
        return static::$fields;
    }

    protected static function hasCreatedAt(): bool
    {
        return static::$has_created_at ?? false;
    }

    protected static function query(string $sql, array $params = [], string $class = null): array
    {
        if ($class === null) {
            $class = static::class;
        }
        $connection = DBConnection::getInstance()->connect();
        $query = $connection->prepare($sql);
        // try {
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_CLASS, $class);
        // } catch (PDOException $e) {
        //     echo $e->getMessage();
        // }
        // return [];
    }

    public static function all(): array
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' ORDER BY id';
        return static::query($sql);
    }

    public static function create(array $data, array $fields = []): static
    {
        if (empty($fields)) {
            $fields = static::getFields();
        }

        if (static::hasCreatedAt()) {
            $fields[] = 'created_at';
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        $values = implode(', ', array_map(fn ($field) => ":{$field}", array_unique($fields)));
        $fields = implode(', ', $fields);
        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $fields . ') VALUES (' . $values . ') RETURNING *';
        $rows = static::query($sql, $data);
        return $rows[0];
    }

    public static function find(int $id): ?object
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id LIMIT :limit';
        $rows = static::query($sql, [
            ':id' => $id,
            ':limit' => 1,
        ]);
        return $rows[0] ?? null;
    }

    public static function update(int $id, array $data, array $fields = []): void
    {
        if (empty($fields)) {
            $fields = static::getFields();
        }
        $fields = implode(', ', array_map(fn ($field) => "{$field} = :{$field}", array_unique($fields)));
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . $fields . ' WHERE id = :id';
        $data['id'] = $id;
        static::query($sql, $data);
    }

    public static function delete(int $id): void
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
        static::query($sql, [':id' => $id]);
    }

    public static function hasMany($class, string $foreign_key, string $local_key): array
    {
        $sql = 'SELECT * FROM ' . $class::getTableName() . ' WHERE ' . $foreign_key . ' = :' . $foreign_key .';';
        return static::query($sql, [':' . $foreign_key => $local_key], $class);
    }

    public static function load($related, string $foreign_key, array $ids): array
    {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = 'SELECT * FROM ' . $related::getTableName() . ' WHERE ' . $foreign_key . ' IN (' . $in . ');';
        return static::query($sql, $ids, $related);
    }
}
