         


    <!-- Main content -->
    <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Teachers' Account</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="teacher-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $a=1;?>
                <?php foreach($teachers as $t):?>
                <tr>
                  <td><?php echo $t->name;?></td>
                  <td><?php echo $t->username;?></td>
                  <td><?php echo $t->email;?></td>
                  <td align='center'>
                    <button class="btn btn-primary" id="<?php echo $t->id;?>" onclick="showTeacherModal('edit',this.id);">Edit</button>
                    <button class="btn btn-danger"  id="<?php echo $t->id?>" onclick="ConfirmDeleteTeacher(this.id);">Delete</button>
                  </td>
                </tr>
                <?php $a++;?>
              <?php endforeach;?>
               
                </tbody>
                <tfoot>
                <tr>
                   <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->

          </div>
 <button class="btn btn-success" style="float: right;" onclick="showTeacherModal('add');">Add New Teacher</button>

 <button type="button" style="display:none;" class="btn btn-default" id="teacher-modal" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Account</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" class="form-control" placeholder="Name: FN, MI, LN">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="username" class="form-control" placeholder="Username">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" class="form-control" placeholder="Password">
                  </div>
                </div>
                  <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="confirm" class="form-control" placeholder="Confirm Password">
                  </div>
                </div>

                <div>
                  <p class="text-red" style="display:none;" id="error"></p>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="save" onclick="validateTeachers();" class="btn btn-primary">Save changes</button>
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
              <h2>Are you sure you want to delete this teacher?</h2>
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