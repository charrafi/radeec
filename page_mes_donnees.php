<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="image_icon.jpeg" rel="icon"/>
    <title>Recu Demande </title>
    <style>
        @media print {
            body * {
                display: none;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print button {
                display: none;
            }
            #section-to-print {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 210mm;
                height: 297mm;
                padding: 20mm;
                box-sizing: border-box; /* Assure que padding et border sont inclus dans la largeur/hauteur totale */
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #e0eaff, #b3c6f1);
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            font-size: 2em;
            font-weight: 700;
            color: #003366;
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
            text-align: center;
        }

        .details p {
            margin: 0;
            padding: 5px 0;
        }

        .details strong {
            color: #003366;
        }

        .error-message {
            color: #ff0000;
            font-size: 1.2em;
            text-align: center;
            margin-top: 20px;
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: #666;
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            font-size: 1em;
            color: #ffffff;
            background-color: #003366;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #002244;
        }

        .b24 {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .b24 label {
            font-size: 1.1em;
            color: #003366;
            display: block;
            margin-bottom: 5px;
        }

        .b24 input[type="text"],
        .b24 input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .b24 input[type="submit"] {
            background-color: #003366;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            display: block;
            margin: 20px auto;
        }

        .b24 input[type="submit"]:hover {
            background-color: #002244;
        }

        .hidden {
            display: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function printPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');

            // إخفاء الزر قبل التحويل
            document.getElementById('download-btn').style.display = 'none';

            html2canvas(document.querySelector('#section-to-print'), { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210;
                const pageHeight = 297;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position -= pageHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('Recu Demande.pdf');

                // إعادة إظهار الزر بعد تنزيل الـ PDF
                setTimeout(() => {
                    document.getElementById('download-btn').style.display = 'block';
                }, 500); // تأخير بسيط قبل إعادة إظهار الزر
            });
        }
    </script>
</head>
<body>

<div class="b24" id="search-section">
    <h2>Entrez les informations suivantes</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="cin">Code CIN :</label>
        <input type="text" id="cin" name="cin" required>

        <label for="date_naissance">Date de Naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required>

        <input type="submit" value="Rechercher">
    </form>
</div>

<div id="result-section">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "radeec";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cin']) && isset($_POST['date_naissance'])) {
            $cin = $_POST['cin'];
            $date_naissance = $_POST['date_naissance'];

            $sql = "SELECT id, nom, prenom, email, cin, telephone, datee, adress, genre, ville, niveau
                    FROM demandes
                    WHERE cin = :cin AND datee = :date_naissance";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':date_naissance', $date_naissance);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo '<script>document.getElementById("search-section").style.display = "none";</script>';
                echo '<div class="container" id="section-to-print">';
                echo "<h2><u>Reçu de la Demande</u></h2>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='details'>";
                    echo "<p><strong>Code</strong>: " . htmlspecialchars($row["id"]) . "</p>";
                    echo "<p><strong>Nom</strong>: " . htmlspecialchars($row["nom"]) . "</p>";
                    echo "<p><strong>Prénom</strong>: " . htmlspecialchars($row["prenom"]) . "</p>";
                    echo "<p><strong>Date de Naissance</strong>: " . htmlspecialchars($row["datee"]) . "</p>";
                    echo "<p><strong>Adresse</strong>: " . htmlspecialchars($row["adress"]) . "</p>";
                    echo "<p><strong>CIN</strong>: " . htmlspecialchars($row["cin"]) . "</p>";
                    echo "<p><strong>Téléphone</strong>: " . htmlspecialchars($row["telephone"]) . "</p>";
                    echo "<p><strong>Email</strong>: " . htmlspecialchars($row["email"]) . "</p>";
                    echo "<p><strong>Genre</strong>: " . htmlspecialchars($row["genre"]) . "</p>";
                    echo "<p><strong>Ville</strong>: " . htmlspecialchars($row["ville"]) . "</p>";
                    echo "<p><strong>Niveau d'études</strong>: " . htmlspecialchars($row["niveau"]) . "</p>";
                    echo "</div>";
                }

                echo '<button id="download-btn" onclick="printPDF()">Télécharger en PDF</button>';
                echo '</div>';
            } else {
                echo '<div class="error-message">Aucune donnée trouvée pour le CIN et la date fournis.</div>';
            }
        }
    } catch (PDOException $e) {
        echo '<div class="error-message">Erreur de connexion : ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    ?>
</div>

<h4 style="text-align: center;">2024 © RADEEC Settat <br>
Développé par <a href="https://www.facebook.com/profile.php?id=100089259122082&mibextid=LQQJ4d" style="text-decoration: none; color:blue;">Ayoub CHARRAFI</a>.</h4>
</body>
</html>
