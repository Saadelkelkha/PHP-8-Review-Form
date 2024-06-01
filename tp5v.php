<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
        <title>Le livre est d'or </title>
    </head>
    <body style="background-color: #ffcc00;">
        <form action="tp5v.php" method="post" >
            <fieldset>
                <legend><b>Donnez votre avis sur PHP 8 ! </b></legend>
                    <b> Nom :
                        <input type="text" name="nom" width="60" /> <br>
                        Mail :
                        <input type="text" name="mail" width="60" /> <br>
                        Vos commentaires sur le site
                    </b><br>
                    <textarea name="comm" rows="10" cols="50"></textarea> <br>
                    <input type="submit" value="Envoyer " name="env" />
                    <input type="submit" value="Afficher les avis" name="aff" />
            </fieldset>
        </form>
        <?php
            $date= time();
            if(isset($_POST['env'])) {
                if(isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['comm'])) {
                    echo "<h2>",$_POST['nom']," merci de votre avis </h2> ";
                    if($id_file=fopen("livre.txt","a")) {
                    fwrite($id_file,$_POST['nom'].":".$_POST['mail'].":".$date.":".$_POST['comm']."\n");
                    fclose($id_file);
                    }
                }
            }
            if(isset($_POST['aff'])) {
                if($id_file=fopen("livre.txt","r")) {
                    echo "<table border=\"2\">";
                    $i=0;
                    while(true) {
                        if(fgets($id_file) == ""){
                            break;
                        }else{
                            $tab0 = explode(":",fgets($id_file));
                            $tab[$i] = $tab0; 
                            $i++;
                        }  
                    }
                    $tab=array_reverse($tab);
                    echo "<hr />";
                    for($i=0;$i < 5;$i++) {
                        echo "<tr> <td>",$i+1 ,": de: ".$tab[$i][0]." </td><td> " . $tab[$i][1] . "</td><td>le: ",date("d/m/y H:i:s", $tab[$i][2])," </td></tr>";
                        echo "<tr> <td> " . $tab[$i][3] . "</td></tr> ";
                    }
                    fclose($id_file);
                }
                echo "</table> ";
            }else {
                echo "<h2>Donnez votre avis puis cliquez sur 'envoyer' !</h2> ";
            }
        ?>
    </body>
</html>
