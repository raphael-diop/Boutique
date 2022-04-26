<?php
session_start();
require ("../back/ModelUsers.php");

if(isset($_POST['login']) && isset($_POST['password'])){
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);


    $user = new User();
    $user->connexion($login, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Connexion</title>
</head>

    <?php require 'header.php'; ?>

<body class='body'>
<main class="main">
    <form class="formContainer" action="" method="post">
        <h1>CONNEXION</h1>
        <?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} ?>
        <p><input type="text" name="login" class="zonetext" id="login" placeholder="Login..."></p>
        <p><input type="password" name="password" id="password" class="zonetext"  placeholder="Password ..."></p>
        <p style="color:red" id="erreur"></p>
        <p><input type="submit" id="#button" class="boutonvalidation" name="submit" value="Envoyer"></p> 
    </form>
    <script type="text/javascript">
        let btnEnvoyer = document.getElementById('#button');

        btnEnvoyer.addEventListener("click", function(e) {
            //récupérer les données du formulaires
            var erreur;
            login = document.querySelector("#login")
            password = document.querySelector("#password")
            console.log(login.valeu);

            //Vérification si le formulaire n'est pas vide 
          
            if (!password.value){
                erreur = "Veuillez renseigner votre password";
            }

            if (!login.value){
                erreur = "Veuillez renseigner votre Login";
            }

            if(erreur){
                e.preventDefault();
                document.querySelector("#erreur").innerHTML = erreur;
                return false;
            }else{
                
            }
        })
    </script>
</main>

    <?php require 'footer.php'; ?>

</body>
</html>
