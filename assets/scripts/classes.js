var selected="";

function showClassModal(action, id, type,name)
{
	$("#day").val('').trigger('change');
	$("#classCode").val('');
	$("#className").val('');
	$("#timeIn").val('');
	$("#timeOut").val('');
	$("#teacher").val('');
	$("#sem").val('');
	$("#year").val('');

	if(action =="edit")
	{
		$('#teacher')
      .find('option')
      .remove()
      .end()
      ;
		$.ajax({
            type: "POST",
            url: "/Acapp/_Class/editClass",
            data: { 'id': id },
            success: function(data){
              console.log(data);
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {

                	var pre_day=d.day;
                	var day=pre_day.split("|");
                	console.log(day);


                		$("#day").val(day).trigger('change');
						$("#classCode").val(d.classcode);
						$("#className").val(d.classdes);
						$("#timeIn").val(d.time);
						$("#timeOut").val(d.time2);
						$("#sem").val(d.sem).trigger('change');
						$("#year").val(d.year).trigger('change');
                         $('#save').attr('onclick','validateClasses('+id+')');
						selected=d.createdby;
                        _selected=selected.split('|');
                   		
                         
                });

                             $.ajax({
                        type: "POST",
                        url: "/Acapp/Teachers/getAllTeachers",
                        success: function(data){
                          console.log(data);
                            // Parse the returned json data
                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                            $.each(opts, function(i, d) {
                                var teacher=d.username + "|" + d.name;
                                if(type=="admin")
                                {
                                  if(d.username == _selected[0])
                                    {
                                        $('#teacher')
                              .append('<option selected>'+teacher+'</option>')
                              ;
                              $("#teacher").val(teacher); }
                                    
                                    else
                                 {$('#teacher')
                                               .append('<option>'+teacher+'</option>')
                                               
                                           ;}  
                                }
                                else
                                {
                                    if(d.username==_selected[0])
                                    {
                                       $("#teacher").val(teacher); 
                                    }
                                    
                                }

                                    
                                     
                            });
                        }
                    });                   
                   


                
                
                $('#class-modal').click();
            }
        });
	}

	else
	{
	$("#day").val('').trigger('change');
	$("#classCode").val('');
	$("#className").val('');
	$("#timeIn").val('');
	$("#timeOut").val('');
	$("#sem").val('');
	$("#year").val('');
    $('#save').attr('onclick','validateClasses()');
    $('#save').html('Submit Class');

                    $.ajax({
            type: "POST",
            url: "/Acapp/Teachers/getAllTeachers",
            success: function(data){
              console.log(data);
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    var teacher=d.username + "|" + d.name;

                        
                    if(type=="admin")
                    {

                     $('#teacher')
                                   .append('<option>'+teacher+'</option>')
                                   
                               ;
                    }
                    else
                    {
                        if(name==d.name)
                        {
                            $("#teacher").val(teacher);
                        }
                    }


                         
                });
            }
        });       
    



	                $('#class-modal').click();
	}

}

function validateClasses(id)
{
    var code=$("#classCode").val();
var name=$("#className").val();
var day=$("#day").val();
var time1=$("#timeIn").val();
var time2=$("#timeOut").val();
var teacher=$("#teacher").val();
var sem=$("#sem").val();
var year=$("#year").val();

    if($("#save").html() == "Save Changes")
    {
        if(code=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' code");
        }
        else if(name=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' description");
        }
        else if(day=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' scheduled day/s");
        }
        else if(time1=="")
        {
            $("#error").css('display',"");
                $("#error").html("Please provide the class' start time ");
        }
        else if(time2=="")
        {
            $("#error").css('display',"");
                $("#error").html("Please provide the class' end time");
        }
        else if(teacher=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");
        }
		else if(sem=="")
		{
			$("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");
		}
		else if(year=="")
		{
			$("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");
		}
        else
        {
            submitEditClass(id);
        }
    }
    else
    {
        if(code=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' code");
        }
        else if(name=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' description");
        }
        else if(day=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' scheduled day/s");
        }
        else if(time1=="")
        {
            $("#error").css('display',"");
                $("#error").html("Please provide the class' start time ");
        }
        else if(time2=="")
        {
            $("#error").css('display',"");
                $("#error").html("Please provide the class' end time");
        }
        else if(teacher=="")
        {
            $("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");
        }
		else if(sem=="")
		{
			$("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");//error message
		}
		else if (year=="")
		{
			$("#error").css('display',"");
            $("#error").html("Please provide the class' teacher");//error message
		}
        else
        {
            submitNewClass();
        }
    }

}

