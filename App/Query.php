<?php

namespace App;

class Query
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function get()
    {
        $stmt = $this->conn->prepare("SELECT * FROM registros");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getType($type)
    {
        $stmt = $this->conn->prepare("SELECT * FROM registros WHERE type = :_type");
        $stmt->bindValue(":_type", $type, \PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getDeleted($deleted)
    {
        $stmt = $this->conn->prepare("SELECT * FROM registros WHERE deleted = :_deleted");
        $stmt->bindValue(":_deleted", $deleted, \PDO::PARAM_BOOL);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getTypeAndDeleted($type, $deleted)
    {
        $stmt = $this->conn->prepare("SELECT * FROM registros WHERE deleted = :_deleted AND type = :_type");
        $stmt->bindValue(":_deleted", $deleted, \PDO::PARAM_BOOL);
        $stmt->bindValue(":_type", $type, \PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function insertRecords($data)
    {
        if (!isset($data['id']))
            return false;

        if (!isset($data['type']))
            return false;

        if (!isset($data['message']))
            return false;

        if (!isset($data['is_identified']))
            return false;

        if (!isset($data['whistleblower_name']))
            return false;   

        if (!isset($data['whistleblower_birth']))
            return false;

        $stmt = $this->conn->prepare("
            INSERT INTO registros (
                id, type, message, is_identified, whistleblower_name, whistleblower_birth, created_at, deleted
        ) values (:_id, :_type, :_message, :_ident, :_name, :_birth, date('now'), 0)"
        );

        $stmt->bindValue(":_id", $data['id'], \PDO::PARAM_INT);
        $stmt->bindValue(":_type", $data['type'], \PDO::PARAM_STR);
        $stmt->bindValue(":_message", $data['message'], \PDO::PARAM_STR);
        $stmt->bindValue(":_ident", $data['is_identified'], \PDO::PARAM_INT);
        $stmt->bindValue(":_name", $data['whistleblower_name'], \PDO::PARAM_STR);
        $stmt->bindValue(":_birth", $data['whistleblower_birth'], \PDO::PARAM_STR);

        return $stmt->execute();
    }
}
