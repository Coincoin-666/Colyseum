<?php
/**
 * Création d'une classe générale 'database' permettant la connexion à la base de données.
 * 
 * @var string $dbname
 * @var string $username
 * @var varchar $password
 */
class Database {
    private $dbname = 'colyseum';
    private $username = 'root';
    private $password = 'root';

    // Création d'une fct de connexion
    protected function connectDatabase() {
        // On essaye de se connecter à la base de données,
       try {
           $database = new PDO("mysql:host=localhost;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
           return $database;
           // et si ça marche pas on affiche un message d'erreur.
       } catch(PDOException $error) {
           die('error: ' . $error->getMessage());
       }
    }
}