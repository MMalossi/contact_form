<?php
    if(isset($_POST['submit']))
    {    
        $hName='localhost'; 
        $uName='root';   
        $password='';   
        $dbName = "contatti"; 
        $dbCon = mysqli_connect($hName,$uName,$password,"$dbName");
        if(!$dbCon){
            header("Location: ./index.php?error=db");
            die('Could not Connect MySql Server' . mysqli_connect_error());
        }

        $nome = mysqli_real_escape_string($dbCon, $_POST['nome']);
        $cognome = mysqli_real_escape_string($dbCon, $_POST['cognome']);
        $email = mysqli_real_escape_string($dbCon, $_POST['email']);
        $indirizzo = mysqli_real_escape_string($dbCon, $_POST['indirizzo']);
        $citta = mysqli_real_escape_string($dbCon, $_POST['citta']);
        $provincia = mysqli_real_escape_string($dbCon, $_POST['provincia']);
        $CAP = mysqli_real_escape_string($dbCon, $_POST['CAP']);
        $nazione = mysqli_real_escape_string($dbCon, $_POST['nazione']);

        if(empty($nome) || empty($cognome) || empty($email) || empty($indirizzo) || empty($citta) || empty($provincia) || empty($CAP) || empty($nazione)){
            header("Location: ./index.php?error=emptyField&nome=".$nome."&cognome=".$cognome."&email=".$email."&via=".$indirizzo."&citta=".$citta."&provincia=".$provincia."&CAP=".$CAP."&nazione=".$nazione);
            exit();
        } else if(!preg_match("/^[a-zA-Z]*$/", $nome) || !preg_match("/^[a-zA-Z]*$/", $cognome) || !preg_match("/^[a-zA-Z]*$/", $citta)){
                header("Location: ./index.php?error=invalidCharacter&nome=".$nome."&cognome=".$cognome."&email=".$email."&via=".$indirizzo."&citta=".$citta."&provincia=".$provincia."&CAP=".$CAP."&nazione=".$nazione);
                exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ./index.php?error=invalidEmail&nome=".$nome."&cognome=".$cognome."&email=".$email."&via=".$indirizzo."&citta=".$citta."&provincia=".$provincia."&CAP=".$CAP."&nazione=".$nazione);
            exit();
        } else if(!preg_match("/^[0-9]*$/", $CAP) ){
            header("Location: ./index.php?error=notNumericCap&nome=".$nome."&cognome=".$cognome."&email=".$email."&via=".$indirizzo."&citta=".$citta."&provincia=".$provincia."&CAP=".$CAP."&nazione=".$nazione);
            exit();
        }
    
        $query = "INSERT INTO datiContatto (nome,cognome,email,indirizzo,citta,provincia,CAP,nazione,dataRichiesta)
        VALUES ('$nome','$cognome','$email','$indirizzo','$citta','$provincia','$CAP','$nazione', now())";
        mysqli_query($dbCon, $query);
        $lastId = mysqli_insert_id($dbCon);

        header("Location: ./index.php?result=submitted");
        mysqli_close($dbCon);
        exit();

    } else {
        header("Location: ./index.php");
        exit();
    }

?>
