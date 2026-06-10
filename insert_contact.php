<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";


// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si formulaire envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Requête préparée (sécurisée)
    $stmt = $conn->prepare("INSERT INTO contact (nom, prenom, email, telephone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $telephone);

    if ($stmt->execute()) {
        echo "<script>
                alert('Message envoyé avec succès !');
                window.location.href='contact.html';
              </script>";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
