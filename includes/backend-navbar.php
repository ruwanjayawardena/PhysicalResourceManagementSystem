<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand hvr-backward" href="#" onclick="goDashboard();">
        <!--<img src="../assets/img/logo/SmallLogo-transperent.png" width="50" height="50" class="d-inline-block img-logo" alt="">-->
        <span class="logoText text-uppercase">
            <?php
            if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
                if ($_SESSION['usr_is_superadmin'] == 1) {
                    //super admin
                    echo "Super Administrator Dashboard";
                } else if ($_SESSION['usr_is_superadmin'] == 0) {
                    //model - defined user category
                    echo "System Administrator Dashboard";
                }
            }
            ?>
        </span>     
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#" onclick="goDashboard();"><i class="fas fa-home fa-lg"></i> Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <span class="navbar-text mr-right">            
            <i class="fas fa-user-circle fa-inverse fa-lg"></i> Welcome,
            <?php
            if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
                echo $_SESSION['usr_name'];
            }
            ?>
            <button class="btn btn-dark logout">Log out</button>
        </span>
    </div>
</nav>

