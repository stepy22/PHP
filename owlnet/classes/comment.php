<?php
class comment{
    //klasa za rad sa  komentarima
    public function add_comm($db,$post_id,$author_id_com,$conntent_comm){
        //dodavanje komentara
        if(isset($_POST['posaljikom'.$post_id]) && isset($conntent_comm)){
            $query_ins="INSERT INTO comments (`post_id`,`com_author`,`com_cont`) VALUES ('$post_id','$author_id_com','$conntent_comm')";
            $res=$db->insert($query_ins);

        }
    }

    public function comm_view($db,$post_id,$users,$author_id)
    {
        //prikaz komentara
        $query = "SELECT * FROM comments WHERE post_id ='$post_id' ORDER BY id DESC";
        $result = $db->select($query);
        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $user_author = $users->get_author($row->com_author, $db);
                $dateTime = new DateTime($row->time);
                $trenutni_user_id=$users->get_id($_SESSION['email']);
                $com_author_id=$user_author->id;
                $com_id=$row->id;
                echo <<<EOT
        <div class="comment">
                            {$this->delete_comment($trenutni_user_id,$author_id,$com_author_id,$com_id,$db)}
         <div class=" podatci_autora">
                    <div class="podautora"><img style="float: left;" src="{$user_author->slika}" height="34px" width="34px" alt="">
                        <div class="ime_prezime">
                            <a href="">{$user_author->ime}&nbsp;{$user_author->prezime}</a>
</div>

                        <div class="datum_statusa">


                       {$dateTime->format('j.n.y G:j')}

                        </div>
                    </div>


                    <div class="clear"></div>
                </div>
                                        <div class="sadrzajcoma">{$row->com_cont} </div> </div>


EOT;

            }
        }
    }
public function delete_comment($user_id, $post_author_id,$com_author_id, $com_id,$db){
    //brisanje komentara
    if ($user_id === $post_author_id || $user_id === $com_author_id ){
        echo "<div class='pull-right' style='margin-top:5px'><a href='index.php?com_delete={$com_id}'>Obrisi</a></div>";
        if (isset($_GET['com_delete'])) {
            $id= $_GET['com_delete'];
            $db->delete("DELETE FROM comments WHERE id='$id'");
            header("Location: index.php");

        }

}}


}