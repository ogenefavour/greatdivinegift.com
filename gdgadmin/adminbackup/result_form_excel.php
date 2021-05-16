<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Fixed Layout
      <small>Blank example to the fixed layout</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Fixed</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Download Result Excel Form</h3>
                </div>
                <div class="box-body">
                    <?php if(!empty($message)){echo $message;}?>
                    <div class="row">
                        <div class="col-md-7">
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form id="form1" action="" enctype="multipart/form-data" method="POST" data-parsley-validate>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-excel-o"></i></span>
                                            <select  id="classId" onchange="resultDownload()" name="class" class="form-control" required>
                                                <option value="">Select Class</option>
                                                <?php 
                                                $sql = "SELECT * FROM class";
                                                $result = mysqli_query($conn, $sql);
                                                while($row=  mysqli_fetch_assoc($result)){
                                                    $classid = $row['class_id'];
                                                    $class = $row['class'];
                                                ?>
                                                <option value="<?php echo $classid?>"><?php echo $class?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        
                                        </div><br>
                                    </form>
                                    <div class="box-footer pull-right" id="d_button"> 
                                        <a href="uploads/SSS1A_result.xlsx" download><button type="submit" class="btn btn-success pull-right sr-only"><b><i class="fa fa-file-excel-o"></i> Download</b></button></a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="callout callout-info">
                                <h4>Tips!</h4>
                                <p> Select the class of the result excel sheet you want to download. Then click on the displayed download button to download Be careful so you do not update scores on the wrong class.
                                    <i class="text-maroon"><b>Once you are done adding the scores, Upload the result excel sheet from the Upload Result Page</b></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--===============right side bar===================-->
        <?php include 'rightside.php';?>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

    <?php
    include 'footer.php';
    ?>
    <script>
        function resultDownload(){
            var classtatus = 1;
            var classid = $("#classId").val();
            $.ajax({
                type: "POST",
                url: "admin_ajax.php",
                data: 'classid='+classid+'&classtatus='+classtatus,
                success: function(data){
                    $("#d_button").html(data); 
                    //$("#jss1").removeClass('sr-only'); 
                }
            });
        }
    </script>
    </body>
</html>
