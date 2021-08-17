<?php
/**
 * Création d'une classe clients contenant toutes les infos des utilisateurs
 * Sert principalement à la création d'une fonction pour afficher les données
 */
class Clients extends Database {
    public function getClients() {
        // Connexion à la bdd
        $database = $this->connectDatabase();
        // Requête demandant les données clients
        $_query = "SELECT * FROM `clients`";
        // Récupération des données
        $clientsQuery = $database->query($_query);
        // Stockage dans une variable
        $fetch = $clientsQuery->fetchAll();
        return $fetch;

    }
}