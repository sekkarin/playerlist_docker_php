<?php
// echo "class";s
// include_once('../data/playerlist.json');
class PlayerModel
{
    private string $host = '';
    private string $user = '';
    private string $pass = '';
    private string $db = '';
    function __construct(object $conf)
    {
        $this->host = $conf->host;
        $this->user = $conf->user;
        $this->pass = $conf->pass;
        $this->db = $conf->db;
        $this->checkAndInserter();
    }
    private function checkAndInserter(): void
    {
        $this->onConNect();
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
    public function onConNect(): void
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
    public function inserPlayer($obj): bool
    {
        try {
            $this->onConNect();
            $sql = "INSERT INTO MyGuests (firstname, lastname, email)
            VALUES ('John', 'Doe', 'john@example.com')";
            // use exec() because no results are returned
            // $condb->exec($sql);
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
        // return true;
    }
    public function updatePlayer($obj): bool
    {
        return true;
    }
    public function deletePlayer($id): bool
    {
        return true;
    }
    public function getPlayer($id): array
    {
        return [];
    }
}

?>