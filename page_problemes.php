<?php
session_start();

// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radeec";

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $nom = $_POST['nomm'];
        $email = $_POST['emaill'];
        $cin = $_POST['cinn'];
        $type_probleme = $_POST['type_probleme'];
        $problematique = $_POST['problematique'];

        // Vérifiez si le CIN existe déjà
        $checkSql = 'SELECT COUNT(*) FROM problemes WHERE cin = :cin';
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindParam(':cin', $cin);
        $checkStmt->execute();
        
        
            // Préparation de la requête SQL
            $sql = 'INSERT INTO problemes (nom, email, cin, type_probleme, problematique) VALUES (:nom, :email, :cin, :type_probleme, :problematique)';
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':type_probleme', $type_probleme);
            $stmt->bindParam(':problematique', $problematique);

            // Exécution de la requête
            if ($stmt->execute()) {
                $_SESSION['message'] = "La Réclamation a été envoyée avec succès.";
                $_SESSION['message_class'] = 'success'; // Classe pour message de succès
            } else {
                $_SESSION['message'] = "Erreur lors de l'enregistrement des données.";
                $_SESSION['message_class'] = 'error'; // Classe pour message d'erreur
            }
        
        
        // Redirection vers la même page pour éviter la soumission multiple du formulaire
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="image_icon.jpeg" rel="icon"/>
    <link rel="stylesheet" href="style_problemes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Réclamation d'un Problème</title>
</head>
<body>
    <div class="b22">
        <br>
        <span><u><i class="fa-solid fa-message"></i>&nbsp;Réclamation d'un Problème!</u></span>
        <br>
        <?php
        // Vérification et affichage du message de session
        if (isset($_SESSION['message'])) {
            $message_class = isset($_SESSION['message_class']) ? $_SESSION['message_class'] : 'info';
            echo '<div class="message ' . $message_class . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']); // Effacer le message après affichage
            unset($_SESSION['message_class']); // Effacer la classe du message
        }
        ?>
        
        <hr>
        
        <div class="formulaire2">
            <form action="page_problemes.php" method="POST" enctype="multipart/form-data">
                <div class="nom2">
                    <i class="fa-solid fa-user"></i> &nbsp;
                    <label for="inp2">Nom & Prénom :</label><br>
                    <input type="text" id="inp2" name="nomm" placeholder="Entrez votre nom" required>
                </div>
                <br>
                <div class="email2">
                    <i class="fa-solid fa-envelope"></i>&nbsp;
                    <label for="inp3">Email :</label><br>
                    <input type="email" id="inp3" name="emaill" placeholder="Entrez votre email" required>
                </div>
                <br>
                <div class="cin2">
                    <i class="fa-solid fa-id-card"></i>&nbsp;
                    <label for="inp4">CIN :</label><br>
                    <input type="tel" id="inp4" name="cinn" placeholder="numéro de carte nationale" required>
                </div>
                <br>
                <div class="type">
                    <i class="fa-solid fa-exclamation-circle"></i>&nbsp;
                    <label for="inp5">Type Problème :</label><br>
                      <select name="type_probleme" required>
                        <option value="" disabled selected>Sélectionner Votre Problème</option>
                        <option value="Erreur Dans Les Factures">Erreur dans les factures</option>
                        <option value="Inexactitude Des Donnees">Inexactitude des données</option>
                        <option value="Retards De Paiement">Retards de paiement</option>
                        <option value="Mauvaise Gestion Des Creances">Mauvaise gestion des créances</option>
                        <option value="Insatisfaction Des Clients">Insatisfaction des clients</option>
                        <option value="Communication Inefficace">Communication inefficace</option>
                        <option value="Problemes Avec Les Systemes De Facturation">Problèmes avec les systèmes de facturation</option>
                        <option value="Difficultes D'acces Aux Donnees">Difficultés d'accès aux données</option>
                        <option value="Conformite Reglementaire">Conformité réglementaire</option>
                        <option value="Litiges Avec Les Clients">Litiges avec les clients</option>
                        <option value="Gestion Des Flux De Tresorerie">Gestion des flux de trésorerie</option>
                        <option value="Couts D'operation Eleves">Coûts d'opération élevés</option>
                        <option value="Inefficacite Des Processus">Inefficacité des processus</option>
                        <option value="Formation Du Personnel">Formation du personnel</option>
                        <option value="Protection Des Donnees">Protection des données</option>
                        <option value="Prevention De La Fraude">Prévention de la fraude</option>
                        <option value="Integration Des Systemes">Intégration des systèmes</option>
                        <option value="Adaptation Aux Nouvelles Technologies">Adaptation aux nouvelles technologies</option>
                        <option value="Autre">Autre ...</option>
                    </select>
                </div>
                <br>
                <div class="probleme">
                    <fieldset>
                        <legend>&nbsp;Problématique&nbsp;</legend>
                        <textarea id="inp6" name="problematique" class="problematique" placeholder="Écrivez votre problématique..." required></textarea>
                    </fieldset>
                </div>

                <hr id="fin">
                <br>
                <button class="btn" name="envoyerr" type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <h4 style=" text-align: center;">2024 © RADEEC Settat <br>
    Développé par <a href="https://www.facebook.com/profile.php?id=100089259122082&mibextid=LQQJ4d" style="text-decoration: none; color:blue;">Ayoub CHARRAFI</a>.</h4>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea.problematique');

            textareas.forEach(textarea => {
                function adjustHeight() {
                    textarea.style.height = 'auto'; // Réinitialiser la hauteur
                    textarea.style.height = textarea.scrollHeight + 'px'; // Ajuster à la hauteur du contenu
                }

                textarea.addEventListener('input', adjustHeight);
                adjustHeight();
            });
        });
    </script>
    
</body>
</html>
