
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="image_icon.jpeg" rel="icon"/>
    <title>Site Web</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body{
  background-image:url("https://media.istockphoto.com/id/1430287217/pt/vetorial/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=tsqF4YnFX35ikwBGn9sRuNgs932brerjdHjGiG2_oII=");
  background-size: cover; /* Ajuste la taille de l'image pour couvrir le conteneur */
  background-position: center; /* Centre l'image */
  background-repeat: no-repeat; 
}
@import url("https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900");

.content {
  position: relative;
  left:170px;
  bottom:104px;
  
}

.content h2 {
  color: #187d0b;
  font-size: 5em;
  position: absolute;
  transform: translate(-50%, -50%);
  
}

.content h2:nth-child(1) {
  color: transparent;
  -webkit-text-stroke: 2px #03f45f;
}

.content h2:nth-child(2) {
  color: #03a9f4;
  animation: animate 4s ease-in-out infinite;
}

@keyframes animate {
  0%,
  100% {
    clip-path: polygon(
      0% 45%,
      16% 44%,
      33% 50%,
      54% 60%,
      70% 61%,
      84% 59%,
      100% 52%,
      100% 100%,
      0% 100%
    );
  }

  50% {
    clip-path: polygon(
      0% 60%,
      15% 65%,
      34% 66%,
      51% 62%,
      67% 50%,
      84% 45%,
      100% 46%,
      100% 100%,
      0% 100%
    );
  }
}
i{
  font-size: 1em;
  padding: 0.6em 0.8em;
  border-radius: 0.5em;
  border: none;
  background-color: #000;
  color: #fff;
  cursor: pointer;
  
}


i{
    position: relative;
    left:420px;
    top:15px;
    
    
}

