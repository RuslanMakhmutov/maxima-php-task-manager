<?php
/**
 * Класс для работы с моделями,
 * ActiveRecord
 */
namespace app\Models;

use app\Helpers\DBConnection;
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

    protected static function query(string $sql, array $params = [], string $class = null): array
    {
        if ($class === null) {
            $class = static::class;
        }
        $connection = DBConnection::getInstance()->connect();
        $query = $connection->prepare($sql);
        try {
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_CLASS, $class);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];
    }

    public static function all(): array
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' ORDER BY id';
        return static::query($sql);
    }

    public static function create(array $data): static
    {
        $fields = static::getFields();
        $fields[] = 'created_at';
        // TODO - этого не должно быть в абстрактной модели
        $fields[] = 'user_id';

        $values = implode(', ', array_map(fn ($field) => ":{$field}", $fields));
        $fields = implode(', ', $fields);
        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $fields . ') VALUES (' . $values . ') RETURNING *';
        $rows = static::query($sql, $data);
        return $rows[0];
    }

    public static function find(int $id): ?object
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id LIMIT 1';
        $rows = static::query($sql, [':id' => $id]);
        return $rows[0] ?? null;
    }

    public static function update(int $id, array $data): void
    {
        $fields = implode(', ', array_map(fn ($field) => "{$field} = :{$field}", static::getFields()));
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . $fields . ' WHERE id = :id';
        $data['id'] = $id;
        static::query($sql, $data);
    }

    public static function delete(int $id): void
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
        static::query($sql, [':id' => $id]);
    }
}
