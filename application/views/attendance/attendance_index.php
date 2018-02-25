              
              <style type="text/css">
                @media print {
    .with_print {
        display: none;
    }
}
              </style>
<section class="content" id="att">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Attendance</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="form-group" style="padding-left:20px;padding-right:20px; padding-top: 20px;">
                  <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select name="class" id="selectClass" class="form-control select2" data-placeholder="Select Class" style="width: 100%;">   
                      <?php foreach($class as $c):?>
                        <option><?php echo $c->classcode . "|" . $c->classdes?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>  
                <div class="row with_print " style="margin-left: 5px;"> 
               <div class="form-group col-md-5"  style="padding-left:20px;padding-right:20px; " >
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right with_print" id="datepicker">
                  </div>
                </div>   
                <div class="form-group col-md-5" style="padding-left:20px;padding-right:20px; "   >
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  class="form-control pull-right with_print" id="datepicker2">
                  </div>
                </div>  
                <div class="col-md-1" style="padding-left:20px;padding-right:20px; "  >
                 <button class="btn btn-primary with_print"  id="" onclick="getDate();">GO</button> 
                 </div>
                </div>
                
                 
                 

            <table id="teacher-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NAME</th>
                    <?php for($a=0;$a<sizeof($dates);$a++){?>
                      <th><?php echo $dates[$a]; ?></th>
                    <?php }?>

                </tr>
                </thead>
                <tbody>
                <?php for($b=0;$b<sizeof($names);$b++){?>
                <tr>
                    <td><?php echo $names[$b];?></td>

                    <?php for($c=0;$c<sizeof(${"student".($b+1)});$c++){?>
                      <td><?php echo ${"student".($b+1)}[$c];?></td>
                    <?php } ?>
                    </tr>
                <?php } ?>
               
                </tbody>
                <tfoot>
                <tr>
                  <th>NAME</th>
                    <?php for($a=0;$a<sizeof($dates);$a++){?>
                     <th><?php echo $dates[$a]; ?></th>
                    <?php } ?>
                </tr>
                </tfoot>
              </table>

              </div>
              </div>

              <button class="btn btn-primary with_print" style="float: right;"  id="" onclick="get_print();">PRINT</button> 
              </section>