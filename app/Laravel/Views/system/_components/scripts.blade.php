<script src="{{asset('assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>

@yield('page-scripts')

<script src="{{asset('assets/js/main.js?v=1.4')}}" type="text/javascript"></script>


<script type="text/javascript">
  $(function(){
    App.init();
  	App.formElements();
  });
</script>


<!-----------------------forms------------------------>
<script>
$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td colspan=4></td></tr><tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="School" class="form-control name_list" /></td><td><input type="text" name="name[]" placeholder="Address" class="form-control name_list" /><td><input type="text" name="name[]" placeholder="Other Information" class="form-control name_list" /></td><td><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Cancel</button></center></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        console.log(button_id); 
        $('#row'+button_id+'').remove();
        $('#row'+button_id+'').remove();
        $('#row'+button_id+'').remove();
    });
    var a=1;
    $('#add2').click(function(){
        a++;
        $('#dynamic_field2').append('<tr id="row2'+a+'"><td colspan=5></td></tr><tr id="row2'+a+'"><td><input type="text" name="name[]" placeholder="School" class="form-control name_list" /></td><td><input type="text" name="name[]" placeholder="Address" class="form-control name_list" /><td><input type="text" name="name[]" placeholder="Other Information" class="form-control name_list" /></td><td><input type="text" name="name[]" placeholder="Other Information" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+a+'" class="btn btn-danger btn_remove2">Cancel</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove2', function(){
        var button_id = $(this).attr("id");
        console.log(button_id); 
        $('#row2'+button_id+'').remove();
        $('#row2'+button_id+'').remove();
        $('#row2'+button_id+'').remove();
    });
    
    $('#submit').click(function(){      
        $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_name').serialize(),
            success:function(data)
            {
                alert(data);
                $('#add_name')[0].reset();
            }
        });
    });

    $("#lvlmentor").change(function(){
    	var ref = $(this).val();
    	if(ref==1){
	    	$("#disp").html("<input type='checkbox'>lvl1 option1<br><input type='checkbox'>lvl1 option2<br><input type='checkbox'>lvl1 option3");
    	}if(ref==2){
    		$("#disp").html("<input type='checkbox'>lvl2 option1<br><input type='checkbox'>lvl2 option2<br><input type='checkbox'>lvl2 option3");
    	}if(ref==3){
    		$("#disp").html("<input type='checkbox'>lvl3 option1<br><input type='checkbox'>lvl3 option2<br><input type='checkbox'>lvl3 option3");
    	}
    	console.log(ref);
    });
    
});
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
