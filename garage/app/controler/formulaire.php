<?php
session_start();
require_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbhost = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$dbuser = $_ENV["DB_USER"];
$dbpassword = $_ENV["DB_PASSWORD"];

try {
    $bdd = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit;
}

if (isset($_POST["valider"])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $mail_saisi = htmlspecialchars($_POST['email']);
        $pass_saisi = htmlspecialchars($_POST['password']);

        // admin
        $def_mail = "admin@gmail.com";
        $def_pass = "admin"; //  hashé de l'administrateur
            
        if ($mail_saisi === $def_mail && $pass_saisi === $def_pass) {
            $_SESSION['admin'] = true;
            header("Location: admin.php");
            exit;
        } else {
            // Vérification des employés
            $stmt = $bdd->prepare("SELECT * FROM employe WHERE email = :email");
            $stmt->execute([':email' => $mail_saisi]);
            $user = $stmt->fetch();

            if ($user && password_verify($pass_saisi, $user['password'])) { // Utilisation de password_verify pour une vérification sécurisée
                $_SESSION['admin'] = false;
                header("Location: espace_employe.php");
                exit;
            } else {
                $_SESSION['message'] = "<div id='error-message' class='alert alert-danger'>Mot de passe ou e-mail incorrect.</div>";
            }
        }
    } else {
        $_SESSION['message'] = "<div id='error-message' class='alert alert-warning'>Renseignez tous les champs.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage D.Segard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/form.css">
</head>
<body style="background-image: url(mur.jpg);" class="text-light">
    <div class="custom-background">
        <header class="container header bg-custom d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../../index.php" class="btn btn-outline-primary me-2 nav-link link-light">Accueil</a></li>
            </ul>
        </header>
    </div>
    <div class="container">
        <?php if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } ?>
        <form method="POST" action="" class="form-signin text-center">
            <h1 class="h3 mb-3 font-weight-normal text-primary">Veuillez vous connecter</h1>
            <input type="email" name="email" id="email" class="form-control" placeholder="Adresse Email" required autofocus>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de Passe" required>
            <button class="marge btn btn-lg btn-primary btn-block" type="submit" name="valider">Connexion</button>
        </form>
    </div>

  <script src="../script/form.js">


document.getElementById('monFormulaire').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêche le rechargement de la page
    const data = new FormData(this); // Prépare les données du formulaire pour l'envoi

    fetch('submit_form.php', { // Envoie les données du formulaire à un script PHP sans recharger la page
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Formulaire envoyé avec succès!');
        } else {
            alert('Erreur: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Erreur lors de l’envoi du formulaire:', error);
    });
});
  </script>
</body>
</html>
