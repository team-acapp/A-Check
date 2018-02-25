
 <section class="content" id="stud">
 <?php echo form_open_multipart('module/do_upload');?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Upload Modules</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                          <table id="teacher-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>File Description</th>
                  <th>File Path</th>
                  <th>Class Code</th>

                </tr>
                </thead>
                <tbody>
                <?php $a=1;?>
                <?php foreach($uploads as $u):?>
                <tr>
                  <td><?php echo $u->filedesc;?></td>
                  <td><?php echo $u->filepath;?></td>
                  <td><?php echo $u->classcode;?></td>
                </tr>
                <?php $a++;?>
              <?php endforeach;?>
               
                </tbody>
                <tfoot>
                <tr>
                  <th>File Description</th>
                  <th>File Path</th>
                  <th>Class Code</th>
                </tr>
                </tfoot>
              </table>
                             <div class="form-group" style="padding-left:20px;padding-right:20px; padding-top: 20px;">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select name="class" id="selectClass" class="form-control select2" data-placeholder="Select Class" style="width: 100%;">   
                    	<?php foreach($class as $c):?>
                    		<option><?php echo $c->classcode . "|" . $c->classdes?></option>
                    	<?php endforeach;?>
                  	</select>
                  </div>
                </div>
                 <div class="form-group" style="padding-left:20px;padding-right:20px; ">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Filename / Note">
                  </div>
                </div>
                 <div class="form-group">
                <label></label>
                  <div class="input-group">
                    
<?php echo "<input type='file' name='userfile' size='20' />"; ?>
                  </div>
                </div>

<input type="submit" id="upload" style="" class="btn btn-primary">
<?php echo "</form>"?>
</div>
</div>

</section>

<script type="text/javascript">
	function reload()
	{
		window.location.assign('modules_index');
	}
</script>
