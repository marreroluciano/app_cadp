    <!-- Fixed navbar -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <!--<a class="navbar-brand" href="#">Project name</a>-->
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url();?>sign_in/"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
            <li><a href="#about">Solicitudes</a></li>
            <li><a href="#contact">Contacto</a></li>
            
          </ul>
          <!--
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>-->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> (<?=$this->session->userdata['user']; ?>) <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Mis datos</a></li>
                <li><a href="#">Cambiar contrase&ntilde;a</a></li>
                <li><a href="#">Cerrar Sesi&oacute;n</a></li>
                <!--<li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>-->
              </ul>
            </li>                        
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>