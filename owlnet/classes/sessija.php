<?php
class sessija{
    public  function  __construct()
    {
        session_start();
    }
    public function setujem_sesiju($kljuc,$vrednost){
        $_SESSION[$kljuc] = $vrednost;
    }
    public function uzmi_sesiju($kljuc){
      if (isset($_SESSION[$kljuc])) {
           return $_SESSION[$kljuc];

}else{
    return false;
}
}
}
