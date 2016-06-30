    <!-- Fixed navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <a class="navbar-brand" href="#">CADP</a>
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active" id="start"><a href="<?php echo base_url();?>sign_in/" title="Inicio"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
            <li id="request"><a href="<?php echo base_url();?>request/" title="Solicitudes"><i class="fa fa-inbox" aria-hidden="true"></i> Solicitudes</a></li>
            <li id="contact"><a href="#contact"><i class="fa fa-envelope" aria-hidden="true"></i> Contacto</a></li>            
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
                <li><a href="#" title="Configuraci&oacute;n de mis datos"><i class="fa fa-briefcase" aria-hidden="true"></i> Mis datos</a></li>
                <li><a href="#" title="Configuraci&oacute;n de la contrase&ntilde;a de usuario"><i class="fa fa-unlock" aria-hidden="true"></i> Cambiar contrase&ntilde;a</a></li>
                <li><a href="<?php echo base_url();?>sign_in/close_session" title="Cerrar la sesi&oacute;n actual"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesi&oacute;n</a></li>
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