
<div class="col-md-4 no-print">
    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Upcoming Event(s)</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa  fa-calendar margin-r-5"></i> P.T.A Meeting</strong>

        <p class="text-muted">
          There will be a general P.T.A meeting.
        </p>
        <strong><i class="fa fa-calendar-o margin-r-5"></i> Date</strong>
        <p class="text-muted">2018-08-14 </p>
        
        <strong><i class="fa fa-clock-o margin-r-5"></i> Time</strong>
        <p class="text-muted">9 am </p>
        
        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

        <p class="text-muted">School Premises</p>

        <hr>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    
    <!-- About Me Box -->
    <div class="box box-danger">
      <div class="box-header with-border">
          <h3 class="box-title">Statistics</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul class="nav nav-stacked">
            <li><a>Students <span class="pull-right badge bg-blue"><?php echo $schooladmin->getTotalStudent($conn,$school_id);?></span></a></li>
            <li><a>Staffs <span class="pull-right badge bg-aqua">0</span></a></li>
            <li><a>JSS 1 <span class="pull-right badge bg-green"><?php echo $schooladmin->getTotalStudent1($conn,$school_id);?></span></a></li>
            <li><a>JSS 2 <span class="pull-right badge bg-red"><?php echo $schooladmin->getTotalStudent2($conn,$school_id);?></span></a></li>
            <li><a>JSS 3 <span class="pull-right badge bg-green"><?php echo $schooladmin->getTotalStudent3($conn,$school_id);?></span></a></li>
            <li><a>SSS 1 <span class="pull-right badge bg-red"><?php echo $schooladmin->getTotalStudent4_14($conn,$school_id);?></span></a></li>
            <li><a>SSS 2 <span class="pull-right badge bg-green"><?php echo $schooladmin->getTotalStudent5($conn,$school_id);?></span></a></li>
            <li><a>SSS 3 <span class="pull-right badge bg-red"><?php echo $schooladmin->getTotalStudent6($conn,$school_id);?></span></a></li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Carousel</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

              <div class="carousel-caption">
                First Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

              <div class="carousel-caption">
                Second Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

              <div class="carousel-caption">
                Third Slide
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box --> 
    <!-- NEWS DROPPABLE--->
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">News Headlines</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a Great Divine Gift wins state debate
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        School Management extends Fees Deadline...
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      <!-- NEWS DROPPABLE--->
</div>