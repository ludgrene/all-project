<?php

require_once("verifsesionadmin.php");

$host = 'localhost'; // Hostname de la base de données
$dbname = 'garage'; // Nom de la base de données
$username = 'ludgrene'; // Nom d'utilisateur de la base de données
$password = '12345'; // Mot de passe de la base de données

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}

// Récupération des horaires actuels
$sql = "SELECT * FROM horaires_ouverture";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$horaires = $stmt->fetchAll();

// Mise à jour des horaires si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    foreach ($_POST['jours'] as $jour => $data) {
        $sql = "UPDATE horaires_ouverture SET 
            heure_ouverture = :heure_ouverture,
            heure_fermeture_matin = :heure_fermeture_matin,
            heure_ouverture_apresmidi = :heure_ouverture_apresmidi,
            heure_fermeture = :heure_fermeture
            WHERE jour = :jour";
        
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ':heure_ouverture' => $data['heure_ouverture'],
            ':heure_fermeture_matin' => $data['heure_fermeture_matin'],
            ':heure_ouverture_apresmidi' => $data['heure_ouverture_apresmidi'],
            ':heure_fermeture' => $data['heure_fermeture'],
            ':jour' => $jour
        ]);
    }
    header("Location: horaires.php"); // Recharger la page pour voir les modifications
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Horaires d'Ouverture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .top-buttons {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
    <div class="top-buttons">
        <a href="admin.php" class="btn btn-secondary btn-sm">Retour</a> 
        <a href="logout.php" class="btn btn-danger btn-sm">Déconnexion</a>
    </div>
    <div class="container mt-5">
        <h2>Modifier les Horaires d'Ouverture</h2>
        <form method="post">
            <?php foreach ($horaires as $horaire): ?>
                <div class="mb-3">
                    <label class="form-label"><?php echo $horaire['jour']; ?></label>
                    <input type="time" class="form-control" name="jours[<?php echo $horaire['jour']; ?>][heure_ouverture]" value="<?php echo $horaire['heure_ouverture']; ?>">
                    <input type="time" class="form-control" name="jours[<?php echo $horaire['jour']; ?>][heure_fermeture_matin]" value="<?php echo $horaire['heure_fermeture_matin']; ?>">
                    <input type="time" class="form-control" name="jours[<?php echo $horaire['jour']; ?>][heure_ouverture_apresmidi]" value="<?php echo $horaire['heure_ouverture_apresmidi']; ?>">
                    <input type="time" class="form-control" name="jours[<?php echo $horaire['jour']; ?>][heure_fermeture]" value="<?php echo $horaire['heure_fermeture']; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
