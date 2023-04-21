<?php 
  include "config.inc.php";
  
  try {
    // Établissement de la connexion à la base de données
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASSWORD);

    // Configuration des options de PDO
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // Gestion des exceptions PDO
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ahmed El Abaidi</title>
		<link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
		<link rel="stylesheet" href="styles/style.css" />
		<script src="https://kit.fontawesome.com/672c8bf88f.js" crossorigin="anonymous"></script>

		<script type="text/javascript"src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
		</script>
		<script type="text/javascript">
   			(function(){
      		emailjs.init("7Y3oAU51WI1PNnbvn");
   			})();
		</script>
		<script src="index.js"></script>
		<script
			type="text/javascript"
			src="https://cdn.jsdelivr.net/npm/brython@3.8.9/brython.min.js"
		></script>
		<script
			type="text/javascript"
			src="https://cdn.jsdelivr.net/npm/brython@3.8.9/brython_stdlib.js"
		></script>
	</head>
	<body onload="brython()">
		<div id="home" class="header">
			<div class="container">
				<nav>
					<img src="images/logo.png" alt="logo" class="logo" />
					<ul id="sidemenu">
						<li><a href="#home">Accueil </a></li>
						<li><a href="#about">Profil</a></li>
						<li><a href="#projects">Projets</a></li>
						<li><a href="#jeux">Jeu</a></li>
						<li><a href="#contatct">Contact</a></li>
						<li><a href="login.php" class="btnadmin">Admin</a></li>
						<i class="fas fa-times" onclick="closemenu()"></i>
					</ul>

					<i class="fa-solid fa-bars fas" onclick="openmenu()"></i>
				</nav>
				<div class="header-text">
					<p>Etudiant en Cybersecurité</p>
					<h1>
						Bonjour, je m'appelle <span> Ahmed</span> <br />
					</h1>
				</div>
			</div>
		</div>
		<!--About me -->
		<div id="about">
			<div class="container">
				<div class="row">
					<div class="about-col-1">
						<!--------------- PHOTO DE TOUT LE PROFIL A AJOUTER --------------------------->
						<img src="images/img_profil.png" alt="image_de_profil" id="ph" />
					</div>
					<div class="about-col-2">
						<h1 class="sub-title">Profil</h1>
						<p>
							En tant qu'étudiant en informatique, j'ai découvert une passion pour la
							cybersécurité. J'ai été fasciné par la complexité et les défis associés
							à la protection des systèmes informatiques contre les attaques
							malveillantes. Cette passion m'a conduit à chercher constamment à en
							apprendre davantage sur la sécurité informatique, à travers des cours en
							ligne, des lectures, des tutoriels et des projets personnels.
						</p>
						<div class="tab-titles">
							<p class="tab-links active-link" onclick="opentab('skills')">Skills</p>
							<p class="tab-links" onclick="opentab('experience')">Experience</p>
							<p class="tab-links" onclick="opentab('education')">Education</p>
						</div>
						<div class="tab-contents active-tab" id="skills">
							<ul>
								<li>
									<span>Languages informatique</span>
								</li>

								<li><i class="fa-brands fa-python"></i>PYTHON</li>
								<li>
									<i class="fa-brands fa-html5"></i>   
									<i class="fa-brands fa-css3-alt"></i>HTML/CSS
								</li>
								<li><i class="fa-brands fa-php"></i>PHP</li>
								<li><i class="fa-brands fa-square-js"></i>JAVASCRIPT</li>
								<li>
									<span>Reseau</span>
									<ul>
										<li>Cartographier un reseau</li>
										<li>Mettre en place une infrastructure reseau</li>
										<li>Configuration de diffent service sur un reseau</li>
										<li>Configuration d'un reseau local</li>
									</ul>
								</li>

								<li>
									<span>Système d'exploitation</span>
									<ul>
										<li>Windows</li>
										<li>Linux</li>
										<li>Ubuntu</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="tab-contents" id="experience">
							<ul>
								<li><span>2021-Current</span><br />Sneakiickz</li>
								<li><span>2019-Current</span><br />Vendeur en boucherie</li>
								<li><span>2019-2021</span><br />Achat&Revente</li>
							</ul>
						</div>
						<div class="tab-contents" id="education">
							<ul>
								<li><span>2022-Current</span><br />Guradia CybersecuritySchool</li>
								<li><span>2020-2022</span><br />Lycée Privée Saint Léon</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- PROJET -->
		<div id="projects">
			<?php 
					$sql = "SELECT * FROM projects";
					$result = $bdd->query($sql);

					if ($result->rowCount() > 0) {
						// Afficher les résultats
						echo "<div class='container'>
							<h1 class='sub-title'>Mes Projets</h1>
							<div class='projects-list'>";
						while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
							$id_project = $row['id'];
							$name_project = $row['name'];
							$description_project = $row['description'];
				
							// Utiliser les variables récupérées pour afficher les projets
							echo "<div>
								<h2>$name_project</h2>
								<p>$description_project</p>
								<a href='#'>Learn more</a>
							</div>";
						}
						echo "</div></div>";
					} else {
						// Afficher un message si la requête n'a renvoyé aucun résultat
						echo "Aucun projet à afficher.";
					}
				
					// Fermer la connexion
					$bdd = null;	
			?>
		<div id="jeux">
			<div class="container">
				<h1 class="sub-title">Jeux</h1>
				<h4>The Snake</h4>
				<canvas id="game-board" width="400" height="400"></canvas>
				<br />
				<h3 id="score" class="text-center">Score: 0</h3>
				<br />
				<h6 id="high-score" class="text-center">High Score: 0</h6>
				<br />
				<div class="text-center">
					<button id="instructions-btn" class="btn">Instructions</button>
				</div>

				<script type="text/python">

					from browser import document, html, window
					import random

					score = 0
					high_score = 0

					px = py = 10
					gs = tc = 20
					ax = ay = 15
					xv = yv = 0
					trail = []
					tail = 5

					pre_pause = [0,0]
					paused = False

					def game():
						global px, py, tc, gs, ax, ay, trail, tail, score
						px += xv
						py += yv
						if px < 0:
							px = tc-1
						if px > tc-1:
							px = 0
						if py < 0:
							py = tc-1
						if py > tc-1:
							py = 0
						ctx.fillStyle = "black"
						ctx.fillRect(0, 0, canvas.width, canvas.height)
						ctx.fillStyle = "lime"
						for i in range(len(trail)):
							ctx.fillRect(trail[i][0]*gs, trail[i][1]*gs, gs-2, gs-2)
							if trail[i][0] == px and trail[i][1] == py:
								score = score if paused else 0
								tail = tail if paused else 5
						trail.insert(0, [px, py])
						while len(trail) > tail:
							trail.pop()

						if ax == px and ay == py:
							tail += 1
							ax = int(random.random()*tc)
							ay = int(random.random()*tc)
							score += 1
						update_score(score)
						ctx.fillStyle = "red"
						ctx.fillRect(ax*gs, ay*gs, gs-2, gs-2)

					def update_score(new_score):
						global high_score
						document["score"].innerHTML = "Score: " + str(new_score)
						if new_score > high_score:
							document["high-score"].innerHTML = "High Score: " + str(new_score)
							high_score = new_score

					def key_push(evt):
						global xv, yv, pre_pause, paused
						key = evt.keyCode
						if key == 37 and not paused:
							xv = -1
							yv = 0
						elif key == 38 and not paused:
							xv = 0
							yv = -1
						elif key == 39 and not paused:
							xv = 1
							yv = 0
						elif key == 40 and not paused:
							xv = 0
							yv = 1
						elif key == 32:
							temp = [xv, yv]
							xv = pre_pause[0]
							yv = pre_pause[1]
							pre_pause = [*temp]
							paused = not paused

					def show_instructions(evt):
						window.alert("Use the arrow keys to move and press spacebar to pause the game.")

					canvas = document["game-board"]
					ctx = canvas.getContext("2d")
					document.addEventListener("keydown", key_push)
					game_loop = window.setInterval(game, 1000/10)
					instructions_btn = document["instructions-btn"]
					instructions_btn.addEventListener("click", show_instructions)
				</script>
			</div>
		</div>
		<!-- ----------------------- Contact ----------------- -->
		<div id="contatct">
			<div class="container">
				<div class="row">
					<div class="contact-left">
						<h1 class="sub-title">Contact</h1>
						<p><i class="fa-solid fa-envelope"></i>aelabaidi@guardiaschool.fr</p>
						<p><i class="fa-solid fa-phone"></i> 0769954893</p>
						<div class="social-icons">
							<a
								href="https://www.linkedin.com/in/ahmed-el-abaidi-4392a9252/?originalSubdomain=fr"
								><i class="fa-brands fa-linkedin"></i
							></a>
							<a href="https://github.com/Mrcnboy"
								><i class="fa-brands fa-github"></i
							></a>
						</div>
						<a href="Cv Ahmed.pdf" class="btn btn2" target="_blank">Téléchargez mon CV</a>
					</div>
					<div class="container container-custom">
                            <div class="col-md-6 p-5 bg-primary text-white" >
                            </div>
                            <div class="col-md-12 border-left ">
                                <input type="text" class="form-control name-custom" id="name"placeholder="Votre Nom"/>
                                <input type="email"class="form-control mail-custom" id="email"placeholder="Votre Mail"/>
           						<textarea placeholder="Votre Message" class="form-control msg-custom" id="message" rows="6"></textarea>
          						<button class="button button--flex button-custom" onclick="sendMail()">Validez<i class="uil uil-message"></i></button>
        					</div>
   				    </div>
                </div>
				</div>
			</div>
			<div class="copyright">
				<p>Copyright © El Abaidi Ahmed 2023, fait pour le projet final.</p>
			</div>
		</div>
		<script>
			var tablinks = document.getElementsByClassName('tab-links');
			var tabcontents = document.getElementsByClassName('tab-contents');
			function opentab(tabname) {
				for (tablink of tablinks) {
					tablink.classList.remove('active-link');
				}
				for (tabcontent of tabcontents) {
					tabcontent.classList.remove('active-tab');
				}
				event.currentTarget.classList.add('active-link');
				document.getElementById(tabname).classList.add('active-tab');
			}
			var sidemenu = document.getElementById('sidemenu');

			function openmenu() {
				sidemenu.style.right = '0';
			}
			function closemenu() {
				sidemenu.style.right = '-200px';
			}
		</script>
	</body>
</html>
