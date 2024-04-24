<!-- <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Associate Campaigns</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                     <p>Create new Campaigns in Salesforce dor each of your tracking sources. New Campaigns will be created in Salesforce with a prefix of CTM</p>
                    <p>NOTE: This is a one time operation</p> 
                   
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-12" >
                    <button type="button" class="btn btn-primary">Associate Campaigns</button>
                </div>
            </div>
        </h3>
    </div>
</div> -->

<style>
    select.form-control{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

         border-top: 0px solid #ddd;
    }


</style>
<div class="panel panel-default">
    

    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho User/Alias Assignment</a>
        </h3>
    </div>
    <form id="user_mapping" action="#" method="post">
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                <p>Zoho Routers provide you with a method of routing callers to a lead owner automatically.</p>
                    <div class="col-md-3">
                    <label class="btn" for="input_active" onclick="" style="padding: 0px">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                            <!-- mubeen siddiqui adding switching button -->
                        <div class="btn-group btn2-toggles"> 
                        <input type="hidden" name="task" value="user_alias">

                        </div>      
                        
                        </div>
                    </label>
                    </div>
                    <!-- <div class="col-md-4">
                        <select class="form-control">
                            <option>Leads</option>
                            <option>Leads</option>
                        </select>
                    </div> -->

                </div>


                <div class="col-md-12">
                    <hr/>
                    <p>For each call field. Choose the Zoho object field you want to populate with data.</p>
                    <button type="button" id="adduser_alias" type="button" class="btn btn-primary" style="float: right;padding-right: 5px;background: green;">add more fields</button>
                </div>
                
                <div class="col-md-12 table-responsive" style="overflow-x: hidden;">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td><b>Receiving Number (with country code)</b></td>
                                <td><b>  Select Zoho User/Alias</b></td>
                                
                            </tr>
                            
                        </thead>
                        <tbody id="user_alias_container">
                            <tr id="user_alias_row_field_1" class="user_alias_row">
                                <td><input type="text" placeholder="forwearding number" class="form-control myformdatadist_forwarding text  forwardingnumber" name="forwardingnumber[]" required  style="width:100%" pattern='^[+0]{0,2}(91)?[0-9]{10}$'></td>
                                <td style="width: 250px;"><select class="form-control sf_user"  style="width:250px" name="zoho_user[]" id="sf_user"></select></td>
                                <td style='width: 10px;'><i class="form-control glyphicon glyphicon-trash"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-12" >
                    <button type="submit" class="btn btn-primary" id="">Save User/Alias Assignment</button>
                </div>
            </div>
        </h3>
    </div>
    </form>
</div>



 <script>
$(document).ready(function(){

$(".sf_user").select2({})
$('.sf_user').trigger('change');
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';

var i = $('.user_alias_row tr').size() + 1;                
$("#adduser_alias").click(function(){
$("<tr id='user_alias_row_field"+i+"' class='user_alias_row'><td><input type='text' pattern='^[+0]{0,2}(91)?[0-9]{10}$' name='forwardingnumber[]' placeholder='forwearding number' required class='form-control myformdatadist_forwarding text  forwardingnumber' id='forwardingnumber"+i+"' style='width:100%'></td><td style='width: 250px;'><select class='form-control sf_user' style='width:250px' name='zoho_user[]' id='sf_user"+i+"'></select></td><td style='width: 10px;'><a id='remuseralias'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#user_alias_container");
$(".sf_user").select2({})
$('.sf_user').trigger('change');
var sf_user = "#sf_user"+i;
i++;
$.ajax({
type: "GET",
url: url,
data: {task:'user_mapping_from_zoho'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
    var first_name = (val.First_Name) ? val.First_Name : "";
var last_name = (val.last_Name) ? val.last_Name : "";
return $("<option></option>").val(val.Id+'_'+first_name + " " + last_name).html(first_name + " " + last_name);
});

$(sf_user).append(options);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});
				 					 
	return false;
});








$(document).on('click','#remuseralias', function() { 
if( i > 1 ) {
$(this).parents('tr').remove();
i--;
}
return false;
});


$("#user_mapping").submit(function (event) {  
   
$.ajax({
    type: "POST",
    url: url,
    data:  $(this).serialize(),
    dataType: "json",
    encode: true,
}).done(function (data) {
    toastr.success(data);
});
event.preventDefault();
});


$.ajax({
type: "GET",
url: url,
data: {task:'user_alias_edit'},
dataType : "json",
success: function(msg){ 
const arr_field = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_field.length > 0) {
$('#user_alias_row_field_1').remove();   
}
    
$.each(msg, function(index) {
 $("<tr id='user_alias_row_field"+i+"' class='user_alias_row'><td><input type='text' pattern='^[+0]{0,2}(91)?[0-9]{10}$' name='forwardingnumber[]' placeholder='forwearding number' required class='form-control myformdatadist_forwarding text  forwardingnumber' id='forwardingnumber"+i+"' style='width:100%'></td><td style='width: 250px;'><select class='form-control sf_user' style='width:250px' name='zoho_user[]' id='sf_user"+i+"'></select></td></td><td style='width: 10px;'><a id='remuseralias'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#user_alias_container");
i++;
});

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}





});


$.ajax({
type: "GET",
url: url,
data: {task:'user_mapping_from_zoho'},
dataType : "json",
success: function(res){ 
    
var options = res.map(function(val, ind){

var first_name = (val.First_Name) ? val.First_Name : "";
var last_name = (val.last_Name) ? val.last_Name : "";
return $("<option></option>").val(val.Id+'_'+first_name + " " + last_name).html(first_name + " " + last_name);
 });
 setTimeout(function() {
 $('.sf_user').append(options);
}, 1000);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    //alert(errorThrown);
}
});




$.ajax({
type: "GET",
url: url,
data: {task:'user_alias_edit'},
dataType : "json",
success: function(msg){ 
const arr_field = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_field.length > 0) {
$('#user_alias_row_field_1').remove();   
}
    console.log(msg);
var y = 1;
setTimeout(function() {
   
$.each(msg, function(index) {

var sf_user_id = "#sf_user"+y;
var receiving_number = msg[index].receiving_number;
var salesforce_user_id = msg[index].zoho_user_id+"_"+msg[index].zoho_user_name;
    
//alert(salesforce_user_id);
//alert($(sf_user_id+ ` option[value='${salesforce_user_id}']`).prop('selected', 'selected'));
//$(sf_user_id+'option[value='+salesforce_user_id+']').attr('selected','selected').change();
//$("#sf_user1 select").val(salesforce_user_id).change();
$(sf_user_id).val(salesforce_user_id).change();
var forwardingnumber = "#forwardingnumber"+y;

$(forwardingnumber).val(receiving_number);

$(".sf_user").select2({})
// $(".campaign_rows").select2({})
// $(campaign_sale_force_id).select2({})
y++;
});
// $(`.lead_owner_type option[value='${msg.lead_owner_type}']`).prop('selected', true);
}, 3000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});
}); 





</script>





