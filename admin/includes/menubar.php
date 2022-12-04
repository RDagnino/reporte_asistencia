<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Barra de panel de usuario -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Modulos -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTES</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        <li><a href="infattendance.php"><i class="fa fa-circle-o"></i> <span> Informe mensual </span></a></li>
        
        <li class="header">ADMINISTRACIÓN</li>
        <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Lista de Empleados</a></li>

            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
          </ul>
        </li>
        
        <li><a href="position.php"><i class="fa fa-suitcase"></i> Cargos</a></li>
        <li class="header">IMPRIMIBLES</li>
        
        <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Horarios</span></a></li>
        <li><a href="rptasistencia.php"><i class="fa fa-file-text-o"></i> <span>Reporte</span></a></li>
      </ul>
    </section>
    
  </aside>