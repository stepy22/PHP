<?php require "include/head.php";?>
<?php require "include/navbar.php";?>
<?php
//profili stranica
if(isset($_GET['g_id'])) {
    $gid = $_GET['g_id'];
    if ($group->test_id_group($db, $gid)==true) {
        $profile = $group->get_info_group($db, $gid)->pic;
        $cover = $group->get_info_group($db, $gid)->Cover;
        $name=$group->get_info_group($db,$gid)->name;
        $uid=$users->get_id($_SESSION['email']);
        $group_admin=$group->group_role_test($db,$gid,$uid);

    }else{
        echo "<img width='1000px' src='images/404.jpg'>";
        die();
    }
    }

else {
    echo "<img width='1000px' src='images/404.jpg'>";
    die();
}
?>
<body class="bgblue">

<div class="container ccenter" >
<div id="topcont">
<div id="top_profile">
<div id="coverphoto">
    <img src="<?php echo $cover; ?>" alt="">


</div>
    <div id="profilephoto">
        <img src='<?php echo $profile;?>' alt="">
    </div>
    <h1 id="imegrupe"><a><span><?php echo $name; ?></span></a></h1>

</div>
    <div id="info_nav">
<?php $opste->infomenu('Vremenska linija','Informacije','Pratioci','Slike'); ?>
    </div>
    <div class="clear"></div>
</div>

    <div id="midcont" style="margin: 0 auto">
        <div id="ginfo"></div>
        <div id="gwall">
            <?php
            if($group_admin>1){
                $posts->add_posts($db,$users,'group_id');
            }
            ?>
            <?php require 'include/group_wall.php';?>
        </div>

    </div>




</div>
<script src="js/javasc.js"></script>
</body>


