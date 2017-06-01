<?php require "include/head.php";?>
<?php require "include/navbar.php";?>
<?php
//slicno kao group.php

if(isset($_GET['uid'])) {
    $uid = $_GET['uid']; }
else{
    $uid=$users->get_info_current_user($db)->id;
}
    if ($users->test_id_users($db,$uid)==true) {
         }
    else{
        echo "<img width='1000px' src='images/404.jpg'>";
        die();
    }
        $profile = $users->get_info_current_user($db,$uid)->slika;
$cover = $users->get_info_current_user($db,$uid)->cover;
$ime = $users->get_info_current_user($db,$uid)->ime;
$prezime = $users->get_info_current_user($db,$uid)->prezime;








?>
<body class="bgblue">

<div class="container ccenter" >
    <div id="topcont">
        <div id="top_profile">
            <div id="coverphoto">
                <img src="<?php echo $cover ?>" alt="">


            </div>
            <div id="profilephoto">
                <img src='<?php echo $profile;?>' alt="">
            </div>
            <h1 id="imegrupe"><a><span><?php echo $ime; ?></span></a><a>&nbsp;<span><?php echo $prezime; ?></span></a></h1>

        </div>
        <div id="info_nav">
            <?php $opste->infomenu('Vremenska linija','Informacije','Pratioci','Slike'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div id="midcont" style="margin: 0 auto">
        <div id="ginfo"></div>
        <div id="gwall">

        </div>

    </div>




</div>
<script src="js/javasc.js"></script>
</body>


