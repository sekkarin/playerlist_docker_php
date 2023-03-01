<?php



class PlayerModel
{
    private string $host = '';
    private string $user = '';
    private string $pass = '';
    private string $db = '';
    private $condb;
    // private string $condb = '';
    function __construct(object $conf)
    {
        $this->host = $conf->host;
        $this->user = $conf->user;
        $this->pass = $conf->pass;
        $this->db = $conf->db;
        // $this->checkAndInserter();
        // $this->getAllPlayer();
    }
    public function checkAndInserter(): void
    {
        $this->connect();
        $sql = "SELECT 1 FROM football_player LIMIT 1";
        try {
            $this->condb->exec($sql);
        } catch (PDOException $e) {
            $sql = "CREATE TABLE football_player (
                identifier INT(6) UNSIGNED  PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                team VARCHAR(50)  NOT NULL,
                position VARCHAR(50)  NOT NULL, 
                image_url VARCHAR(250)  NOT NULL );";
            $this->condb->exec($sql);
            $json = json_decode(file_get_contents(__DIR__ . '/playerlist.json'));
            for ($i = 0; $i < count($json); $i++) {
                $_sql = "";
                $identifier = $json[$i]->identifier;
                $first_name = $json[$i]->first_name;
                $last_name = $json[$i]->last_name;
                $team = $json[$i]->team;
                $position = $json[$i]->position;
                $image = $json[$i]->image;
                $_sql = "INSERT INTO `football_player` (`identifier`, `firstname`, `lastname`, `team`, `position`, `image_url`) VALUES( ?,?,?,?,?,? );";
                $query = $this->condb->prepare($_sql);
                $query->execute([$identifier, $first_name, $last_name, $team, $position, $image]);

            }

        }
    }
    public function connect(): void
    {
        try {
            $this->condb = new PDO("mysql:host=$this->host;dbname=$this->db;", $this->user, $this->pass);
            // set the PDO error mode to exception
            $this->condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function close_db()
    {
        $this->condb = null;
    }
    public function inserPlayer($dataArray): bool
    {
        try {
            // INSERT INTO `football_player` (`identifier`, `firstname`, `lastname`, `team`, `position`, `image_url`) VALUES (1, 'ken', 'singhayoo', 'หนองตากใบ', 'เก็บบอล', 'none');
            $this->connect();
            $sql = " INSERT INTO `football_player` (`identifier`, `firstname`, `lastname`, `team`, `position`, `image_url`)";
            $sql .= " VALUES (null, :firstname, :lastname, :team,:position , :image_url);";
            $query = $this->condb->prepare($sql);
            if ($query->execute($dataArray)) {

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
        // return true;
    }
    public function updatePlayer($dataArray)
    {
        // UPDATE `football_player` SET `firstname` = 'Aleksandar update' WHERE `football_player`.`identifier` = 1008;
        // UPDATE `football_player` SET `firstname` = 'Aleksandar .', `lastname` = 'Kolarov .', `team` = 'Manchester City .', `position` = 'Defender .', `image_url` = 'aleksandarkolarov.jpg ' WHERE `football_player`.`identifier` = 1008;
        $this->connect();
        $sql = "UPDATE `football_player` SET 
        `firstname` = :firstname,
        `lastname` = :lastname,
        `team` = :team,
        `position` = :position,
        `image_url` = :image_url";
        $sql .= " WHERE `football_player`.`identifier` = :identifier";

        $query = $this->condb->prepare($sql);
        if ($query->execute($dataArray)) {
            return true;
        } else {
            $this->close_db();
            return false;
        }
    }
    public function deletePlayer($identifier): bool
    {
        // DELETE FROM football_player WHERE `football_player`.`identifier` = 2312
        $this->connect();
        $sql = "DELETE FROM football_player WHERE `football_player`.`identifier` = " . $identifier . " ;";
        $query = $this->condb->prepare($sql);
        if ($query->execute()) {
            return true;
        } else {
            $this->close_db();
            return false;
        }
    }
    public function getPlayer($identifier)
    {
        $this->connect();
        $sql = "SELECT * FROM `football_player` WHERE `identifier` = " . $identifier;
        $query = $this->condb->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return json_encode($result);
            
        } else {
            $this->close_db();
            return false;
        }
    }
    public function getAllPlayer()
    {
        $this->connect();
        $sql = "SELECT * FROM `football_player` ORDER BY `football_player`.`identifier` DESC";
        $query = $this->condb->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // return $result;
            return json_encode($result);
        } else {
            $this->close_db();
            return false;
        }
    }
}

?>