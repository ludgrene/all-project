<?php

require_once('./DB/class_voiture.php');

function getDB() {
    $host = 'localhost';
    $dbname = 'garage';
    $username = 'ludgrene';
    $password = '12345';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
        return $bdd;
    } catch (PDOException $e) {
        exit('Erreur de connexion : ' . $e->getMessage());
    }
}

$bdd = getDB();

// Requête pour récupérer les données des voitures
$sql = "SELECT id, nom, modele, kilometrage, annee, boite_de_vitesses, couleur, energie, porte, prix, image FROM voitures";
$stmt = $bdd->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-title {
            color: #007bff; 
        }
        .card-text {
            font-size: 0.9em;
            color: #666; 
        }
        .prix {
            font-weight: bold;
            color: #28a745; 
        }

        .card-img-top {
    width: 100%; /* ou la largeur que tu préfères */
    height: auto; /* maintient le ratio de l'image */
    object-fit: cover; /* couvre l'espace dédié sans déformer l'image */
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if ($stmt && $stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch()): ?>
                <div class="card mb-4 shadow-sm"> 
                    <div class="card-header bg-primary text-white">
                        <h4 class="my-0 fw-normal"><?= htmlspecialchars($row['nom']) ?> <?= htmlspecialchars($row['modele']) ?></h4>
                    </div>
                    <!-- Affichage de l'image téléchargée (assure-toi que le chemin est correct) -->
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="Image de <?= htmlspecialchars($row['nom']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Kilométrage: <?= htmlspecialchars($row['kilometrage']) ?> km</li>
                            <li>Année: <?= htmlspecialchars($row['annee']) ?></li>
                            <li>Boîte de vitesse: <?= htmlspecialchars($row['boite_de_vitesses']) ?></li>
                            <li>Couleur: <?= htmlspecialchars($row['couleur']) ?></li>
                            <li>Énergie: <?= htmlspecialchars($row['energie']) ?></li>
                            <li>Nombre de portes: <?= htmlspecialchars($row['porte']) ?></li>
                            <li class="prix">Prix: <?= htmlspecialchars(number_format($row['prix'], 2, ',', ' ')) ?> €</li>
                        </ul>
                        <!-- Formulaire pour télécharger une image pour la voiture -->
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Sélectionnez une image pour cette voiture :
                            <input type="file" name="imageVoiture" id="imageVoiture_<?= $row['id'] ?>" class="form-control">
                            <input type="hidden" name="voitureId" value="<?= htmlspecialchars($row['id']) ?>">
                            <button type="submit" name="submit" class="btn btn-primary mt-2">Télécharger l'image</button>
                        </form>
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary mt-2">Voir plus</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">Aucune voiture trouvée.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

