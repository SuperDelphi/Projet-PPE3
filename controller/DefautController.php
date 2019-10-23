<?php

class DefautController extends Controller
{
    function index()
    {
        $url = "Location: http://" . SERVER . BASE_URL . "/joueur/liste";
        header($url);
    }
    
//Fonctions à replacer
    
   
//-- Fonction de récupération de l'adresse IP du visiteur
function get_ip()
{
    if ( isset ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif ( isset ( $_SERVER['HTTP_CLIENT_IP'] ) )
    {
        $ip  = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
    list($a, $b, $c, $d) = explode('.',$ip);
    $iptronq_user= $a+"."+$b;
    
}
    function verif()
    {
        $bool=FALSE;
        while($bool=FALSE){
            list($w, $x, $y,$z) = explode('.',$_SESSION['ip']);  // Exemple : 192.168.10.3 = w=192 , x=168 , y=10 , z=3 
            $iptronq_session= $w+"."+$x;
            
            if($iptronq_user==$iptronq_session){
                echo("SUCCESSFUL");
            }
            else{
                echo("FAILED");
            }
            
             $bool=TRUE;
        }
       
    }
}

?>