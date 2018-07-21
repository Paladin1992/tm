<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="images/logo.png" id="menu-logo"/>

            <h1>TM Mindenkinek</h1>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tm-navbar" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <!-- Menü
                <i class="fas fa-chevron-circle-down"></i> -->
            </button>
        </div>
    
        <div class="collapse navbar-collapse" id="tm-navbar">
            <ul class="nav navbar-nav">
                <?php
                    get_menu($site);
                ?>
            </ul>
        </div>
    </div>
</nav>