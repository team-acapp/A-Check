<?php $type=$this->session->userdata['logged_in']['type'];?>
<?php $name=$this->session->userdata['logged_in']['name'];?>
    <section class="content" id="_class">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Classes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="teacher-table" class="table table-bordered table-striped">
			  <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
                    <select id="sem2" class="form-control select2" onchange="getClassViaSem('<?php echo $type;?>');"  data-placeholder="Select Class Days"
                        style="width: 100%;">
                  <option>1st Sem</option>
                  <option>2nd Sem</option>
                </select>
                  </div>
                </div>
				<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check-square-o"></i></span>
                    <select id="year2" class="form-control select2" onchange="getClassViaYear('<?php echo $type;?>');" data-placeholder="Select Class Days"
                        style="width: 100%;">     
				  <option>2017</option>
				  <option>2018</option>
                  <option>2019</option>
				  <option>2020</option>
                </select>
                  </div>
                </div>
                <thead>
                <tr>
                  <th>Class Code</th>
                  <th>Class Name</th>
                  <th>Day</th>
                  <th>Start Time</th>
                  <th>End Time</th>
				  <th>Semester</th>
				  <th>Year</th>
                  <th>Teacher</th>
                  <th>Action</th>
				 
                </tr>
                </thead>
                <tbody id="tbody">
                <?php $a=1;?>
                <?php foreach($class as $t):?>
                <tr>
                  <td><?php echo $t->classcode;?></td>
                  <td><?php echo $t->classdes;?></td>
                  <td><?php echo $t->day;?></td>
                  <td><?php echo $t->time;?></td>
                  <td><?php echo $t->time2;?></td>
				  <td><?php echo $t->sem;?></td>
				  <td><?php echo $t->year;?></td>
                  <td><?php echo $t->createdby;?></td>
                  <td align='center'>
                    <button class="btn btn-primary" id="<?php echo $t->classid;?>" onclick="showClassModal('edit',this.id,'<?php echo $type;?>');">Edit</button>
                    <button class="btn btn-danger"  id="<?php echo $t->classid?>" onclick="ConfirmDeleteClass(this.id);">Delete</button>
                  </td>
                </tr>
                <?php $a++;?>
              <?php endforeach;?>
               
                </tbody>
                <tfoot>
                <tr>
                  <th>Class Code</th>
                  <th>Class Name</th>
                  <th>Day</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Teacher</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->

          </div>

           <button class="btn btn-success" style="float: right;" onclick="showClassModal('add','','<?php echo $type;?>','<?php echo $name;?>');">Add New Class</button>

            <button type="button" style="display:none;"  class="btn btn-default" id="class-modal" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CLASS</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                    <input type="text" id="classCode" class="form-control" placeholder="Class Code">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                    <input type="text" id="className" class="form-control" placeholder="Class Description">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-calendar-o"></i></span>
                    <select id="day" class="form-control select2" multiple="multiple" data-placeholder="Select Class Days"
                        style="width: 100%;">
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
                  <option>Saturday</option>
                  <option>Sunday</option>
                </select>
                  </div>
                </div>
				 <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
                    <select id="sem" class="form-control select2"  data-placeholder="Select Class Days"
                        style="width: 100%;">
                  <option>1st Sem</option>
                  <option>2nd Sem</option>
                </select>
                  </div>
                </div>
				<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check-square-o"></i></span>
                    <select id="year" class="form-control select2"  data-placeholder="Select Class Days"
                        style="width: 100%;">   
                  <option>2017</option>
				  <option>2018</option>
				  <option>2019</option>
				  <option>2020</option>
                </select>
                  </div>
                </div>

                <?php if($type =="admin"):?>
                                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                    <select id="teacher" class="form-control select2" data-placeholder="Select Teacher" style="width: 100%;">   

                </select>
                  </div>
                </div>
              <?php else:?>
                  <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                     <input type="text" id="teacher" class="form-control" placeholder="Teacher" disabled="">
                  </div>
                </div>
              <?php endif;?>
                <div class="form-group">
                <label>FROM: </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-clock-o"></i></span>
                    <input type="time" id="timeIn" class="form-control" placeholder="Start Time">
                  </div>
                </div>

                   <div class="form-group">
                   <label>TO: </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <input type="time" id="timeOut" class="form-control" placeholder="End Time">
                  </div>
                </div>




                <div>
                  <p class="text-red" style="display:none;" id="error"></p>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="save" onclick="validateClasses();" class="btn btn-primary">Save Changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

         <button type="button" style="display:none;" class="btn btn-default" id="teacher-delete-modal" data-toggle="modal" data-target="#modal-delete">
                Launch Default Modal
              </button>
        <div class="modal fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Deletion</h4>
              </div>
              <div class="modal-body">               
              <h2>Are you sure you want to delete this class?</h2>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="delete" class="btn btn-primary">Confirm</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

          </section>