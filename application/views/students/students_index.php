   
<?php $name=$this->session->userdata['logged_in']['name'];?>
<?php $username=$this->session->userdata['logged_in']['username'];?>
<?php $createdby=$username ."|" . $name; ?>
	
	 
	<section class="content" id="stud">
	<button class="btn btn-success" style="float: left;" onclick="showStudentModal('add');">Add New Student</button><br><br>
     <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                    <select id="class" class="form-control select2" data-placeholder="Select Class" onchange="changeContents();" style="width: 100%;">   

                    <?php $a=0; foreach($classes as $c):?>
                    <?php $_class=$c->classcode . "|".$c->classdes;?>
                    <?php if (!isset($curclass)):?>
                    <?php if($a==0){?>                
                      <option selected=""><?php echo $c->classcode?>|<?php echo $c->classdes?></option>
                      <?php } else{?>
                       <option ><?php echo $c->classcode?>|<?php echo $c->classdes?></option>
                      <?php }?>
                    <?php else:?>
                      <?php if($_class == $curclass){ ?>
                        <option selected=""><?php echo $c->classcode?>|<?php echo $c->classdes?></option>
                      <?php } else{?>
                       <option ><?php echo $c->classcode?>|<?php echo $c->classdes?></option>
                      <?php }?>
                    <?php endif;?>
                    <?php $a++; endforeach; ?>
                </select>
                  </div>
                </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="teacher-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $a=1;?>
                <?php foreach($students as $s):?>
                <tr>
                  <td><?php echo $s->sID;?></td>
                  <td><?php echo $s->sname;?></td>
                  <td align='center'>
                    <button class="btn btn-primary" id="<?php echo $s->cid;?>" onclick="showStudentModal('edit',this.id);">Edit</button>
                    <button class="btn btn-danger"  id="<?php echo $s->cid?>" onclick="ConfirmDeleteStudent(this.id);">Delete</button>
                  </td>
                </tr>
                <?php $a++;?>
              <?php endforeach;?>
               
                </tbody>
                <tfoot>
                <tr>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->

          </div>

 <button type="button" style="display:none;" class="btn btn-default" id="student-modal" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Student</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="sname" class="form-control" placeholder="Student Name: FN, MI, LN">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="sid" class="form-control" placeholder="Student ID: XX-XXX-XXX">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <select id="selectClass" class="form-control select2" multiple="multiple" data-placeholder="Select Class" style="width: 100%;">   

                  </select>
                  </div>
                </div>


                <div>
                  <p class="text-red" style="display:none;" id="error"></p>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="save" onclick="validateStudents();" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                 <button type="button" style="display:none;" class="btn btn-default" id="student-delete-modal" data-toggle="modal" data-target="#modal-delete">
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
              <h2>Are you sure you want to delete this student?</h2>
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
          <script>
  $(function () {
    $('.select2').select2()
    $('#teacher-table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

</script>