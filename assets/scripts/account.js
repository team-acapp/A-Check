function showModal(username)
{
		$.ajax({
            type: "POST",
            url: "/Acapp/Teachers/getUsers",
            data: { 'username': username },
            success: function(data){
              console.log(data);
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {


                		
						$("#accname").val(d.name);
						$("#accusername").val(d.username);
						$("#accemail").val(d.email);
						selected=d.createdby;
						$('#saveAcc').attr('onclick','editAccount("'+d.id+'")');
						$('#cancelAcc').attr('onclick','closez("'+d.id+'")');
                   		
                         
                });

                
                $('#account-modal').click();
            }
        });
}

function editAccount(id)
{
	$("#saveAcc").html("Save Account");
	$("#accname").removeAttr('disabled');
	$("#accemail").removeAttr('disabled');
	$("#accusername").removeAttr('disabled');
	$("#divPass").css('display','');
	$("#divConf").css('display','');
	$('#saveAcc').html("Save Account");
	$('#cancelAcc').css('display','');
	$('#saveAcc').attr('onclick','validateAccount("'+id+'")');
	
}
function closez(id)
{
	$("#accname").attr('disabled','disabled');
	$("#accemail").attr('disabled','disabled');
	$("#accusername").attr('disabled','disabled');
	$("#divPass").css('display','none');
	$("#divConf").css('display','none');
	$('#saveAcc').html("Edit");
	$("#cancelAcc").css('display','none');
	$('#saveAcc').attr('onclick','editAccount("'+id+'")');
}

function validateAccount(id)
{
	var name=$("#accname").val();
	var _username=$("#accusernmame").val();
	var email=$("#accemail").val();
	var password=$("#accpassword").val();
	var confirm=$("#accconfirm").val();

	if(name == "")
	{
      $("#accerror").css('display',"");
      $("#accerror").html("Please do not leave any input empty");
	}
	else if(_username=="")
	{
      $("#accerror").css('display',"");
      $("#accerror").html("Please do not leave any input empty");
	}
	else if(email=="")
	{
      $("#accerror").css('display',"");
      $("#accerror").html("Please do not leave any input empty");
	}
	else if(password!="")
	{

		 if($("#accpassword").val().length <6)
		{
	      $("#accerror").css('display',"");
	      $("#accerror").html("Please provide a password of atleast 6 characters.");
		}
		else if(confirm=="")
		{
			$("#accerror").css('display',"");
	      $("#accerror").html("Please retype your password");
		}
		else if(password != confirm)
		{
	      $("#accerror").css('display',"");
	      $("#accerror").html("Passwords do not match");
		}
		else{
			submitEditAccount(id);
		}
	}

	else
	{
		submitEditAccount(id);
	}
}

function submitEditAccount(id)
{	
	var name=$("#accname").val();
	var _username=$("#accusername").val();
	var email=$("#accemail").val();
	var password=$("#accpassword").val();
	var confirm=$("#accconfirm").val();
	$.ajax({
            type: "POST",
            url: "/Acapp/Teachers/submitEditAccount",
            data: { 'name': name, 'id':id , 'username':_username, 'email':email, 'password':password, 'confirm' : confirm },
            success: function(data){
              console.log(data);
                 setTimeout(function(){
        			window.location.reload();
   			 }, 1000); 
            }
        });
}

function getDate()
{
	var date1=$("#datepicker").val();
	var date2=$("#datepicker2").val();
	var _class=$("#selectClass").val();

		$.ajax({
            type: "POST",
            url: "/Acapp/Attendance/getAtt",
            data: { 'date1': date1, 'date2':date2 , 'class':_class },
            success: function(data){
              console.log(data);
                 $("#att").html(data);
             }
        });

}

function get_print()
{
	window.print();
}