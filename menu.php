<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tm-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
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