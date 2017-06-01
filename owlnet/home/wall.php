<?php require "include/navbar.php";
//pocetna strana tj wall
?>


<body class="bgblue">
<div class="clear"></div>
<div class="container"id="bigbody">

    <div id="lsidebar" class="col-lg-3 col-md-3"><ul><?php
            echo "<li><a href='profile.php'><span><img width='20px' src='{$users->get_info_current_user($db)->slika}' alt=''></span> <span>{$users->get_info_current_user($db)->ime}</span><span>&nbsp;{$users->get_info_current_user($db)->prezime}</span></a></li>";
            $i=0;
            $groups=$group->get_info_groups($db);
            while($row=mysqli_fetch_object($groups)){
            echo "<li><span><img width='20px' src='{$row->pic}' alt=''></span> <span>  <a href='group.php?g_id={$row->id}'>{$row->name}</a></span></li>";
        }$i++;?></ul></div>

    <div class="col-lg-5" id="centralbody">

     <?php $posts->add_posts($db,$users,'autor_id') ?>


        <div id="wallcont"> <?php
            $postovi=$posts->get_posts();
            $user_id= $users->get_id($_SESSION['email']);
            while($row= mysqli_fetch_object($postovi)){
                if($row->autor_id !== NULL OR $row->autor_id  !== 0 AND $row->group_id == 0 || $row->group_id==NULL) {
                    $author_id = $row->autor_id;
                    $type='author';
                    $post_author_pic=$users->get_author($author_id,$db)->slika;
                    $ime_autora=$users->get_author($row->autor_id,$db)->ime;
                    $prezime_autora=$users->get_author($row->autor_id,$db)->prezime;
                    $link='profile.php?uid='.$author_id;

                }else{
                    $author_id=$row->group_id;
                    $post_author_pic=$group->get_info_group($db,$author_id)->pic;
                    $ime_autora=$group->get_info_group($db,$author_id)->name;
                    $prezime_autora="<br>";
                    $type='group';
                    $link='group.php?g_id='.$author_id;
                }
                $post_id=$row->id;
            ?>

            <div class="status_view">

                <div class="podatci_autora">
                    <div class="podautora"><img style="float: left;" src="<?php echo $post_author_pic  ?>" height="44px" width="44px" alt="">
                        <div class="ime_prezime">
                            <a href="<?php echo $link; ?>"><?php echo $ime_autora ." " . $prezime_autora;  ?></a></div>

                        <div class="datum_statusa">
                             <?php echo $row->date . "<br>" ?>
                        </div>
                    </div>
                    <?php $posts->delete_post($user_id,$author_id,$post_id,$db,$type,$rola); ?>

                    <div class="clear"></div>
                </div>
                <div class="content_status">
            <?php
echo $row->content;            ?>
                </div>

<div class="clear"></div>
                <div class="comlike">
                    <ul>
                        <li id="numlike{$post_id}"><?php echo $posts->getnumlike($db,$post_id);  ?></li>
                        <?php $posts->ispis_lajka($db,$post_id,$user_id); ?>
                        <li onclick="unesikomTogle(<?php echo $post_id; ?>)" id="com<?php echo $post_id; ?>">Komentarisi</li>
                    </ul>
                </div>
                <div  style="display: none;" id="unesikom<?php echo $post_id; ?>">
                    <form action="" method="POST">
                    <textarea name="komentar<?php echo $post_id; ?>" id="" cols="49" rows="3" placeholder="unesi komentar"></textarea>
                    <input type="submit" name="posaljikom<?php echo $post_id; ?>" class="btn btn-primary pull-right" value="Posalji">
                    </form>
                    <?php
                    if(isset($_POST['posaljikom'.$post_id])){
                        $conntent_comm=$_POST['komentar'.$post_id];
                        $comm->add_comm($db,$post_id,$user_id,$conntent_comm);} ?>
                    <div  id="comm_view">
 <?php $comm->comm_view($db,$post_id,$users,$author_id); ?>
                    </div>
                </div>
                </div>
                <div class="clear"></div>
            <?php } ?>


        </div>

    </div>
    <div class="col-lg-3 col-md-3"id="rsidebar"></div>
</div>

<?php $posts->like($db,$user_id);
      $posts->unlike($db,$user_id);

?>
<script src="js/ajax.js"></script>
<script src="js/javasc.js"></script>

</body>
