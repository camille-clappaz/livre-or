<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html><?php
        session_start();

        $mysqli = new mysqli('localhost', 'root', '', 'livreor');
        if ($mysqli->connect_error) {
            echo "erreur de connexion a MySQL:" . $mysqli->connect_error;
            exit();
        }
        date_default_timezone_set('Europe/Paris');
        $date = date('d/m/Y H:i:s');

        if (isset($_POST['submit'])) {
            // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            $date = date('Y/m/d H:i:s'); //si je marque date('d/m/Y) ca ne fonctionne pas. POURQUOI?

            $commentaire = $_POST['commentaire'];
            $iduser = $_SESSION['id'];
            if (!empty($_POST["commentaire"])) {
                $request = $mysqli->query("INSERT INTO commentaires ( commentaire, id_utilisateur, date) VALUES ( '$commentaire','$iduser', '$date')");
            }
        }

        $request = $mysqli->query("SELECT utilisateurs.login, commentaires.commentaire, commentaires.date FROM utilisateurs INNER JOIN commentaires ON id_utilisateur=utilisateurs.id ORDER BY date DESC");
        //attention ORDER BY date, et pas ORDER BY 'date' !!
        $result = $request->fetch_all(MYSQLI_ASSOC);

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
    <?php include("header_include.php");
    ?>
    <main class="livreor">
        <div class="commentaires">
            <table>
                <thead>
                    <tr>

                        <th>
                            <p>Posté le</p>
                        </th>
                        <th>
                            <p>Par utilisateur</p>
                        </th>
                        <th>
                            <p>Commentaires</p>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    for ($i = 0; $i < count($result); $i++) : ?>
                        <tr>
                            <td><?= $result[$i]['date'] ?></td>
                            <td><?= $result[$i]["login"] ?></td>
                            <td class="comm">
                              
                             <?=  $result[$i]['commentaire'] ?>
                                
                          
                            </td>
                            
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>


        <?php


        ?>
        <?php if (!empty($_SESSION)) : ?>
            <div class="login-box2">
                <h2>Ajouter un commentaire</h2>
                <form method="POST">
                    <div class="user-box">
                        <textarea placeholder="Commentaire" name="commentaire" id="" required=""></textarea>
                    </div>

                    <br><br>
                    <button type="submit" name="submit">Envoyer</button>
                </form>
            </div>

        <?php  //ne pas oublier php derriere <?//
        endif; ?>

    </main>
    <?php include("footer_include.php"); ?>
</body>

</html>