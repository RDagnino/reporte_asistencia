<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Reporte de Asistencia
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reporte</li>
      </ol>
    </section>
    
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Consulta de Asistencias por Fecha</h3>
                            <div class="box-tools pull-right">
                            </div>
                    </div>
                    <div class="box-body">
                      
                      <form method="POST" action="rptasistencia_fechas.php">
                        <input type="date" name="f1" required>
                        <input type="date" name="f2" requited>
                        <input type="submit">
                      </form>
                      <div class="text-right mb-2">
                        <a href="fpdf/ReporteAsistencia.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i>Generar Reportes</a>
                      </div>
                      <table id="example1" class="table table-bordered"></br>
                        <thead>
                          <th class="hidden"></th>
                          <th>Fecha</th>
                          <th>ID Empleado</th>
                          <th>Nombre y Apellido</th>
                          <th>Hora Entrada</th>
                          <th>Hora Salida</th>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC ";
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){
                              $status = ($row['status'])?'<span class="label label-warning pull-right">a tiempo</span>':'<span class="label label-danger pull-right">tarde</span>';
                              echo "
                                <tr>
                                  <td class='hidden'></td>
                                  <td>".date('M d, Y', strtotime($row['date']))."</td>
                                  <td>".$row['empid']."</td>
                                  <td>".$row['firstname'].' '.$row['lastname']."</td>
                                  <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                                  <td>".date('h:i A', strtotime($row['time_out']))."</td>
                                </tr>
                              ";
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>