<?php
session_start();
$mysqli=new mysqli('localhost', 'root', '', 'livreor');
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}
// $request=$mysqli->query("SELECT * FROM utilisateurs WHERE login LIKE'$login'");
// $result=$request->fetch_all(MYSQLI_ASSOC);
// var_dump($result);
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
    
        if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            if (!empty($_POST["login"]) && !empty($_POST["password"])) {
                $id = $_SESSION['id'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                // if ($_POST['password'] == $_POST['confirmpassword']) { //Attention si on cherche par le login, on ne pourra pas le modifier
                    //donc il faut chercher par l'id.
                    $request = $mysqli->query("UPDATE `utilisateurs`  SET login='$login', password='$password' WHERE id LIKE'$id'");
                    $_SESSION['login']=$login;
                    $_SESSION['password']=$password; //pour afficher la MAJ sur l'index
                    header('Location:index.php');
                // } else {
                //     echo "Les mots de passe sont différents!";
                // }
            } else {
                echo "il manque des trucs bro!";
            }
        }
        ?>
 <div class="login-box">
        <h2>Modifier le profil</h2>
        <form method="POST">
            <div class="user-box">
                <input placeholder="Login" type="text" name="login" value="<?php
                                                            $login = $_SESSION['login'];
                                                            
                                                            echo "$login"; ?>">
            </div>
            <div class="user-box">
                <input placeholder="Password" type="password" name="password" value="<?php
                                                                    $password = $_SESSION['password'];
                                                                    echo "$password"; ?>">
            </div>
            <br><br>
            <button type="submit" name="submit">Modifier</button>
        </form>
    </div>

    </main>
   
    <?php include("footer_include.php"); ?>
</body>

</html>