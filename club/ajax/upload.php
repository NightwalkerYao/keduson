<?php
    $out = array('end'=>'fail');
    if(isset($_FILES['av']) && $_FILES['av']['error'] == 0){
        $filename = strip_tags($_FILES['av']['name']);
        $ext = pathinfo($filename,PATHINFO_EXTENSION);
        $store_name = uniqid();
        $store_name .= '.'.$ext;
    
        $allowed = array('jpg','jpeg','png','gif');
        if(in_array(strtolower($ext), $allowed)){
            if(!is_dir('../pics'))
                mkdir('../pics', 0777);
            $dir_path = '../pics/'.$store_name;
            if(move_uploaded_file($_FILES['av']['tmp_name'], $dir_path)){
            // good ops here
                require("../../php/gd.php");
                $rez = Resolution($dir_path);
                if($rez["width"]<100 OR $rez["height"]<100){
                    $out['end'] = 'fail';
                    $out['message'] = "L'image est trop petite. Il faut au moins 100x100";
                }else{
                    $t200 = Redim($store_name,200,200,'../pics/');
                    $out['path'] = $t200;
                    $out['end'] = 'success';
                }
                @unlink($dir_path);
            }else{
                $out["end"]="fail";
                $out["message"]="Une erreur s'est produite pendant la copie du fichier sur le serveur.";
            }
        }else{
            $out["end"]="fail";
            $out["message"]="Le fichier soumis n'est pas dans la liste des types autorisés.";
        }
    }
    echo json_encode($out);
    exit;
