<?php
// Vérifier si l'utilisateur est authentifié en tant qu'admin
 session_start();
 if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
     header('location: formulaire.php');
     exit();
 }