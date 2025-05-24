<?php 


// Modifier le statut 
function changerStatut($type, $identifiant, $nouveauStatut){
    if($type === "etudiant"){
        $fichier= "../db/etudiant.json";
    }else if($type === "promotion"){
        $fichier= "../db/addpromotion.json";
    }else {
        return "type non reconnue";
    };


    if(!file_exists($fichier)){
        return "fichier introuvable";
    };

    $data=json_decode(file_get_contents($fichier), true);

    $modifier= false;

    // pour les étudiants :
    if($type === "etudiant"){
        foreach($data as $cles=> $etudiant){
            if(isset($etudiant["id"]) && $etudiant["id"]=== $identifiant){
                $data[$cles]["statut"]= $nouveauStatut;
                $modifier= true;
                break;
            }
        }
    }

    // pour les promotion :
    if($type === "etudiant"){
        foreach($data as $cles=> $promotion){
            if(isset($promotion["nom"]) && $promotion['nom']=== $identifiant){
                $data[$cles]["statut"]=$nouveauStatut;
                $modifier= true;
            }
        }
    }

    if($modifier){
        file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return " statut modifier avec succès";
    }else{
        return "il y a un problème quelque part";
    }
}