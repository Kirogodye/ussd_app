<?php
    //Reads the variables sent via POST from AT gateway
    $sessionId = $_POST['session_id()'];
    $serviceCode = $_POST['serviceCode'];
    $phoneNumber = $_POST['phoneNumber'];
    $text = $_POST['text'];
    $solde = 10000; //On initialise le solde a 10.000 FBU
    if($text == ""){
        //This is the first request. Note how we start the response with CON
        $response = "CON Lumitel Data Package\n";
        $response .= "1) Nuité (0 am - 6am)\n";
        $response .= "2) 1 jr\n";
        $response .= "3) 7 jrs\n";
        $response .= "4) 15 jrs\n";
        $response .= "5) 30 jrs\n";
        $response .= "6) 30 jrs ECO\n";
        $response .= "7) illimite\n";
        $response .= "8) Sociale\n";
        $response .= "9) Pay as you go\n";
        $response .= "10) Solde\n";
        $response .= "11) Autres options";

    }else if($text=="1"){
        //Business logic for the first level response
        $response = "CON Options\n";
        $response .= "1) 99F = 200MB\n";
        $response .= "2) 299F = 1GB\n";
        $response .= "3) 499F = 1,5GB\n";
        $response .= "4) 999F = 5GB";

    }else if ($text =="1*1"){
        //Business logic for the first level response
        //This is the terminal request. Note how it starts with END
        $solde = $solde - 99;
        $response = "END Vous avez 200MB à utiliser jusqu'à 6h00\n";
        $response .= "Votre solde est ".$solde;

    }else if ($text =="1*2"){
        //Business logic for the first level response
        //This is the terminal request. Note how it starts with END
        $solde = $solde - 299;
        $response = "END Vous avez 1GB à utiliser jusqu'à 6h00\n";
        $response .= "Votre solde est ".$solde;

    }else if ($text =="1*3"){
        //Business logic for the first level response
        //This is the terminal request. Note how it starts with END
        $solde = $solde - 499;
        $response = "END Vous avez 1,5GB à utiliser jusqu'à 6h00\n";
        $response .= "Votre solde est ".$solde;

    }else if ($text =="1*4"){
        //Business logic for the first level response
        //This is the terminal request. Note how it starts with END
        $solde = $solde - 999;
        $response = "END Vous avez 5GB à utiliser jusqu'à 6h00\n";
        $response .= "Votre solde est ".$solde;

    } else if($text=="6"){
        //Business logic for the first level response
        $response = "CON Description\n";
        $response .= "1) 5000F = 700MB\n";
        $response .= "2) 7000F = 1.6GB\n";
        $response .= "3) 10000F = 2.5GB\n";
        $response .= "4) 20000F = 6GB";

    }else if($text=="6*1"){
        $expiryDate=Date('d/m/Y', strtotime('+30 days'));
        $solde = $solde - 5000;
        $response = "END Vous avez 700MB utilisable jusqu'au ".$expiryDate."\n";
        $response .= "Votre nouveau solde est ".$solde;
        
    }else if($text=="6*2"){
        $expiryDate=Date('d/m/Y', strtotime('+30 days'));
        $solde = $solde - 7000;
        $response = "END Vous avez 1.6GB utilisable jusqu'au ".$expiryDate."\n";
        $response .= "Votre nouveau solde est ".$solde;
        
    }else if($text=="6*3"){
        $expiryDate=Date('d/m/Y', strtotime('+30 days'));
        $solde = $solde - 10000;
        $response = "END Vous avez 2.5GB utilisable jusqu'au ".$expiryDate."\n";
        $response .= "Votre nouveau solde est ".$solde;
        
    }else if($text=="6*4"){
        $expiryDate=Date('d/m/Y', strtotime('+30 days'));
        $solde = $solde - 20000;
        $response = "END Vous avez 6GB utilisable jusqu'au ".$expiryDate."\n";
        $response .= "Votre nouveau solde est ".$solde;
        
    } else{
        $options = array("1","1*1","1*2","1*3","1*4","6","6*1","6*2","6*3","6*4");
        if(!in_array($text,$options,true)){
            $response = "END Choix invalide.";

        }
    } 
    header("Content-type:text/plain");
    echo $response;

?>