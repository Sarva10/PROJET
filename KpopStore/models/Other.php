<?php

namespace Models;

// Ce model nous sert à faire le data cleansing et gérer la publication/téléchargement des images 

class Other extends Database {

    public function dataCleansing($data) {

        $data = htmlspecialchars($data);        // Convertit les caractères spéciaux en entités HTML
        $data = trim($data);                    // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $data = stripslashes($data);            // Supprime les antislashs d'une chaîne
       
        return $data;
    }


public function upload(array $file, string $dossier = '', array &$errors, string $folder = REPERTORY, array $fileExtensions = ACCEPT) {
    
    $filename = '';

    if ($file["error"] === UPLOAD_ERR_OK) {
        $tmpName = $file["tmp_name"];

       
        $tmpNameArray = explode(".", $file["name"]);
        $tmpExt = end($tmpNameArray);
        if(in_array($tmpExt, $fileExtensions)) {
           
            $filename = uniqid().'-'.basename($file["name"]);

            if(!move_uploaded_file($tmpName, $folder.$dossier."/".$filename))
                $errors[] = "Le fichier n'a pas été enregistré correctement";

            if(!in_array(mime_content_type($folder.$dossier."/".$filename), TYPES, true))
                $errors[] = "Le fichier n'a pas été enregistré correctement !";
        }
        else {
            $errors[] = "Ce type de fichier n'est pas autorisé !";
        }
    }
    else if($file["error"] == UPLOAD_ERR_INI_SIZE || $file["error"] == UPLOAD_ERR_FORM_SIZE) {
       
        $errors[] = 'Le fichier est trop volumineux';
    }
    else {
        $errors[] = "Une erreur a eu lieu au moment du téléchargement";
    }
    return $filename;
}

public function alert(){

    if(isset($msg)){

        require_once('config/config.php');
        $template = "views/_validated.phtml";
        include_once 'views/layout.phtml';

    }
}



};

const REPERTORY = 'public/upload/';             
const ACCEPT = ['jpg','jpeg','png'];
const TYPES = [
                        'png' => '.png',
                        'jpeg' => '.jpeg',
                        'jpg' => '.jpg'
];