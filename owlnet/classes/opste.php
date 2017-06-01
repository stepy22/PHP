<?php
class opste{
    //neke opste metode koje barataju sa stvarima koje nisam svrstao u ni jednu kategoriju
    public function titlehandler(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $titlen = basename($path, '.php');
        if($titlen === "index"){
            if(isset($_SESSION['email'])){
                $titlen = "OwlNet";
            }
            else{
                $titlen= "Welcome to OwlNet";
            }
        }
        return $titlen;
    }
    public function vratiBname(){
        return $_SERVER['SCRIPT_FILENAME'];
    }
    public function infomenu($prvitab,$drugitab,$trecitab,$cetvrtitab){
       echo <<<EOT
      <ul class="nav boldnavtab nav-tabs pull-right">
        <li class="active"><a  href="#">{$prvitab}</a></li>
  <li><a href="#">{$drugitab}</a></li>
  <li><a href="#">{$trecitab}</a></li>
    <li><a href="#">{$cetvrtitab}</a></li>
     <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ostalo<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Submenu 1-1</a></li>
        <li><a href="#">Submenu 1-2</a></li>
        <li><a href="#">Submenu 1-3</a></li>
      </ul>
    </li>
  </ul>
EOT;

    }
}
