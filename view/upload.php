<?php

include ("connect.php");
include("functions.php");
if(!logged_in())("Location: login.php");

    function getExt($name){
        $array = explode(".", $name);
        $ext = strtolower(end($array));
        return $ext;
    }
    $allowed = ['jpg', 'gif', 'png', 'jpeg'];
    $success =[];
    $error = [];

    $filesearch = (isset($_POST['username']))?$_POST['username']:'';

    if(isset($_SESSION['username']))$filesearch = $_SESSION['username'];
    $files = glob("img/*".$filesearch."*");
    
    if (
        !isset($_FILES['images']['error']) ||
        is_array($_FILES['images']['error'])
    ) {
        $filename='';
        if(count($files)>0) {
            foreach($files as $kk){$filename = $kk;}
        }
        
        echo '<pre>*Error : Check Warning *</pre>';
        echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />'); 
        return;
    }
    
    switch ($_FILES['images']['error']) {
        case UPLOAD_ERR_OK:
        break;
        case UPLOAD_ERR_NO_FILE:
        if(count($files)>0) {
            foreach($files as $kk){$filename = $kk;}
        }
        echo '<pre>*No File Selected*</pre>';
        echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />');
        return;
        case UPLOAD_ERR_INI_SIZE:
        break;
        case UPLOAD_ERR_FORM_SIZE:
        if(count($files)>0) {
            foreach($files as $kk){$filename = $kk;}
        }
        
        echo '<pre>*Error : Exceeded filesize limit*</pre>';
        echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />'); 
        return;
        default:
        if(count($files)>0) {
            foreach($files as $kk){$filename = $kk;}
        }
        $error = array('name' => $name, 'msg' => 'Unknown errors');
        echo '<pre>';
        echo '*';
        print_r($error['msg']);
        echo '*</pre>';
        echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />');
        return; 
    }

    if(isset($_FILES['images']) && !empty($_FILES['images'])){
        $name = $_FILES["images"]["name"];
        $size = $_FILES["images"]['size'];
        $ext = getExt($name);

        $username = (isset($_POST['username']))?$_POST['username']:'';
        if(isset($_SESSION['username']))$username = $_SESSION['username'];
        
        $filename = $username. time(). '.' .$ext;
        $temp_filename= '';
        if(in_array($ext, $allowed) == true){
            if($size <= 8097152 && $size > 0){
                if(count($files)>0) {
                    foreach($files as $kk){$temp_filename = $kk;}
                }
                if(move_uploaded_file ( ($_FILES["images"]["tmp_name"]), ("img/".$filename))) {
                    if($temp_filename !='')unlink($temp_filename);
                    echo ('<img src= "img/'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />');
                    return;
                }
                else{
                    echo ('<img src= "img/'.$temp_filename .'" alt="" onclick = "$(\'#images\').click();"} />');
                    return;
                }
            }
            else{      
                if(count($files)>0) {
                    foreach($files as $kk){$filename = $kk;}
                }
                echo '<pre>*Exceeded filesize limit*</pre>';
                echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />');
                return;
            } 
        }
        else{      
            if(count($files)>0) {
                foreach($files as $kk){$filename = $kk;}
            }
            $error = array('name' => $name, 'msg' => 'File type not allowed');
            echo '<pre>';
            echo '*.'.$ext.'*  ';
            print_r($error['msg']);
            echo '</pre>';
            echo ('<img src= "'.$filename .'" alt="" onclick = "$(\'#images\').click();"} />');
            return;
        }
    }

    ?>