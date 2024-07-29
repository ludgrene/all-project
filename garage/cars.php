<?php
require_once('./templates/header.php');

function getDB() {
    $host = 'localhost';  // Votre host
    $dbname = 'garage';   // Nom de la base de données
    $username = 'ludgrene'; // Nom d'utilisateur de la base de données
    $password = '12345';     // Mot de passe de la base de données
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


require_once('./DB/class_voiture.php');




?>
<body class="brick">
<div class="container my-5 ">
    <h2 class="text-center mb-4 car-occasions-title text-light">NOS VOITURES D'OCCASIONS</h2>
    <div class="row">
        <!-- Example Car Card -->
        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/cadillac1.png" alt="cadillac" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">CADILLAC</h5>
                    <p class="car-price">43.890,00 €</p>
                    <a href="#" class="btn car-details-btn" data-bs-toggle="modal" data-bs-target="#carDetailsModal" data-car-id="2" onclick="loadCarDetails('2')">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/lexus1.png" alt="LEXUS" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">LEXUS</h5>
                    <p class="car-price">43.890,00 €</p>
                
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/hummer1.png" alt="HUMMER" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">HUMMER</h5>
                    <p class="car-price">43.890,00 €</p>
       
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/mercedes1.jpg" alt="mercedes" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">MERCEDES</h5>
                    <p class="car-price">43.890,00 €</p>
                    <a href="#" class="btn car-details-btn" data-bs-toggle="modal" data-bs-target="#carDetailsModal" data-car-id="4" onclick="loadCarDetails('4')">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/porsche1.png" alt="porsche" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">PORSCHE</h5>
                    <p class="car-price">43.890,00 €</p>
                    <a href="#" class="btn car-details-btn" data-bs-toggle="modal" data-bs-target="#carDetailsModal" data-car-id="5" onclick="loadCarDetails('5')">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="car-card">
                <img src="upload/cars/ferrari1.png" alt="ferrari" class="car-img-top">
                <div class="car-card-body">
                    <h5 class="car-card-title">FERRARI</h5>
                    <p class="car-price">43.890,00 €</p>
                    <a href="#" class="btn car-details-btn" data-bs-toggle="modal" data-bs-target="#carDetailsModal" data-car-id="6" onclick="loadCarDetails('6')">Détails</a>
                </div>
            </div>
        </div>
     
</div>


<div class="modal fade" id="carDetailsModal" tabindex="-1" aria-labelledby="carDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carDetailsModalLabel">Détails de la voiture</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Les détails de la voiture seront chargés ici -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<div class="contact-form-container">
    <h2>Contactez-nous</h2>
    <form id="contactForm">
        <div class="form-group">
            <label for="firstName">Prénom:</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        <div class="form-group">
            <label for="lastName">Nom:</label>
            <input type="text" id="lastName" name="lastName" required>
        </div>
        <div class="form-group">
            <label for="phone">Numéro de téléphone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Votre message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</div>
<?php
echo "hello"
?>

hello
<?php
require("templates/footer.php");
?>
<script>

document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    
    var formData = new FormData(this);

    // Envoi des données du formulaire
    fetch('submit_contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Traite la réponse en JSON
    .then(data => {
        if (data.success) {
            alert('Merci pour votre message, nous vous contacterons bientôt!');
            // Réinitialisation du formulaire après envoi réussi
            document.getElementById('contactForm').reset();
        } else {
            alert('Erreur lors de l’envoi du message: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Erreur lors de l’envoi du formulaire:', error);
        alert('Erreur lors de l’envoi du formulaire.');
    });
});

</script>
</body>