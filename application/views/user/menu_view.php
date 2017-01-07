    <!-- Fixed navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?=ACRONYM;?></a>
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active" id="start" data-toggle="tooltip" title="Inicio"><a href="<?php echo base_url();?>sign_in/"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
            
            <ul class="nav navbar-nav">              
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Men&uacute;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li id="request" data-toggle="tooltip" title="Mis solicitudes"><a href="<?php echo base_url();?>request/"><i class="fa fa-inbox" aria-hidden="true"></i> Solicitudes</a></li>
                <li id="absent" data-toggle="tooltip" title="Mis inasistencias"><a href="<?php echo base_url();?>absent/"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Inasistencias</a></li>
                <li id="evaluation" data-toggle="tooltip" title="Mis ex&aacute;menes"><a href="<?php echo base_url();?>evaluation/"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ex&aacute;menes</a></li>
              </ul>
            </li>
            </ul>

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
                <li><a href="<?php echo base_url();?>user/my_data" title="Configuraci&oacute;n de mis datos"><i class="fa fa-briefcase" aria-hidden="true"></i> Mis datos</a></li>
                <li><a href="#" title="Configuraci&oacute;n de la contrase&ntilde;a de usuario"><i class="fa fa-unlock" aria-hidden="true"></i> Cambiar contrase&ntilde;a</a></li>
                <li><a href="<?php echo base_url();?>sign_in/close_session" title="Cerrar la sesi&oacute;n actual"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesi&oacute;n</a></li>                
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>