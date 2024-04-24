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
    <form id="task_mapping" action="#" method="post">

    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Task Mapping</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                    <label class="btn" for="input_active" onclick="" style="padding: 0px">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                         
                        <div class="btn-group btn2-toggles"> 
                        <input type="hidden" name="task" value="task">

                        </div>      
                        
                        </div>
                    </label>
                    </div>
                   

                </div>


                <div class="col-md-12">
                    <hr/>
                    <p>For each call field. Choose the zoho object field you want to populate with data.</p>
                    <button type="button" id="addTask" type="button" class="btn btn-primary" style="float: right;padding-right: 5px;background: green;">add more fields</button>
                </div>
                
                <div class="col-md-12 table-responsive" style="overflow-x: hidden;">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td><b>Call Field</b></td>
                                <td><b>Zoho Task Fields</b></td>
                                <td><b>Default Value</b></td>
                            </tr>
                        </thead>
                        <tbody id="task_container">
                            <tr id="task_row_field" class="task_field_row">
                                <td><select class="form-control task_field_rows"  style="width:250px" name='call_field_row[]'>
                                <option value='call_type'>marketing channel</option>
                                <option value='cd_call_status'>call status</option>
                                <option value='cd_leg2duration'>call duration</option>
                                <option value='cd_leg1start_time'>call datetime</option>
                                <option value='recordingurl'>recording</option>
                                <option value='uv_keyword'>keyword</option>
                                <option value='cd_did'>tracking number</option>
                                <option value='cd_receiving_number'>recieving number</option>
                                <option value='cd_leg1telno'>caller number</option>
                                <option value='tactic_label'>tactic label</option>
                                <option value='label'>label</option>
                                <option value='description'>description</option>
                                <option value='cd_state'>state</option>
                                <option value='cd_city'>city</option>
                                <option value='country'>country</option>
                                <option value='cd_country'>company</option>
                                <option value='campaign_name'>campaign name</option>
                                <option value='adgroup'>ad group</option>
                                </select></td>
                                <td><select class="form-control task_zoho_field_row"  style="width:250px" name="zoho_value[]" id="task_zoho_field"></select></td>
                                <td><input type="text" placeholder="Default Value" class="form-control default_value" name="default_value[]" required  style="width:100%"></td>
                                <td><i class="form-control glyphicon glyphicon-trash"></td>
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
                    <button type="submit" class="btn btn-primary" id="save_lead_mapping">Save Task Mapping</button>
                </div>
            </div>
        </h3>
    </div>
    </form>
</div> 


