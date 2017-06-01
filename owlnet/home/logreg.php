
<body >
<div class="container">
    <div class=" loginlogo">
        <div class="logo">OwlNetwork</div>
    <div class=" login">
        <form method="post" action="login.php">
            <table>
                <tbody>
                <tr>
                    <td><label for="logmail">Unesite email adresu</label></td>
                    <td><label for="logpass">Unesite sifru</label></td></tr>
                <tr>
                    <td><input class="formlog" placeholder="`johnDue@email.com`" type="text" name="logmail"></td>
                    <td><input class="formlog" type="password" name="logpass"></td>
                    <td><label for="login"><input type="submit" name="login" id="loginbutton" value="Log In"></label></td></tr>
                <tr></tr>

<div id="greske" style="display: none" class="alert alert-danger"></div>

        </form> </tbody> </table></div>
        </div>
    <div class="clear">
        <div class="backgrad">
            <div class="clear"></div>
        <div class="content">
            <div class="logoregtext">
                <div id="Owltext">
    OwlNet je studentski projekat namenjen iskljucivo za potrebe zadatka i nema komercijalnu ulogu.
                    </div>
                <img style="margin-top:5px;" src="images/owlnetwork.png" alt="">
            </div>
            <div id="register">
                <h1>Registruj se</h1>
                <h4>Povezi se sa sovicama</h4>

                <form action="" method="post">
                <div class="form-group">
                    <input placeholder="unesite vase ime" type="text" class="form-control manjiinput" name="ime" id="ime" required>
                    <input placeholder="unesite vase prezime" type="text" class="form-control manjiinput" name="prezime" id="prezime" required>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <input placeholder="unesite vasu email adresu" type="text" class="veciinput form-control" name="regmail" required>
                    <input placeholder="unesite zeljenu lozinku" type="password" class="veciinput form-control" name="regpass" required>
                    <input placeholder="unesite lozinku opet" type="password" class="veciinput form-control" name="regpass2" required>
                    <h4>Vas datum rodjenja:</h4>
                    <select class="form-control" name="dayb" id="dayb">
                        <?php for($i=1;$i<=31;$i++){
    echo "<option value='{$i}'>{$i}</option>";
} ?> </select>
                        <select class="form-control" name="montb" id="montb">
                            <?php for($i=1;$i<=12;$i++){
                                echo "<option value='{$i}'>{$i}</option>";
                            } ?>
                        </select>
                    <select class="form-control" name="yearb" id="yearb">
                        <?php for($i=1921;$i<=2010;$i++){
                            echo "<option value='{$i}'>{$i}</option>";
                        } ?>
                    </select>
                    <div class="clear"></div>
                    <div class="form-group" id="pol">
                        <input type="radio" class="izbpol" name="pol" value="m" checked > <strong>Musko</strong>
                        <input type="radio" class="izbpol" name="pol" value="z"> <strong>Zensko</strong>
                    </div>


                </div>
                    <div id="ulosovipreporuka">
                        <p>
                            Molimo vas da ne koristite lozinku kao na facebook mrezi.Sajt je u pre beta fazi, i svaki pokusaj iskoriscavanja sigurnosnih propusta smatrace se hakerskim napadom.
                        </p>
                    </div>
                    <input class="form-control regsub" value="Registruj se" name="regsub" type="submit">
            </div>
          </form>
        </div>
        </div>
    </div>
</div>
<script src="js/javasc.js"></script>
<?php

if(isset($_POST['regsub'])){
    $dayb=$users->formatiranje_datuma_rodjenja($_POST['dayb'],$_POST['montb'],$_POST['yearb']);
    $pol=$_POST['pol'];
$users->reg_user($db,$_POST['ime'],$_POST['prezime'],$_POST['regmail'],$_POST['regpass'],$_POST['regpass2'],$dayb,$pol,$sesija); }?>
</body>
</html>

