<?php

  function url_for($script){
    if($script[0] != '/'){
    	$script  = '/'.$script;
    }
    return WWW_ROOT.$script;
  }
  function redirect_to($string){
    header("Location: ".$string);
  }

 ?>
