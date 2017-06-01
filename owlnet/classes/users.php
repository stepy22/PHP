
<?php
//klasa users, koja radi sa korisnicima, od validacije formatiranja, do vadjenja podataka na odredjeni nacin za jednog il vise njih
?>

<?php class users {
    //reg error property je property u koji se smestaju eventualne greske prilikom registracije
    public $reg_error;

    private function test_paswords($pasword,$pasword2)
    {
        //test_password metoda je metoda kojom proveravam dal je pasword validno unet
        if ($pasword == "") {
            return $this->reg_error .= "Nedostaje password<br>";


        } elseif(strlen($pasword) <7){
            return $this->reg_error .= "Pasword mora imati minimum 7 karaktera";

        }
        else {
            if ($pasword !== $pasword2) {
                return $this->reg_error .= "Paswordi se ne poklapaju";
            }
        }
    }
    private function test_imeprezime($ime,$prezime){
        //provera dal su pravilno uneti Ime i prezime
       if($ime =="" || $prezime == "" || strlen($ime)<3 || strlen($prezime)<5){
           return $this->reg_error .= "Unesite validno ime i prezime";
       }
    }
    public function formatiranje_datuma_rodjenja($dan,$mesec,$godina){
        //formatiram datum rodjenja na registraciji
        $datum_rodjenja=$dan ."/".$mesec."/". $godina;
        return $datum_rodjenja;

    }

    private function mail_validation($email){
        //provera unetog maila, dal postoji mail i dal je u dobrom formatu nesto@mail.com
        if(empty($email)){

            return $this->reg_error.="Nedostaje email ";

        }else{
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

            return $this->reg_error.='Unesite validnu email adresu<br>';

            }else{
                return false;
            }

        }

    }
    public function reg_user($db,$ime,$prezime,$email,$password,$password2,$bday,$pol,$sesija){
        //Metoda koja rukuje registracijom, poziva prethodne private, kasnije testira reg error property i u slucaju da nema gresaka vrsi registraciju
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->mail_validation($email);
            $this->test_paswords($password,$password2);
            $this->test_imeprezime($ime, $prezime);
            $profilpic="images/owl".rand(1,10).".jpg";
            if($this->reg_error == NULL) {
                $ime = mysqli_real_escape_string($db->link, $ime);
                $email = mysqli_real_escape_string($db->link, $email);
                $password = mysqli_real_escape_string($db->link, $password);
                $password=md5($password);
                $query    = "INSERT INTO users (ime, prezime, email,sifra,datum_rodjenja,pol,slika) VALUES ('$ime','$prezime','$email','$password','$bday','$pol','$profilpic')";                                        // upit ka bazi
                $user     = $db->insert($query);
                if($user){
                    $sesija->setujem_sesiju('email',$email);
                    header("Location: index.php");
                }



            }else{
                //Malo javascripta, ovim prikazujemo div sa greskama i unesomimo mu greske
                echo <<<EOT
<script>
$('#greske').css("display","block")
$('#greske').html('{$this->reg_error}');
</script>
EOT;

            }

        }
    }

    public function get_id($email) {
        //Uzimam id samo uz pomoc maila
        $db= new Database();
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result=$db->select($query);
        $row = mysqli_fetch_object($result);
        return $row->id;

    }
   public function get_author($author_id,$db){
       //saznajem id uz pomoc podatka koji se odnosi na autora posta
       $query = "SELECT * FROM users WHERE id = '$author_id'";
       $result=$db->select($query);
       $row = mysqli_fetch_object($result);
       return $row;
   }
public function get_info_current_user($db,$id=null){
    //saznajem informacije o trenutnom useru, u jednom slucaju mi treba da to bude preko maila dok u drugom preko id-a
    if(!isset($id)) {
        $sesionmail = $_SESSION['email'];
    }else{
    $sesionmail="";}
    $query = "SELECT * FROM users WHERE email = '$sesionmail' OR id='$id'";
    $result=$db->select($query);
    $result=mysqli_fetch_object($result);
    return $result;
}
    //klase vezane za profil page
    public function get_info_all_user($db){
//uzimam sve korisnike
        $query = "SELECT * FROM users";
        $result=$db->select($query);
        return $result;
    }
    private function all_users_id($db){
        //uzimam sve id i smestam ih u niz
        $users_id=$this->get_info_all_user($db);
        while($arrid=mysqli_fetch_object($users_id)){
            $array_id[]=$arrid->id;
        }
        return $array_id;

    }
    public function test_id_users($db,$id)
    {
        //testiram dal je unet id nekog od korisnika tj dal postoji korisnik sa tim id
        $arr_id=$this->all_users_id($db);
        if(in_array($id,$arr_id)){
            return true;
        }
        else{
            return false;
        }
    }


}