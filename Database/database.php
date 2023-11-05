<?php
class Model
{
private static $base;
private function setConnexion()
{
   self::$base = new PDO("mysql:host=localhost;dbname=Personnel;charset=utf8",'root','');
   self::$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}

public function getConnexion()
{
    if(self::$base == null)
    {
        self::setConnexion();
    } 
    return self::$base;
}

}
?>