<?php session_start();
include'include/connexionBdd.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Championnat de babyfoot</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>
        <header>
			<div class="wrap">
            	<?php include'include/banniere.php' ?>			
			</div>
        </header>
        
        <nav>     
        <div class="wrap">
        	<?php include'include/menuPrincipal.php' ?>
			</div>
        </nav>
        
		<div class="content">
			<div class="wrap">
			<p>
				Bienvenue sur le site !
			</p>
			</div>
        </div>
        
        <footer>
			<div class="wrap">
            	<?php include'include/footer.php' ?>
			</div>
        </footer>
    </body>
</html>
