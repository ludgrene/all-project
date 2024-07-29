<?php
require_once('verifsesionadmin.php');

$bdd = new PDO('mysql:host=localhost;dbname=garage', 'ludgrene', '12345', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
]);

// Vérifier si un ID est passé et n'est pas vide
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $idget = trim($_GET['id']); // Récupère et nettoie l'ID passé via GET

    // Préparer la requête pour vérifier si l'employé existe
    $recup_membre = $bdd->prepare('SELECT * FROM employe WHERE id = :id');
    $recup_membre->execute([':id' => $idget]); // Exécute la requête avec l'ID en utilisant le binding pour prévenir les injections SQL

    if ($recup_membre->rowCount() > 0) {
        // Si l'employé existe, préparer et exécuter la requête de suppression
        $supprUser = $bdd->prepare('DELETE FROM employe WHERE id = :id');
        $supprUser->execute([':id' => $idget]); // Utiliser le binding pour prévenir les injections SQL

        header('Location: membre.php'); // Redirection sécurisée après la suppression
        exit();
    } else {
        echo "Aucun employé n'a été trouvé."; // Message si aucun employé correspondant
    }
} else {
    echo "ID non récupéré"; // Message si l'ID n'est pas passé
}
?>
