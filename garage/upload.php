<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["imageVoiture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["imageVoiture"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["imageVoiture"]["tmp_name"], $target_file)) {
            $voitureId = $_POST['voitureId'];

            $bdd = new PDO('mysql:host=localhost;dbname=garage', 'ludgrene', '12345');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE voitures SET image = :image WHERE id = :voitureId";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':image', $target_file);
            $stmt->bindParam(':voitureId', $voitureId, PDO::PARAM_INT);
            $stmt->execute();

            echo "L'image a été téléchargée et enregistrée avec succès.";
            header('Location: tabvoi.php'); 
            exit;

        } else {
            echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Le fichier n'est pas une image.";
    }
} else {
    echo "Aucun fichier soumis.";
}


?>