<script>
$(document).ready(function(){
$(".task_field_rows").select2({})
$(".task_zoho_field_row").select2({})
var i = $('.task_row tr').size() + 1;                     
$("#addTask").click(function(){
$("<tr id='task_row_field_"+i+"' class='task_row'><td><select class='form-control task_field_rows' name='call_field_row[]' id='task_call_field"+i+"' style='width:250px'><option value='call_type'>marketing channel</option><option value='cd_call_status'>call status</option><option value='cd_leg2duration'>call duration</option><option value='cd_leg1start_time'>call datetime</option><option value='recordingurl'>recording</option><option value='uv_keyword'>keyword</option><option value='cd_did'>tracking number</option><option value='cd_receiving_number'>recieving number</option><option value='cd_leg1telno'>caller number</option><option value='tactic_label'>tactic label</option><option value='label'>label</option><option value='description'>description</option><option value='cd_state'>state</option><option value='cd_city'>city</option><option value='country'>country</option><option value='cd_country'>company</option><option value='campaign_name'>campaign name</option><option value='adgroup'>ad group</option></select></td><td><select class='form-control task_zoho_field_row' name=zoho_value[]' id='task_zoho_field"+i+"' style='width:250px'></select></td><td><input type='text' name='default_value[]' placeholder='Default Value' required class='form-control task_default_value' id='default_value"+i+"' style='width:100%'></td><td><a id='remTask'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#task_container");
$(".task_field_rows").select2({})
$(".task_zoho_field_row").select2({})	
var task_zoho_field = "#task_zoho_field"+i;

i++;
$.ajax({
type: "GET",
url: url,
data: {task:'field_mapping_from_zoho', api_name:'Tasks'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
return $("<option data-type='"+val.type+"'></option>").val(val.name).html(val.label);
});

$(task_zoho_field).append(options);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});						 
	return false;
});
$(document).on('click','#remTask', function() { 
if( i > 1 ) {
$(this).parents('tr').remove();
i--;
}
return false;
});

var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
$("#task_mapping").submit(function (event) {    
$.ajax({
    type: "POST",
    url: url,
    data:  $(this).serialize(),
    dataType: "json",
    encode: true,
}).done(function (data) {
    if(data.status == true){
    toastr.success(data.msg);
    }
    else{
        toastr.error(data.msg);
    }
});
event.preventDefault();
});

$.ajax({
type: "GET",
url: url,
data: {task:'task_mapping_edit', mapping_type:'task'},
dataType : "json",
success: function(msg){ 
const arr_task = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_task.length > 0) {
$('#task_row_field').remove();   
}
$.each(msg, function(index) {
$("<tr id='task_row_field_"+i+"' class='task_row'><td><select class='form-control task_field_rows' name='call_field_row[]' id='task_call_field"+i+"' style='width:250px'><option value='call_type'>marketing channel</option><option value='cd_call_status'>call status</option><option value='cd_leg2duration'>call duration</option><option value='cd_leg1start_time'>call datetime</option><option value='recordingurl'>recording</option><option value='uv_keyword'>keyword</option><option value='cd_did'>tracking number</option><option value='cd_receiving_number'>recieving number</option><option value='cd_leg1telno'>caller number</option><option value='tactic_label'>tactic label</option><option value='label'>label</option><option value='description'>description</option><option value='cd_state'>state</option><option value='cd_city'>city</option><option value='country'>country</option><option value='cd_country'>company</option><option value='campaign_name'>campaign name</option><option value='adgroup'>ad group</option></select></td><td><select class='form-control task_zoho_field_row' name=zoho_value[]' id='task_zoho_field"+i+"' style='width:250px'></select></td><td><input type='text' name='default_value[]' placeholder='Default Value' required class='form-control task_default_value' id='zoho_default_value"+i+"' style='width:100%'></td><td><a id='remTask'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#task_container");
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
data: {task:'field_mapping_from_zoho',api_name: 'Tasks'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
return $("<option data-type='"+val.type+"'></option>").val(val.name).html(val.label);
});
setTimeout(function() {
$('.task_zoho_field_row').append(options);
}, 2000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});


$.ajax({
type: "GET",
url: url,
data: {task:'task_mapping_edit', mapping_type:'task'},
dataType : "json",
success: function(msg){ 
const arr_task = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_task.length > 0) {
$('#task_row_field').remove();   
}
var t = 1;
setTimeout(function() {
$.each(msg, function(index) {
var task_sale_force_id = "#task_zoho_field"+t;
var task_call_field_value = msg[index].call_field;
var task_default_value = msg[index].default_value;
var task_mapping_type = msg[index].mapping_type;
var task_sale_force_value = msg[index].zoho_field; 


var task_call_field_id = "#task_call_field"+t;
$(task_call_field_id).val(task_call_field_value).change();
$(task_sale_force_id).val(task_sale_force_value).change();
//$(task_call_field_id+ ` option[value='${task_call_field_value}']`).prop('selected', true);
//$(task_sale_force_id+` option[value='${task_sale_force_value}']`).prop('selected', true);
var default_value = "#zoho_default_value"+t;
$(default_value).val(task_default_value);
$(".task_field_rows").select2({})
$(".task_zoho_field_row").select2({})
t++;
});
}, 3000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});




});
</script>