a {
    text-decoration: none;
    color:black; /* nhyd decoration lli hya khat ta7t */
}
.p2{
    position: relative;
    font-family: serif;
    text-transform: uppercase;
    font-size: 1.2em;
    letter-spacing: 1px;
    overflow: hidden;
    background: linear-gradient(90deg,rgb(255, 255, 255), #000000, rgb(255, 255, 255));
    background-repeat: no-repeat;
    background-size: 80%;
    animation: animatee 15s linear infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: rgba(244, 6, 6, 0);
  }
  
  
  @keyframes animatee {
    0% {
      background-position: -500%;
    }
    100% {
      background-position: 500%;
    }
  }
  .btns{
    display: flex;
    column-gap: 2rem;
    
  }
  .btns i{
    margin-right: -65px;
   
  }
  i{
    background-color: white;
    border-radius: 5px;
    color: var(--color-white);
    cursor: pointer;
    transition:
    scale 0.25s ease-in;
    opacity: 0.25s ease-in;
    filter: 0.25s ease-in;
    &:hover{
      scale: 1.2;
    }
  }
  .btns:has(i:hover) i:not(:hover){
    scale:0.8;
    opacity: 0.8;
    filter: blur(4px);
   
  }
  i:hover{
    background-color:#13da09;
  }

  .hi-slide {
            position: relative;
            left:300px;
            bottom:220px;
            width: 600px;
            height: 300px;
            border-radius: 50px;
            margin: 115px auto 0;
        }

        .hi-slide .hi-next,
        .hi-slide .hi-prev {
            position: absolute;
            top: 200px;
            width: 40px;
            height: 40px;
            margin-top: -20px;
            border-radius: 50%;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
            background-color: white;
            color: black;
            transition: all 0.7s;
            font-size: 20px;
            font-weight: bold;
            z-index: 10;
            
        }

        .hi-slide .hi-next:hover{
            background:green;
        }
        .hi-slide .hi-prev:hover {
            background-color: red;
        }

        .hi-slide .hi-prev {
            left: 10px;
        }

        .hi-slide .hi-prev::before {
            content: '<';
        }

        .hi-slide .hi-next {
            right: 10px;
        }

        .hi-slide .hi-next::before {
            content: '>';
        }

        .hi-slide > ul {
            list-style: none;
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .hi-slide > ul > li {
            overflow: hidden;
            position: absolute;
            z-index: 0;
            left: 0;
            top: 0;
            width: 100%;
            height: 400px;
            margin: 0;
            padding: 0;
            border: 1px solid white;
            cursor: pointer;
            background: #333;
            transition: opacity 0.7s, z-index 0s 0.7s;
        }

        .hi-slide > ul > li.active {
            z-index: 1;
            opacity: 1;
            transition: opacity 0.7s;
        }

        .hi-slide > ul > li.hidden {
            opacity: 0;
            z-index: 0;
        }

        .hi-slide > ul > li > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
       

        

        .container {
      display: flex;
      flex-wrap: wrap; /* Permet aux éléments de passer à la ligne suivante */
      width: 100%;
      gap: 10px; /* Espace entre les éléments */
      box-sizing: border-box; /* Inclut les marges dans la largeur totale */
      justify-content: space-between; /* Espace entre les éléments */
    }

    .box {
      flex: 1 1 calc(20% - 10px); /* Chaque box prendra 20% de la largeur du conteneur moins l'espace entre les éléments */
      height: 150px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      background: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
      opacity: 0;
      transform: translateY(20px); /* Position initiale */
      transition: opacity 0.5s ease, transform 1s ease, transform 0.3s ease; /* Ajout de la transition de mise à l'échelle */
    }

    .box:nth-child(1) {
      background-color: rgba(0, 0, 0, 0.6);
    }

    .box:nth-child(2) {
      background-color: rgba(0, 0, 0, 0.7);
    }

    .box:nth-child(3) {
      background-color: rgba(0, 0, 0, 0.8);
    }

    .box:nth-child(4) {
      background-color: rgba(0, 0, 0, 0.9);
    }

    .box:nth-child(5) {
      background-color: rgba(0, 0, 0, 1);
    }

    .box.visible {
      opacity: 1;
      transform: translateY(0); /* Position finale */
    }

    .box:hover {
      transform: scale(1.08); /* Mise à l'échelle à 1.1 */
      transition: transform 0.3s ease; /* Transition pour l'effet de survol */
    }

.radeec{
  width: 600px;
  height: 100px;
}
.radeec > p{
  color:white;
  font-size:1.5rem;
}
.radeec > p:hover{
  font-size:1.55rem;
}

  </style>
</head>
<body?>
 <br>

 
   <div class="principale">
    <div class="btns">
   <i class="fa-solid fa-user-tie">&nbsp;&nbsp;<a href="http://localhost/page_demandes.php">demande</a></i>&nbsp;&nbsp;
   <i class="fa-solid fa-file-circle-exclamation">&nbsp;&nbsp;<a href="http://localhost/page_problemes.php">probleme</a></i>&nbsp;&nbsp;
   <i class="fa-solid fa-envelope-circle-check">&nbsp;&nbsp;<a href="http://localhost/page_contact.php">contact</a></i>&nbsp;&nbsp;
   <i class="fa-solid fa-file">&nbsp;&nbsp;<a href="http://localhost/page_mes_donnees.php">Recu Demande</a></i>&nbsp;&nbsp;
   <i class="fa-solid fa-file">&nbsp;&nbsp;<a href="http://localhost/page_mes_donnees2.php">Recu Probleme</a></i>&nbsp;&nbsp;
   </div>
<br><br>
 
<section>
  <div class="content">
    <h2>RADEEC</h2>
    <h2>RADEEC</h2>
  </div>
</section>
  <hr><hr><br>
  <div class="radeec">
    <h2 style="color:green; font-size:2rem;"><u><b>Qui est RADEEC ?</b></u></h2>
<p> La RADEEC (Régie Autonome de Distribution d’Eau et d’Electricité de la Chaouia) est un établissement public
 à caractère industriel et commercial, crée en 1976 par l’arrêté N°959 du 10/09/1976 de Mr. le Ministre de 
 l’intérieur, en application du décret N°264-396 du 29/09/1964 relatif aux régies communales.
Dotées de la personnalité civile et de l’autonomie financière, la RADEEC assure la distribution d’eau potable et 
la gestion du secteur assainissement liquide dans les deux provinces de Settat et de Berrechid, dans une zone d’action regroupant , 
la ville de Settat , six municipalités et quatre communes rurales.</p>
  </div>
  <div class="slide hi-slide">
        <div class="hi-prev"></div>
        <div class="hi-next"></div>
        <ul>
            <li class="active"><img src="jrne.jpg" alt="Slide 1"></li>
            <li class="hidden"><img src="Screenshot_3-8-2024_154615_www.radeec.ma.jpeg" alt="Slide 2"></li>
            <li class="hidden"><img src="Screenshot_3-8-2024_154722_www.radeec.ma.jpeg" alt="Slide 3"></li>
            <li class="hidden"><img src="Screenshot_3-8-2024_154823_www.radeec.ma.jpeg" alt="Slide 4"></li>
            <li class="hidden"><img src="Capture2.png" alt="Slide 5"></li>
            <li class="hidden"><img src="Capture3.png" alt="Slide 6"></li>
        </ul>
    </div>
   <div style="margin-top:-60px;">
    <hr><hr>
<p class="p2">&nbsp;&nbsp;Bienvenue sur notre plateforme dédiée aux demandes et aux communications avec notre entreprise </p>   

<div class="container">
  <div class="box">Soumettre une demande pour rejoindre notre équipe ou pour toute autre opportunité au sein de l'entreprise.</div>
  <div class="box">Envoyer un message directement par email pour poser des questions ou faire part de vos préoccupations.</div>
  <div class="box">Faire une réclamation si vous rencontrez des problèmes ou si vous avez des retours à formuler concernant nos services.</div>
  <div class="box">Téléchargez le reçu de votre demande de travail pour votre dossier personnel.</div>
  <div class="box">Téléchargez le reçu de votre réclamation de problème pour votre dossier personnel.</div>
</div>
 <br>
<p style="font-size:1.3rem;font-family: cursive;">Nous avons conçu cette page pour vous offrir un accès facile et rapide à toutes les options dont vous avez besoin pour interagir avec nous. N'hésitez pas à utiliser les 
  outils mis à votre disposition pour nous contacter ou gérer vos demandes...</p>
 <hr style="position:relative; buttom:30px;">
 <br>
 </div>
 <h4 style=" text-align: center;">2024 © RADEEC Settat <br>
 Développé par <a href="https://www.facebook.com/profile.php?id=100089259122082&mibextid=LQQJ4d" style="text-decoration: none; color:blue;">Ayoub CHARRAFI</a>.</h4>

 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="js/jquery.hislide.js"></script>
    <script>
        $(document).ready(function() {
            var $slides = $('.hi-slide > ul > li');
            var currentIndex = 0;

            function showSlide(index) {
                $slides.removeClass('active').addClass('hidden');
                $slides.eq(index).removeClass('hidden').addClass('active');
            }

            $('.hi-prev').click(function() {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : $slides.length - 1;
                showSlide(currentIndex);
            });

            $('.hi-next').click(function() {
                currentIndex = (currentIndex < $slides.length - 1) ? currentIndex + 1 : 0;
                showSlide(currentIndex);
            });
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  const boxes = document.querySelectorAll('.box');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      } else {
        entry.target.classList.remove('visible');
      }
    });
  }, { threshold: 0.1 });

  boxes.forEach(box => {
    observer.observe(box);
  });
});
</script>


</div>
</body>
</html>


