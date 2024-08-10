<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="image_icon.jpeg" rel="icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Contactez-Nous</title>
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #e0eaff, #b3c6f1);
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Conteneur principal */
        .b23 {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            animation: fadeIn 1s ease-out;
        }

        /* Titre principal */
        .b23 h1 {
            font-size: 2em;
            font-weight: bold;
            color: #003366;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Sections de formulaire */
        .b23 form div {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
        }

        /* Icônes dans le formulaire */
        .b23 i {
            color: #003366;
            font-size: 20px;
            margin-right: 15px;
        }

        /* Champs de texte */
        input[type="text"], input[type="email"], input[type="tel"], textarea {
            flex: 1;
            padding: 10px;
            border: none;
            background: #f9f9f9;
            font-size: 16px;
            border-bottom: 2px solid #003366;
            box-sizing: border-box;
            outline: none;
            transition: border-bottom-color 0.3s ease;
        }

        /* Animation pour la ligne sous le champ */
        input[type="text"]:focus, 
        input[type="email"]:focus, 
        input[type="tel"]:focus,
        textarea:focus {
            border-bottom-color: #002244;
        }

        /* Label */
        span {
            font-weight: bold;
            color: #003366;
            display: block;
            margin-bottom: 5px;
        }

        /* Champ de texte pour le message */
        textarea {
            width: calc(100% - 40px);
            min-height: 100px;
            padding: 15px;
            border: none;
            background: #f9f9f9;
            border-bottom: 2px solid #003366;
            box-sizing: border-box;
            font-size: 16px;
            line-height: 1.5;
            resize: none;
            overflow: hidden;
            display: block;
            vertical-align: top;
        }

        /* Boutons */
        button {
            background-color: #003366;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            display: block;
            margin: 20px auto;
        }

        button:hover {
            background-color: #002244;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        button:active {
            background-color: #001433;
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Séparateurs */
        hr {
            border: 0;
            border-top: 2px solid #e0e0e0;
            margin: 30px 0;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .b23 {
                width: 95%;
                padding: 15px;
            }

            .b23 h1 {
                font-size: 1.8em;
            }

            .b23 form div {
                margin-bottom: 15px;
            }

            button {
                padding: 10px 18px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .b23 h1 {
                font-size: 1.5em;
            }

            .b23 form div {
                margin-bottom: 10px;
            }

            button {
                padding: 8px 15px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="b23">
        <h1>Contactez-Nous</h1>
        <form action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="ae536c07-0e83-4361-823d-59c7e16c4e62">
            <div>
                <i class="fa-solid fa-user"></i> &nbsp;
                <span for="full-name">Nom & Prénom :</span>
                <input type="text" name="Nom Complet" id="Nom Complet" placeholder="Nom Complet" required>
            </div>
            <div>
                <i class="fa-solid fa-envelope"></i>&nbsp;
                <span for="email3">Email :</span>
                <input type="email" id="email3" name="Email Address" placeholder="Email" required>
            </div>
            <div>
                <i class="fa-solid fa-id-card"></i> &nbsp;
                <span for="cin3">CIN :</span>
                <input type="text" name="CIN" id="cin3" placeholder="CIN" required>
            </div>
            <div>
                <i class="fa-solid fa-message"></i>&nbsp;
                <span for="message3">Message :</span><br>
                <textarea id="message3" name="Message" placeholder="Ecrire votre Message..." class="problematique" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
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
