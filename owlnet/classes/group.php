<?php
class group{
    //klasa za rad sa grupom/stranicom
    public function get_info_group($db,$id){
        //saznajem sve o grupi na osnovu njenog id-a
        $query="SELECT * FROM groups WHERE id='$id'";
        $result=$db->select($query);
        $result=mysqli_fetch_object($result);
        return $result;
    }
    public function get_info_groups($db){
        //uzimam sve informacije o grupama bez fetchovanja
        $query="SELECT * FROM groups";
        $result=$db->select($query);
        return $result;
    }
private function all_group_id($db){
    //id-evi svih grupa
    $groups_id=$this->get_info_groups($db);
    while($arrid=mysqli_fetch_object($groups_id)){
        $array_id[]=$arrid->id;
    }
    return $array_id;

}

    public function test_id_group($db, $id)
    {
$arr_id=$this->all_group_id($db);
        if(in_array($id,$arr_id)){
            return true;
        }
        else{
            return false;
        }
        }
    public function group_role_test($db,$gid,$id){
        //provera dal user ima neki status u grupi
        $query="SELECT * FROM groups_role WHERE user_id='$id' AND group_id='$gid'";
        $res=$db->select($query);
        if($res) {
            $result = mysqli_fetch_object($res);
            $user_role = $result->group_role;
            return $user_role;
        }


    }


}
