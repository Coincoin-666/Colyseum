<?php
require "models/database.php";
require "models/clients.php";

$clientsObj = new Clients();
$allClientsArray = $clientsObj->getClients();