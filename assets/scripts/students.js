function showStudentModal(action,id,)
{
	console.log(id);
	if(action=="edit")
	{
		$('#selectClass')
      .find('option')
      .remove()
      .end()
      ;
      	$("#sid").val("");
		$("#sname").val("");
		$.ajax({
            type: "POST",
            url: "/Acapp/Students/editStudents",
            data: { 'id': id },
            success: function(data){
              console.log(data);
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {

                  var pre_class=d.classid;
                  var _class1=pre_class.split('*');
                  console.log(_class1);
                		$("#selectClass").val(_class1).trigger('change');
						        $("#sid").val(d.sID);
						        $("#sname").val(d.sname);
            
                         $('#save').attr('onclick','validateStudents('+id+')');
						selected=d.createdby;
                   		
                         
                });

                             $.ajax({
                        type: "POST",
                        url: "/Acapp/_Class/getAllClasses",
                        success: function(data){
                          console.log(data);
                            // Parse the returned json data
                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                            $.each(opts, function(i, d) {
                                var optClass=d.classcode + "|" + d.classdes;
                                
                                        $('#selectClass')
                              .append('<option>'+optClass+'</option>')
                              ;
       
                                     
                            });
                        }
                    });                   
                   


                
                
                $('#student-modal').click();
            }
        });
	}

	else
	{
        $('#selectClass')
      .find('option')
      .remove()
      .end()
      ;
		$("#sid").val("");
		$("#sname").val("");
		$('#student-modal').click();
		$("#save").html('Submit Student');

		                 $.ajax({
                        type: "POST",
                        url: "/Acapp/_Class/getAllClasses",
                        success: function(data){
                          console.log(data);
                            // Parse the returned json data
                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                            $.each(opts, function(i, d) {
                                var optClass=d.classcode + "|" + d.classdes;
                                
                                        $('#selectClass')
                              .append('<option>'+optClass+'</option>')
                              ;
       
                                     
                            });
                        }
                    });   

	}
}

function changeContents()
{
var _class=	document.getElementById('class').value;
console.log(_class);
	                             $.ajax({
                        type: "POST",
                        url: "/Acapp/Students/changeContent",                      
            			data: { 'class': _class },
                        success: function(data){
                          $("#stud").html("");
                          $("#stud").html(data);
                        }
                    }); 
}

function validateStudents(id)
{
  var but=$("#save").html();


    if($("#sname").val()=="")
    {
      $("#error").css('display',"");
      $("#error").html("Please provide the student's name");
    }
    else if($("#sid").val()=="")
    {
      $("#error").css('display',"");
        $("#error").html("Please provide the student's unique ID");
    }
    else if($("#selectClass").val()=="")
    {
        $("#error").css('display',"");
        $("#error").html("Please provide a class for the student");
    }
    else
    {
      if($("#save").html()=="Save changes")
      {
        submitEditStudents(id);
      }
      else
      {
        submitAddStudents();
      }
    }
  
}

function submitEditStudents(id)
{
  var name=$("#sname").val();
  var sid=$("#sid").val();
  var _class=$("#selectClass").val();

  $.ajax({
            type: "POST",
            url: "/Acapp/Students/submitEditStudents",
            data: { 'name': name, 'id':id , 'sid':sid, 'class':_class},
            success: function(data){
              console.log(data);
                 setTimeout(function(){
              window.location.assign("student_index");
         }, 1000); 
            }
        });
}

function submitAddStudents()
{
  var name=$("#sname").val();
  var sid=$("#sid").val();
  var _class=$("#selectClass").val();

  $.ajax({
            type: "POST",
            url: "/Acapp/Students/saveNewStudent",
            data: { 'name': name, 'sid':sid, 'class':_class},
            success: function(data){
              console.log(data);
                 setTimeout(function(){
              window.location.assign("student_index");
         }, 1000); 
            }
        });
}

function ConfirmDeleteStudent(id)
{
  $("#student-delete-modal").click();
  $("#delete").attr('onclick','DeleteStudent('+id+')');
}
function DeleteStudent(id)
{
  $.ajax({
            type: "POST",
            url: "/Acapp/Students/deleteStudent",
            data: { 'id': id},
            success: function(data){
              console.log(data);
                 setTimeout(function(){
              window.location.assign("student_index");
         }, 1000); 
            }
        });
}