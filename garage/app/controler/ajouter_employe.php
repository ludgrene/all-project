<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un employé</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .container {
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 8px;
            margin-top: 40px; 
        }
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
    <div class="container">
        <h1 class="mb-3">Ajouter un nouvel employé</h1>
        <?php
        session_start();
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('location: formulaire.php');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

            // Connexion à la base de données
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=garage', 'ludgrene', '12345');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Préparation de la requête d'insertion
                $stmt = $bdd->prepare("INSERT INTO employe (email, password) VALUES (:email, :password)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                // Exécution de la requête
                $stmt->execute();

                echo '<div class="alert alert-success" role="alert">Employé ajouté avec succès!</div>';
            } catch(PDOException $e) {
                echo '<div class="alert alert-danger" role="alert">Erreur: ' . $e->getMessage() . '</div>';
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo '<div class="alert alert-warning" role="alert">Veuillez remplir tous les champs.</div>';
        }
        ?>
        <form action="ajouter_employe.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter Employé</button>
        </form>
    </div>
</body>
</html>
