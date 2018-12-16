<?php $loggedInUserDetail = getLoggedInUserDetail(); ?>
<nav class="navbar navbar-light navbar-expand-md navigation-clean-search shadow-sm p-3 bg-white rounded">
    <div class="container"><a class="navbar-brand" href="<?php echo base_url('home'); ?>">Distance Learning App</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
             id="navcol-1">
            <form class="form-inline mr-auto" target="_self">
                <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input
                            class="form-control search-field" type="search" name="search" id="search-field"></div>
            </form>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false" href="#">
                        <i class="fa fa-user small-icon"></i>
                        <?php echo $loggedInUserDetail['firstname'] . ' ' . $loggedInUserDetail['lastname']; ?>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item nav-link" role="presentation" href="#">Account Settings</a>
                        <a class="dropdown-item nav-link" role="presentation"
                           href="<?php echo base_url('logout/'); ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