function submitEditClass(id)
{
var code=$("#classCode").val();
var name=$("#className").val();
var day=$("#day").val();
var time1=$("#timeIn").val();
var time2=$("#timeOut").val();
var teacher=$("#teacher").val();
var sem=$("#sem").val();
var year=$("#year").val();
        $.ajax({
            type: "POST",
            url: "/Acapp/_Class/submitEditClass",
            data: { 'code': code, 'id':id , 'name':name, 'day':day, 'time1':time1, 'time2' : time2, 'teacher' :teacher, 'sem':sem, 'year':year },
            success: function(data){
              console.log(data);
                 setTimeout(function(){
                    window.location.assign("class_index");
             }, 1000); 
            }
        });
}
function submitNewClass()
{
        var code=$("#classCode").val();
        var name=$("#className").val();
        var day=$("#day").val();
        var time1=$("#timeIn").val();
        var time2=$("#timeOut").val();
        var teacher=$("#teacher").val(); 
		var sem=$("#sem").val();
		var year=$("#year").val();
        
        $.ajax({
            type: "POST",
            url: "/Acapp/_Class/submitNewClass",
            data: { 'code': code , 'name':name, 'day':day, 'time1':time1, 'time2' : time2, 'teacher' :teacher, 'sem':sem, 'year':year },
            success: function(data){
              console.log(data);
                 setTimeout(function(){
                    window.location.assign("class_index");
             }, 1000); 
            }
        });   
}

function ConfirmDeleteClass(id)
{
    $("#teacher-delete-modal").click();
    $("#delete").attr('onclick','DeleteClass('+id+')');
}
function DeleteClass(id)
{
    $.ajax({
            type: "POST",
            url: "/Acapp/_Class/deleteClass",
            data: { 'id': id},
            success: function(data){
              console.log(data);
                 setTimeout(function(){
                    window.location.assign("class_index");
             }, 1000); 
            }
        });
}

function getClassViaSem(type)
{
	var sem=$("#sem2").val();
			$.ajax({
            type: "POST",
            url: "/Acapp/_Class/getClassViaSem",
            data: { 'sem': sem },
            success: function(data){
              console.log(data);
			   $('#tbody').html('');
			   var edit="'edit'";
			   type= "'" + type + "'";
			   
                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                            $.each(opts, function(i, d) {
                                                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                           
                                
                                        $('#tbody')
                              .append('<tr>'+
										'<td>' + d.classcode + '</td>'+
										'<td>' + d.classdes + '</td>'+
										'<td>' + d.day + '</td>'+
										'<td>' + d.time + '</td>'+
										'<td>' + d.time2 + '</td>'+
										'<td>' + d.sem + '</td>'+
										'<td>' + d.year + '</td>'+
										'<td>' + d.createdby + '</td>'+
										'<td align="center"> <button class="btn btn-primary" id="'+d.classid+'"onclick="showClassModal('+edit+',this.id,'+type+');">Edit</button><button class="btn btn-danger"  id="'+d.classid+'" onclick="ConfirmDeleteClass(this.id);">Delete</button>' + '</td>'+'</tr>')
                              ;
							  
    
                            });
             }
        });
}

function getClassViaYear(type)
{
	var year=$("#year2").val();
			$.ajax({
            type: "POST",
            url: "/Acapp/_Class/getClassViaYear",
            data: { 'year': year },
            success: function(data){
				var edit="'edit'";
			   type= "'" + type + "'";
              console.log(data);
			   $('#tbody').html('');
                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                            $.each(opts, function(i, d) {
                                                            var opts = $.parseJSON(data);
                            // Use jQuery's each to iterate over the opts value
                           
                                
                                       $('#tbody')
                              .append('<tr>'+
										'<td>' + d.classcode + '</td>'+
										'<td>' + d.classdes + '</td>'+
										'<td>' + d.day + '</td>'+
										'<td>' + d.time + '</td>'+
										'<td>' + d.time2 + '</td>'+
										'<td>' + d.sem + '</td>'+
										'<td>' + d.year + '</td>'+
										'<td>' + d.createdby + '</td>'+
										'<td align="center"> <button class="btn btn-primary" id="'+d.classid+'"onclick="showClassModal('+edit+',this.id,'+type+');">Edit</button><button class="btn btn-danger"  id="'+d.classid+'" onclick="ConfirmDeleteClass(this.id);">Delete</button>' + '</td>'+'</tr>')
                              ;
							  
    
                            });
             }
        });
}