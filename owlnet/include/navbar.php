<?php
//Navigacija sa dodatkom nekih instaciranih objekata, koriscen je bootstrap koji je preradjen, nije responsive
$group= new group;
$rola=$users->get_info_current_user($db)->role;
?>

<nav class="navbar navbar-inverse  nav-overa">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="marg-left nav navbar-nav ">
                <li><a class="logo-nav-a" href="#"><img height="20px" width="26px"src="images/logo.png" alt=""></a></li>
                <li><span class="logo-nav"> <a style="color:white; text-decoration: none" href="index.php">OwlNet</a></span></li>

                <li>
                    <a style="padding-left: 24px !important;" class=".icon-marg-lef" href="#"><i class="material-icons">&#xe7ef;</i>

                    </a>

                </li>
                <li><a  href="#"><i class="material-icons">&#xe0bf;</i></a></li>
                <li ><a  href="#"><i class="material-icons">&#xe7f4;</i></a></li>

            </ul>
            <div class=" col-sm-3 col-md-3">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="searchbox form-control" placeholder="Search" name="q">
                        <div class="input-group-btn">
                            <button class="search-but btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a style="padding-top:5 !important; padding-right:4px;" href="#"><span><img height="30px" width="30px" src="<?php echo $users->get_info_current_user($db)->slika; ?>" alt=""></a></li>
                <li><a style="padding-left:0px !important;" href="profile.php"<span class=""><?php echo $users->get_info_current_user($db)->ime;?></span> <span  ><?php echo $users->get_info_current_user($db)->prezime; ?></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">| Action<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </li>            </ul>
        </div>
    </div>
</nav><div class="clear">

</div>
