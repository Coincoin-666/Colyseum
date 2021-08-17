<!-- Exercices PDO
Gestion de l'affichage d'une base de données sql en php. -->
<?php
// Définition de variables pour stocker les éléments de connexion à la base de données
$dbname = 'colyseum';
$username = 'root';
$password = 'root';

// Création d'un objet 'basededonnées' via new PDO, qui nous permettra de le manipuler en php.
// Les "" au lieu des '' permet de gérer la variable sans concaténation.
$bdd = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", $username, $password);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Colyseum</title>
</head>

<body>
    <h1>Colyseum</h1>
    <h2>Ave Caesar, morituri te salutant.</h2>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <table class="table">
                    <caption>Exo1 – Nom et Prénom des utilisateurs</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Accès à toutes les données via php
                        $first_query = $bdd->query('SELECT * FROM `clients`');
                        // Récupération des données, fetchAll() nous permet de récupérer toutes les lignes du tableau.
                        $result = $first_query->fetchAll();
                        foreach ($result as $client) {
                        ?>
                            <tr>
                                <td><?= $client['lastName'] ?></td>
                                <td><?= $client['firstName'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-primary">
                    <caption>Exo2 – Type de spectacles proposés</caption>
                    <thead>
                        <tr>
                            <th scope="col">Spectacles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupération des genres de spectacles
                        $spectacles_query = $bdd->query('SELECT `type` FROM `showTypes`');
                        $showTypes = $spectacles_query->fetchAll();
                        foreach ($showTypes as $type) {
                        ?>
                            <tr>
                                <td><?= $type['type'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-info">
                    <caption>Exo3 – Liste des 20 premiers utilisateurs</caption>
                    <thead>
                        <tr>
                            <th scope="col">1-20 Nom</th>
                            <th scope="col">1-20 Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupération des 20 premiers utilisateurs
                        $onetotwenty = "SELECT * FROM clients ORDER BY lastName LIMIT 20";
                        $result = $bdd->query($onetotwenty)->fetchAll();
                        foreach ($result as $sortedUsers) {
                        ?>
                            <tr>
                                <td><?= $sortedUsers['lastName'] ?></td>
                                <td><?= $sortedUsers['firstName'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-success">
                    <caption>Exo4 – Clients ayant une carte de fidélité</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Numéro de Carte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Accès aux données
                        // On sélectionne les données de la table 'clients', que l'on joint à la table 'cards' sur la colonne 'cardNumber' quand l'id vaut 1.
                        $clientCard = "SELECT * FROM `clients` INNER JOIN `cards` ON clients.cardNumber = cards.cardNumber WHERE cardTypesId = 1";
                        // Récupération des données dans une variable:
                        $result = $bdd->query($clientCard)->fetchAll();
                        foreach ($result as $card) {
                        ?>
                            <tr>
                                <td><?= $card['lastName'] ?></td>
                                <td><?= $card['firstName'] ?></td>
                                <td><?= $card['cardNumber'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-warning">
                    <caption>Exo5 – Clients dont le nom commence par la lettre M</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Accès aux données
                        // On sélectionne les données de la table 'clients' et de la colonne 'lastName' où le nom "ressemble à" M
                        $clients_M = "SELECT * FROM `clients` WHERE `lastName` LIKE 'M%'";
                        // Récupération des données dans une variable:
                        $result = $bdd->query($clients_M)->fetchAll();
                        foreach ($result as $client) {
                        ?>
                            <tr>
                                <td><?= $client['lastName'] ?></td>
                                <td><?= $client['firstName'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-danger">
                    <caption>Exo6 – Spectacles proposés</caption>
                    <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Artiste</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Accès aux données
                        // On sélectionne les données de la table 'clients' et de la colonne 'lastName' où le nom "ressemble à" M
                        $shows = "SELECT `title`, `performer`, DATE_FORMAT(`date`, '%d.%m.%Y') as date, TIME_FORMAT(`startTime`, '%H.%i') as startTime FROM `shows` ORDER BY `title`";
                        // Récupération des données dans une variable:
                        $result = $bdd->query($shows)->fetchAll();
                        foreach ($result as $show) {
                        ?>
                            <tr>
                                <td><?= $show['title'] ?></td>
                                <td><?= $show['performer'] ?></td>
                                <td><?= $show['date'] ?></td>
                                <td><?= $show['startTime'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
        <table class="table table-dark">
                    <caption>Exo7 – Nom, Prénom, Date de naissance, et carte de fidélité des clients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Carte de Fidélité</th>
                            <th scope="col">N° de Carte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Accès aux données
                        // On sélectionne les données de la table 'clients' et des colonnes qui nous intéresse
                        $faithfull_clients = "SELECT `firstName`, `lastName`, DATE_FORMAT(`birthDate`, '%d.%m.%Y') as birthDate, `card`, `cardNumber` FROM `clients`;";
                        // Récupération des données dans une variable:
                        $result = $bdd->query($faithfull_clients)->fetchAll();
                        foreach ($result as $faithfull_client) {
                        ?>
                            <tr>
                                <td><?= $faithfull_client['firstName'] ?></td>
                                <td><?= $faithfull_client['lastName'] ?></td>
                                <td><?= $faithfull_client['birthDate'] ?></td>
                                <td><?= ($faithfull_client['card'] != 0) ? "oui" : "non" ?></td>
                                <td><?= ($faithfull_client['card'] != 0) ? $faithfull_client['cardNumber'] : "" ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>