<?php

namespace DB;

class DBAccess {

    private const HOST_DB = "localhost";
    private const USERNAME = "mvignaga";
    private const PASSWORD = "ohthohXie5aichah";
    private const DATABASE_NAME = "mvignaga";

    private $connection;

    public function openDBConnection() {
        $this->connection = mysqli_connect(
            DBAccess::HOST_DB,
            DBAccess::USERNAME,
            DBAccess::PASSWORD,
            DBAccess::DATABASE_NAME
        );
        if ($this->connection)
            mysqli_query($this->connection, "SET lc_time_names = 'it_IT'");
        return $this->connection;
    }

    private function query($query) {
        $queryResult = mysqli_query($this->connection, $query);
        $result = array();
        while ($row = mysqli_fetch_assoc($queryResult)) {
            $result[] = $row;
        }
        return $result;
    }

    public function closeDBConnection() {
            if ($this->connection)
                mysqli_close($this->connection);
    }

    public function getLogin($user, $pass)
    {
        $Username = mysqli_real_escape_string($this->connection, $user);
        $Password = md5(mysqli_real_escape_string($this->connection, $pass));
        $sql = "SELECT *
            FROM `UTENTE`
            WHERE BINARY `username` = '$Username' AND `password` = '$Password'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            return array(
                "isValid" => true,
                "user" => $user["username"],
                "isAdmin" => $user["administrator"]
            );
        }
        return array(
            "isValid" => false,
            "user" => null,
            "isAdmin" => false
        );
        return $this->query($query);
    }

    public function newAccount($user, $pass)
    {
        $Username = mysqli_real_escape_string($this->connection, $user);
        $Password = md5(mysqli_real_escape_string($this->connection, $pass));
        $sql = sprintf("SELECT *
            FROM UTENTE
            WHERE username='$Username'");

        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) == 0) {
            //Nessun utente trovato con quel username o email, quindi creazione disponibile
            $sql = sprintf("INSERT INTO `UTENTE` (`username`, `password`)
        VALUES ('$Username', '$Password')");
            $result = mysqli_query($this->connection, $sql);

            return ($result == true);
            //ritorna true SSE l'utente è stato creato
        }
        else
        {
            return false;
        }
    }

    public function deleteAccount($user) {
        $Username = mysqli_real_escape_string($this->connection, $user);
        $query = "DELETE FROM UTENTE WHERE username = '$Username'";
        $result = mysqli_query($this->connection, $query);
        return ($result == true);
    }
}

?>