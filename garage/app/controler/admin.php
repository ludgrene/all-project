<?php

session_start();
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: error_page.php');
    exit();
}

try {
    
    $bdd = new PDO('mysql:host=localhost;dbname=garage', 'ludgrene', '12345', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Vous pourriez effectuer d'autres opérations ici, comme récupérer des données.

} catch (Exception $e) {
    error_log($e->getMessage());
    header('Location: error_page.php'); // Dirige vers une page d'erreur générique
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Garage D.Segard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../../assets/image/logo.jpg');
            background-size: cover;
        }

        
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="logout.php">deconnection</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="offcanvasNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="membre.php">surrimer employer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="ajouter_employe.php">ajouter employe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../controller/horaires.php">HORAIRES ET JOUR </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="autreAd.php">service/annonce/avis</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>