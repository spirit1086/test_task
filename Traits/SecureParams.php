<?php
namespace App\Traits;


trait SecureParams
{
   public static function filter($param)
   {
    return trim(stripcslashes(strip_tags($param)));
   }
}
