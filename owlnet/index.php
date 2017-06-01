<?php
 include "include/head.php";

if(isset($_SESSION['email'])){
    include "home/wall.php";
}else{
    include "home/logreg.php";

}