<?php


class QueryBuilder
{

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select($table, $columns = ['*'], $where = [])
    {
        $sql = sprintf(
            'SELECT %s FROM %s',
            implode(', ', $columns),
            $table
        );

        if (sizeof($where) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );


        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function update($table, $parameters, $where = [])
    {
        $sets = [];
        foreach (array_keys($parameters) as $key) {
            $sets[] = $key . " = :" . $key;
        }
        $sql = sprintf(
            'UPDATE %s SET %s',
            $table,
            implode(', ', $sets)
        );
        if (sizeof($where) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function delete($table, $where)
    {
        $sql = 'DELETE FROM ' . $table;

        if (sizeof($where) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function query($query)
    {
        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

}