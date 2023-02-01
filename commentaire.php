<?php
session_start();
$mysqli=new mysqli('localhost', 'root', '', 'livreor');
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}

// $request=$mysqli->query("SELECT utilisateurs.login, commentaires.commentaire, commentaires.date FROM utilisateurs INNER JOIN commentaires ON id_utilisateur=utilisateurs.id ORDER BY 'date'");
// $result=$request->fetch_all(MYSQLI_ASSOC);
// var_dump($result);
if(empty($_SESSION))
header("location:index.php"); //evite a tout Non-utilisateurs d'atteindre les comm par l'URL.
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php include("header_include.php"); ?>
    <main>
        <?php
        date_default_timezone_set('Europe/Paris');
        $date= date('d/m/Y H:i:s');
    if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            $date= date('Y/m/d H:i:s'); //si je marque date('d/m/Y) ca ne fonctionne pas. POURQUOI?
            
            $commentaire = $_POST['commentaire'];
            $iduser=$_SESSION['id'];
            if (!empty($_POST["commentaire"])) {
                $request = $mysqli->query("INSERT INTO commentaires ( commentaire, id_utilisateur, date) VALUES ( '$commentaire','$iduser', '$date')");
                header('Location:index.php');
                }
               
                
            } 
     
            
        ?>
        <div class="login-box">
            <h2>Ajouter un commentaire</h2>
            <form method="POST">
                <div class="user-box">
                    <input placeholder="Commentaire" type="textarea" name="commentaire" required="">
                </div>

                <br><br>
                <button type="submit" name="submit">Envoyer</button>
            </form>
        </div>
    </main>
    <?php include("footer_include.php"); ?>
</body>

</html>