<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .top-buttons {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="top-buttons">
        <a href="admin.php" class="btn btn-secondary btn-sm">Retour</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Déconnexion</a>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des employés</h1>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
               require_once('verifsesionadmin.php');

                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=garage', 'ludgrene', '12345', [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
                    $recup_membre = $bdd->prepare('SELECT * FROM employe');
                    $recup_membre->execute();

                    while ($membre = $recup_membre->fetch()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($membre['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($membre['email']) . '</td>';
                        echo '<td><a href="suppr.php?id=' . htmlspecialchars($membre['id']) . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet employé ?\');" class="btn btn-danger btn-sm">Supprimer</a></td>';
                        echo '</tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="3">Erreur: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
