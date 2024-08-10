<?php
// Activer les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrer la session
session_start();

// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radeec";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['message'] = "La connexion a échoué : " . htmlspecialchars($e->getMessage());
    $_SESSION['message_type'] = 'error';
    header("Location: page_demandes.php");
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $datee = htmlspecialchars($_POST['datee']);
    $adress = htmlspecialchars($_POST['adress']);
    $cin = htmlspecialchars($_POST['cin']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $genre = htmlspecialchars($_POST['genre']);
    $ville = htmlspecialchars($_POST['ville']);
    $niveau = htmlspecialchars($_POST['niveau']);

    // Vérifiez si le CIN existe déjà
    $checkSql = "SELECT COUNT(*) FROM demandes WHERE cin = :cin";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':cin', $cin);
    $checkStmt->execute();

    if ($checkStmt->fetchColumn() > 0) {
        $_SESSION['message'] = "Une demande avec ce CIN existe déjà.";
        $_SESSION['message_type'] = 'error';
        header("Location: page_demandes.php");
        exit;
    } else {
        // Créez le répertoire "uploads" s'il n'existe pas
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Gestion des fichiers
        $cvPath = '';
        $lettrePath = '';

        if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
            $cvName = basename($_FILES['cv']['name']);
            $cvTmpName = $_FILES['cv']['tmp_name'];
            $cvPath = $uploadDir . $cvName;
            if (!move_uploaded_file($cvTmpName, $cvPath)) {
                $_SESSION['message'] = "Erreur lors du téléchargement du fichier CV.";
                $_SESSION['message_type'] = 'error';
                header("Location: page_demandes.php");
                exit;
            }
        }

        if (isset($_FILES['lettre']) && $_FILES['lettre']['error'] == UPLOAD_ERR_OK) {
            $lettreName = basename($_FILES['lettre']['name']);
            $lettreTmpName = $_FILES['lettre']['tmp_name'];
            $lettrePath = $uploadDir . $lettreName;
            if (!move_uploaded_file($lettreTmpName, $lettrePath)) {
                $_SESSION['message'] = "Erreur lors du téléchargement du fichier Lettre de motivation.";
                $_SESSION['message_type'] = 'error';
                header("Location: page_demandes.php");
                exit;
            }
        }

        // Insertion des données dans la base de données
        $sql = "INSERT INTO demandes (nom, prenom, datee, adress, cin, telephone, email, genre, ville, niveau, cv, lettre) 
                VALUES (:nom, :prenom, :datee, :adress, :cin, :telephone, :email, :genre, :ville, :niveau, :cv, :lettre)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':datee', $datee);
            $stmt->bindParam(':adress', $adress);
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':niveau', $niveau);
            $stmt->bindParam(':cv', $cvPath);
            $stmt->bindParam(':lettre', $lettrePath);

            $stmt->execute();
            $_SESSION['message'] = "La demande a été envoyée avec succès.";
            $_SESSION['message_type'] = 'success';
            header("Location: page_demandes.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['message'] = "Erreur lors de l'enregistrement des données : " . htmlspecialchars($e->getMessage());
            $_SESSION['message_type'] = 'error';
            header("Location: page_demandes.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="image_icon.jpeg" rel="icon"/>
    <title>Candidature Spontanée</title>
    <link rel="stylesheet" href="demandes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="b22">
        <span><i class="fa-solid fa-user-tie"></i>&nbsp;Candidature Spontanée</span>
        <hr>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo isset($_SESSION['message_type']) ? htmlspecialchars($_SESSION['message_type']) : 'success'; ?>">
                <?php echo $_SESSION['message']; 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']); ?>
            </div>
            <hr>
        <?php endif; ?>
        <form id="jobForm" action="page_demandes.php" method="POST" enctype="multipart/form-data">
           
            <div class="form-group">
                <label for="nom"><i class="fa-solid fa-user"></i>&nbsp; Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
            </div>
            
            <div class="form-group">
                <label for="prenom"><i class="fa-solid fa-user"></i>&nbsp; Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
            </div>
            <div class="form-group">
                <label for="datee"><i class="fa-solid fa-calendar-days"></i>&nbsp; Date de naissance :</label>
                <input type="date" id="datee" name="datee" required>
            </div>
            <div class="form-group">
                <label for="adress"><i class="fa-solid fa-location-dot"></i>&nbsp; Adresse :</label>
                <input type="text" id="adress" name="adress" placeholder="Entrez votre adresse" required>
            </div>
            <div class="form-group">
                <label for="cin"><i class="fa-solid fa-id-card"></i>&nbsp; CIN :</label>
                <input type="text" id="cin" name="cin" placeholder="Entrez votre numéro de carte nationale" required>
            </div>
            <div class="form-group">
                <label for="telephone"><i class="fa-solid fa-phone"></i>&nbsp; Téléphone :</label>
                <input type="text" id="telephone" name="telephone" placeholder="Entrez votre numéro de téléphone" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i>&nbsp; Email :</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
            </div>
            <div class="form-group">
                <label><i class="fa-solid fa-mars"></i>&nbsp; Genre :</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" id="male" name="genre" value="male" required> Homme &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="female" name="genre" value="female" required> Femme
            </div>
            <div class="form-group">
                <label for="ville"><i class="fa-solid fa-city"></i>&nbsp; Ville :</label>
                <select id="ville" name="ville" required>
                <option value="" disabled selected>Sélectionner votre ville</option>
  <option value="Casablanca">Casablanca</option>
  <option value="Rabat">Rabat</option>
  <option value="Marrakech">Marrakech</option>
  <option value="Fes">Fès</option>
  <option value="Tanger">Tanger</option>
  <option value="Agadir">Agadir</option>
  <option value="Oujda">Oujda</option>
  <option value="Temara">Témara</option>
  <option value="Kenitra">Kénitra</option>
  <option value="Mohammedia">Mohammedia</option>
  <option value="Tetouan">Tétouan</option>
  <option value="Eljadida">El Jadida</option>
  <option value="Beni mellal">Beni Mellal</option>
  <option value="Khemisset">Khemisset</option>
  <option value="Nador">Nador</option>
  <option value="Safi">Safi</option>
  <option value="Kalaat sraghna">Kalaat Sraghna</option>
  <option value="Larache">Larache</option>
  <option value="Bouznika">Bouznika</option>
  <option value="El hoceima">El Hoceïma</option>
  <option value="Oualidia">Oualidia</option>
  <option value="Chefchaouen">Chefchaouen</option>
  <option value="Errachidia">Errachidia</option>
  <option value="Iho">Iho</option>
  <option value="Moulay idriss">Moulay Idriss</option>
  <option value="Skhirat">Skhirat</option>
  <option value="Sidi ifni">Sidi Ifni</option>
  <option value="Merzouga">Merzouga</option>
  <option value="Bouarfa">Bouarfa</option>
  <option value="Oued zem">Oued Zem</option>
  <option value="Sidi kacem">Sidi Kacem</option>
  <option value="Berrechid">Berrechid</option>
  <option value="Khouribga">Khouribga</option>
  <option value="Fkih ben saleh">Fkih Ben Salah</option>
  <option value="Sale">Salé</option>
  <option value="Azrou">Azrou</option>
  <option value="Settat">Settat</option>
  <option value="Taza">Taza</option>
  <option value="Tiznit">Tiznit</option>
  <option value="Souk-el-arba">Souk-el-Arba</option>
  <option value="Jbel sahro">Jbel Sahro</option>
  <option value="Khemisset">Khemisset</option>
  <option value="Rissani">Rissani</option>
  <option value="Ouled teima">Ouled Teima</option>
  <option value="Tiznit">Tiznit</option>
  <option value="Merja zerga">Merja Zerga</option>
  <option value="Oujda">Oujda</option>
  <option value="Tamesna">Tamesna</option>
  <option value="Khmissat">Khmissat</option>
  <option value="Hassan">Hassan</option>
  <option value="Assilah">Asilah</option>
  <option value="Tafraoute">Tafraoute</option>
  <option value="Dakhla">Dakhla</option>
  <option value="Laayoune">Laayoune</option>
  <option value="Smara">Smara</option>
  <option value="Jebel ouahch">Jebel Ouhch</option>
  <option value="Tarfaya">Tarfaya</option>
  <option value="Tantan">Tantan</option>
  <option value="Guelmim">Guelmim</option>
  <option value="Ouled frej">Ouled Frej</option>
  <option value="Agdz">Agdz</option>
  <option value="Rabat">Rabat</option>
  <option value="Sidi slimane">Sidi Slimane</option>
  <option value="Taza">Taza</option>
  <option value="El hoceima">Al Hoceima</option>
  <option value="Tiznit">Tiznit</option>
  <option value="Oujda">Oujda</option>
  <option value="Sidi ifni">Sidi Ifni</option>
  <option value="Touama">Touama</option>
  <option value="Meknes">Meknès</option>
  <option value="Oued laou">Oued Laou</option>
  <option value="Kelaat mgouna">Kelaat Mgouna</option>
  <option value="Midelt">Midelt</option>
  <option value="Azilal">Azilal</option>
  <option value="Ichaoua">Ichaoua</option>
  <option value="Boulemane">Boulemane</option>
  <option value="Taounate">Taounate</option>
  <option value="Autre">Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label for="niveau"><i class="fa-solid fa-graduation-cap"></i>&nbsp; Niveau d'étude :</label>
                <select id="niveau" name="niveau" required>
                <option value="" disabled selected>Sélectionner votre niveau</option>
                <option value="Niveau Baccalauréat">Niveau Baccalauréat</option>
                <option value="Baccalauréat">Baccalauréat</option>
                <option value="Baccalauréat + 1 ans">Baccalauréat + 1 ans</option>
                <option value="Baccalauréat + 2 ans">Baccalauréat + 2 ans</option>
                <option value="Baccalauréat + 3 ans">Baccalauréat + 3 ans</option>
                <option value="Baccalauréat + 4 ans">Baccalauréat + 4 ans</option>
                <option value="Baccalauréat + 5 ans">Baccalauréat + 5 ans</option>
                <option value="Baccalauréat + 6 ans">Baccalauréat + 6 ans</option>
                <option value="Baccalauréat + 7 ans">Baccalauréat + 7 ans</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lettre"><i class="fa-solid fa-file-lines"></i>&nbsp; Choisir Lettre de Motivation :</label>
                <input type="file" id="lettre" name="lettre" accept=".jpg, .jpeg, .png, .pdf" required>
            </div>
            <div class="form-group">
                <label for="cv"><i class="fa-solid fa-file-lines"></i>&nbsp; Choisir votre CV :</label>
                <input type="file" id="cv" name="cv" accept=".jpg, .jpeg, .png, .pdf" required>
            </div>
            <hr>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn">Envoyer</button>
        </form>
       
    </div>
      <hr>
      <h4 style=" text-align: center;">2024 © RADEEC Settat <br>
      Développé par <a href="https://www.facebook.com/profile.php?id=100089259122082&mibextid=LQQJ4d" style="text-decoration: none; color:blue;">Ayoub CHARRAFI</a>.</h4>
        </body>
</html>
