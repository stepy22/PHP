<?php
class posts
{
    //klasa vezana za statuase
    public function get_posts()
    {
        //uzimam sve statuse iz baze po opadajucem redosledu (status koji je zadnji unet se prikazuje na prvom mestu)
        $db = new Database();
        $query = "SELECT * FROM posts ORDER BY id DESC";
        $result = $db->select($query);
        return $result;
    }
    public function get_posts_group($db,$gid)
    {
        //uzimam statuse samo za grupu/stranicu
        $query = "SELECT * FROM posts where group_id='$gid' ORDER BY id DESC";
        $result = $db->select($query);

        return $result;
    }
    public function get_pots_from_author($id,$type,$db){
        //uzimam postove od autora, dal type grupa il user
        $query = "SELECT * FROM posts where $type='$id' ORDER BY id DESC";
        $result = $db->select($query);
        return $result;
    }
    public function get_author_posts($db,$post_id){
        //trazim autora posta na osnovu post_id-a
        $query="SELECT autor_id FROM posts where id='$post_id'";
        $result=$db->select($query);
        return $result;
    }
public function add_posts($db,$users,$type){
    //polje za dodavanje statusa
    $slika=$users->get_info_current_user($db)->slika;
   echo <<<EOT
     <div id="poststatus">
       <div id="postact">
           <ul>
               <li class="">&nbsp;<span class="glyphicon glyphicon-pencil"></span> Postavi status&nbsp;</li>
               <li>&nbsp;<span class="glyphicon glyphicon-picture"></span> Postavi Sliku&nbsp;</li>
               <li> &nbsp; <span class="glyphicon glyphicon-facetime-video"></span> Video&nbsp;</li>
           </ul>
       </div>
            <div class="clear"></div>
       <div id="postcontentareas">
                <div style="float:left;" id="postslika"><img width="50px" src="{$slika}" alt=""></div>

                <form method="POST" action="">
                <textarea id="status_area" placeholder="O cemu razmisljas jarane" name="poststatus" style="float: left;" rows="4" cols="40"></textarea>
                        <input class="post_dugme pull-right" type="submit" name="postavistatus">
                </form>
                <div class="clear"></div>


            </div>
        </div>
EOT;
    if(isset($_POST['postavistatus'])){
        $conntent=$_POST['poststatus'];
        $email=$_SESSION['email'];
        $id= $users->get_id($email);

        $query_ins="INSERT INTO posts (`$type`,`content`) VALUES ('$id','$conntent')";
        $db->insert($query_ins);
    }
}
    public function delete_post($user_id, $author_id, $post_id,$db,$type,$rola)
    {
        if ($user_id === $author_id && $type==='author' || $rola>=2) {
            echo "<div class='dellstatus pull-right'><a href='index.php?delete={$post_id}'>Obrisi</a></div>";
            if (isset($_GET['delete'])) {
                $id= $_GET['delete'];
                $db->delete("DELETE FROM posts WHERE id={$id}");
                header("Location: index.php");

            }
        }


    }
    public function delete_post_group($db,$group_admin,$post_id)
    {
        //brisanje posta za grupu/stranicu
        if ($group_admin>1) {
            echo "<div class='dellstatus pull-right'><a href='index.php?delete={$post_id}'>Obrisi</a></div>";
            if (isset($_GET['delete'])) {
                $id= $_GET['delete'];
                $db->delete("DELETE FROM posts WHERE id={$id}");
                header("Location: index.php");

            }
        }


    }

  public function like($db,$liker){
      //unos lajka
      if(isset($_GET['like'])){
          $post_like= $_GET['like'];
          $db->insert("INSERT INTO likes (`post_id`,`lajker_id`) VALUES ('$post_like','$liker')");
          header("location:index.php");
          }

  }
    public function unlike($db,$unliker){
//sklanjanje lika unlike
            if(isset($_GET['unlike'])){
                $post_unlike= $_GET['unlike'];
                $db->delete("DELETE FROM likes WHERE post_id='$post_unlike' AND lajker_id='$unliker'");
            }
    }
    public function getnumlike($db,$post_id){
        //Broj lajkova za post
        $lajkovi=$db->select("SELECT * FROM likes WHERE post_id='$post_id'");
        if($lajkovi !== false) {
            $brojlajkova = $lajkovi->num_rows;
            if ($brojlajkova > 0) {
                return $brojlajkova;
            }
        }else{
            $brojlajkova=0;
            return $brojlajkova;
        }
    }
    private function provera_lajka($db,$post_id,$author_id){
        //proveravam dal je status lajkovan vec
        $lajkovi = $db->select("SELECT * FROM likes WHERE post_id='$post_id' AND lajker_id='$author_id'");
        if($lajkovi){
            return true;
        }else{
            return false;
        }
    }
    public function ispis_lajka($db,$post_id,$author_id)
    {
        //ispisivanje stanja lajka,malo ajaxa.
        if ($this->provera_lajka($db,$post_id,$author_id) == true){
            echo <<<EOT
            <li id="liker{$post_id}"><a id='unlike{$post_id}' ><span class='glyphicon glyphicon-thumbs-up
\'></span>&nbsp;Unlike</a></li>

<script>
$('#liker{$post_id}').click(function(){
$.ajax({
  method: "GET",
  url: "index.php?unlike={$post_id}"
});
var nolike=$('#numlike{$post_id}').text();
nolike--;
$('#numlike{$post_id}').text(nolike);
$('#liker{$post_id}').html("<a style='cursor:default;text-decoration:none;' href='javascript:void(0);'><span class='glyphicon glyphicon-thumbs-up'></span>Unliked</a>");

{$this->provera_lajka($db,$post_id,$author_id)}

})
</script>

EOT;
    }         else{
            $numlike=$this->getnumlike($db,$post_id);
echo <<<EOT
<li id="liker{$post_id}"><a id='like{$post_id}' ><span class='glyphicon glyphicon-thumbs-up
\'></span>&nbsp;Like</a></li>
EOT;
echo <<<EOT
<script>
$('#like{$post_id}').click(function(){
$.ajax({
  method: "GET",
  url: "index.php?like={$post_id}"
});
var nolike=$('#numlike{$post_id}').text();
nolike++;
$('#numlike{$post_id}').text(nolike);
$('#liker{$post_id}').html("<a style='cursor:default; text-decoration:none;' href='javascript:void(0);'><span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;Liked</a>");
{$this->provera_lajka($db,$post_id,$author_id)}
})
</script>
EOT;

           /* echo "<li id='like'><a href='index.php?like={$post_id}' onclick='window.location.replace(`index.php?like={$post_id}`);
'><span class='glyphicon glyphicon-thumbs-up
\'></span>&nbsp;Lajkuj</a></li>";*/
        }


    }

}
?>