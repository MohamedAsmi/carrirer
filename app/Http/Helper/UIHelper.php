<?php 

namespace App\Http\Helper;

use App\Models\logo;

class UIHelper {
  
    public static function getLogoPath(){
        $path = logo::getLogoPath();
        return $path;
    }


}


?>