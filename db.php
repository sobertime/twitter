<?php
try
{
   $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', 'root'); // connexion base de données
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
