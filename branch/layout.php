<?php

    $head_tags =
    '
        <link rel="icon" href="../assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32"> 
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
        <!-- Template CSS -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/components.css">
        <link rel="stylesheet" href="../assets/css/google.css">
    
    ';

    $nav_bar =
    '
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, '.$branch_name_session.'</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="logout" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    ';

    $side_bar =
    '
        <div class="main-sidebar">
            <aside id="sidebar-wrapper" style="margin-top: 39px">
                <div class="sidebar-brand">
                    <a href="./">
                        <img src="../assets/img/diva-logo-sm.png" alt="diva lounge spa logo" height="85">
                    </a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="./">
                        <img src="../assets/img/diva-logo-sm.png" alt="diva lounge spa logo" width="50">
                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header" style="margin-bottom: 50px"></li>
                    <li class="dashboard"><a class="nav-link" href="dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                    <li class="all_customers"><a class="nav-link" href="all_customers"><i class="fas fa-smile"></i><span>All Customers</span></a></li>
                    <li class="customers"><a class="nav-link" href="customers"><i class="fas fa-smile"></i><span>Add Customer</span></a></li>
                    <li class="links"><a class="nav-link" href="links"><i class="fas fa-link"></i><span>All Links</span></a></li>
                    <li class="ex_customer_form"><a class="nav-link" href="ex_customer_form"><i class="fas fa-link"></i><span>Create Link</span></a></li>
                </ul>
            </aside>
        </div>
    ';

    $footer =
    '
        <footer class="main-footer">
            <div class="footer-left">
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> Diva Lounge Spa | Designed by <a href="https://tecizasolutions.com/" target="_blank">Teciza Solution</a> & Powered by <a href="https://thegraphe.com" target="_blank">The Graphē - A Design Studio</a>
            </div>
        </footer>
        <div class="gt">
            <div class="gt__box">
                <div class="gt__select">
                    <div id="google_translate_element"></div>
                </div>
            </div>
        </div>
    ';


    $script_tags =
    '
        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        
        <!-- Template JS File -->
        <script src="../assets/js/scripts.js"></script>
        <script src="../assets/js/custom.js"></script>

        <!-- Google Translater -->
        <script src="../assets/js/google.js"></script>
    ';

?>