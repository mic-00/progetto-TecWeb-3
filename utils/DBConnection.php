<?php

namespace DB;

class DBConnection {

    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
        if ($this->connection)
            mysqli_query($this->connection, "SET lc_time_names = 'it_IT'");
    }

    public function __destruct() {
        if ($this->connection)
            mysqli_close($this->connection);
    }

    public function query($template, ...$args) {
        $stmt = mysqli_prepare($this->connection, $template);
        $types = str_repeat("s", count($args));
        $stmt->bind_param($types, ...$args);
        $stmt->execute();
        $result = $stmt->get_result();
        if (gettype($result) === "object") {
            $resultSet = [];
            while ($row = $result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            return $resultSet;
        }
        return $result;
    }
}

?>