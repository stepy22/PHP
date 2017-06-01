<div id="wallcont"> <?php
    if($posts->get_posts_group($db,$gid)){
    $postovi=$posts->get_posts_group($db,$gid);
    }else{
        die();
    }
    while($row= mysqli_fetch_object($postovi)){
        $author_id=$row->autor_id;
        $post_id=$row->id;
        ?>

        <div class="status_view">

            <div class="podatci_autora">
                <div class="podautora"><img style="float: left;" src="<?php echo $profile; ?>" height="44px" width="44px" alt="">
                    <div class="ime_prezime">
                        <a href=""><?php echo $name;  ?></a></div>

                    <div class="datum_statusa">
                        <?php echo $row->date . "<br>" ?>
                    </div>
                </div>
                <?php $posts->delete_post_group($db,$group_admin,$post_id); ?>

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
                    <?php $posts->ispis_lajka($db,$post_id,$author_id); ?>
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
                    $comm->add_comm($db,$post_id,$uid,$conntent_comm);} ?>
                <div  id="comm_view">
                    <?php $comm->comm_view($db,$post_id,$users,$author_id); ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    <?php } ?>


</div>