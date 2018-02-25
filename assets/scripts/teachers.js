

function showTeacherModal(action, id)
{

	if (action == "edit")
	{
		$("#error").css('display','none');
		 $.ajax({
            type: "POST",
            url: "/Acapp/Teachers/editTeachers",
            data: { 'id': id },
            success: function(data){
              console.log(data);
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {

                	$('#password').val("");
                	$('#confirm').val("");
                   
                   $('#name').val(d.name);
                   $('#username').val(d.username);
                   $('#email').val(d.email);
                   $('#save').html("Save Changes");
                   $('#save').attr('onclick','validateTeachers('+id+')');
                   $('#teacher-modal').click();
                         
                });
            }
        });
	}
	else if(action == "add")
	{
					$('#password').val("");
                	$('#confirm').val("");                   
                    $('#name').val("");
                    $('#username').val("");
                    $('#email').val("");
                    $('#save').attr('onclick','validateTeachers()');

		$('#teacher-modal').click();
		$('#save').html('Submit Teacher');
	}

}

function validateTeachers(id)
{

	if($("#save").html() == "Save Changes")
	{
				if($("#name").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's name");
			}
			else if($("#username").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's username");
			}
			else if($("#email").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's email");
			}
			else if($("#password").val() != "")
			{
				if($("#password").val().length <6)
				{
					$("#error").css('display',"");
				$("#error").html("Please provide a password of atleast 6 characters.");
				}
				else if($("#confirm").val() != $("#password"))
				{
					$("#error").css('display',"");
				$("#error").html("Passwords do not match");
				}
			}
			else
			{
				submitEditTeachers(id);
			}
	}
	else
	{
			if($("#name").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's name");
			}
			else if($("#username").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's username");
			}
			else if($("#email").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's email");
			}
			else if($("#password").val() == "")
			{
				$("#error").css('display',"");
				$("#error").html("Please provide the teacher's password");
			}
			else if($("#confirm").val () == "" )
			{
				$("#error").css('display',"");
				$("#error").html("Please retype your password");
			}
			else if($("#password").val().length <  6 )
			{
				$("#error").css('display',"");
				$("#error").html("Please provide a password of atleast 6 characters.");
			}
			else if($("#confirm").val() != $("#password").val())
			{
				$("#error").css('display',"");
				$("#error").html("Passwords do not match");
			}
			else
			{
				submitAddTeachers();
			}
	}

}

function submitEditTeachers(id)
{
	var name = $("#name").val();
	var username= $("#username").val();
	var email= $("#email").val();
	var pass = $("#password").val();
	var confirm = $("#confirm").val();

	$.ajax({
            type: "POST",
            url: "/Acapp/Teachers/submitEditTeachers",
            data: { 'name': name, 'id':id , 'username':username, 'email':email, 'pass':pass, 'confirm' : confirm },
            success: function(data){
              console.log(data);
       //           setTimeout(function(){
       //  			window.location.assign("teachers_index");
   			 // }, 1000); 
            }
        });




}

function submitAddTeachers()
{
	var name = $("#name").val();
	var username= $("#username").val();
	var email= $("#email").val();
	var pass = $("#password").val();
	var confirm = $("#confirm").val();

	$.ajax({
            type: "POST",
            url: "/Acapp/Teachers/saveNewTeacher",
            data: { 'name': name, 'username':username, 'email':email, 'pass':pass, 'confirm' : confirm },
            success: function(data){
              console.log(data);
                 setTimeout(function(){
        			window.location.assign("teachers_index");
   			 }, 1000); 
            }
        });


}

function ConfirmDeleteTeacher(id)
{
	$("#teacher-delete-modal").click();
	$("#delete").attr('onclick','DeleteTeacher('+id+')');
}
function DeleteTeacher(id)
{
	$.ajax({
            type: "POST",
            url: "/Acapp/Teachers/deleteTeacher",
            data: { 'id': id},
            success: function(data){
              console.log(data);
                 setTimeout(function(){
        			window.location.assign("teachers_index");
   			 }, 1000); 
            }
        });
}