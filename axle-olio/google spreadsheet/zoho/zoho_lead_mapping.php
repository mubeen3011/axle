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
    <form id="lead_mapping" action="#" method="post">

    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Lead Mapping</a>
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
                        <input type="hidden" name="task" value="lead">

                        </div>      
                        
                        </div>
                    </label>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr/>
                    <p>For each call field. Choose the Zoho object field you want to populate with data.</p>
                    <button type="button" id="addScnt" type="button" class="btn btn-primary" style="float: right;padding-right: 5px;background: green;">add more fields</button>
                </div>
                
                <div class="col-md-12 table-responsive" style="overflow-x: hidden;">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td><b>Call Field</b></td>
                                <td><b>Zoho Lead Fields</b></td>
                                <td><b>Default Value</b></td>
                            </tr>
                        </thead>
                        <tbody id="row_container">
                            <tr id="row_field" class="call_field_row">
                                <td><select class="form-control call_field_rows"  style="width:250px" name='call_field_row[]'>
                                <option value="call_type">marketing channel</option>
                                <option value="cd_call_status">call status</option>
                                <option value="cd_leg2duration">call duration</option>
                                <option value="cd_leg1start_time">call datetime</option>
                                <option value="recordingurl">recording</option>
                                <option value="uv_keyword">keyword</option>
                                <option value="cd_did">tracking number</option>
                                <option value="cd_receiving_number">recieving number</option>
                                <option value="cd_leg1telno">caller number</option>
                                <option value="tactic_label">tactic label</option>
                                <option value="label">label</option>
                                <option value="description">description</option>
                                <option value="cd_state">state</option>
                                <option value="cd_city">city</option>
                                <option value="country">country</option>
                                <option value="cd_country">company</option>
                                <option value="campaign_name">campaign name</option>
                                <option value="adgroup">ad group</option>
                                </select></td>
                                <td><select class="form-control sale_force_field_row"  style="width:250px" name="zoho_value[]" id="lead_zoho"></select></td>
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
                    <button type="submit" class="btn btn-primary" id="save_lead_mapping">Save Lead Mapping</button>
                </div>
            </div>
        </h3>
    </div>
    </form>
</div> 


<script>
$(document).ready(function(){
  $(".call_field_rows").select2({})
  $(".sale_force_field_row").select2({})
var i = $('.voucher_row tr').size() + 1;                     
$("#addScnt").click(function(){
$("<tr id='row_field_"+i+"' class='voucher_row'><td><select class='form-control call_field_rows' name='call_field_row[]' id='call_field"+i+"' style='width:250px'><option value='call_type'>marketing channel</option><option value='cd_call_status'>call status</option><option value='cd_leg2duration'>call duration</option><option value='cd_leg1start_time'>call datetime</option><option value='recordingurl'>recording</option><option value='uv_keyword'>keyword</option><option value='cd_did'>tracking number</option><option value='cd_receiving_number'>recieving number</option><option value='cd_leg1telno'>caller number</option><option value='tactic_label'>tactic label</option><option value='label'>label</option><option value='description'>description</option><option value='cd_state'>state</option><option value='cd_city'>city</option><option value='country'>country</option><option value='cd_country'>company</option><option value='campaign_name'>campaign name</option><option value='adgroup'>ad group</option></select></td><td><select class='form-control sale_force_field_row' name=zoho_value[]' id='lead_zoho"+i+"' style='width:250px'></select></td><td><input type='text' name='default_value[]' placeholder='Default Value' required class='form-control default_value' id='default_value"+i+"' style='width:100%'></td><td><a id='remScnt'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#row_container");
 $(".call_field_rows").select2({})
 $(".sale_force_field_row").select2({})	
 var lead_zoho = "#lead_zoho"+i;
i++;
$.ajax({
type: "GET",
url: url,
data: {task:'field_mapping_from_zoho', api_name: 'Leads'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
return $("<option data-type='"+val.type+"'></option>").val(val.name).html(val.label);
});

$(lead_zoho).append(options);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});						 
	return false;
});
$(document).on('click','#remScnt', function() { 
if( i > 1 ) {
$(this).parents('tr').remove();
i--;
}
return false;
});

var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
$("#lead_mapping").submit(function (event) {    
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
data: {task:'lead_mapping_edit', mapping_type:'lead'},
dataType : "json",
success: function(msg){ 
const arr_lead = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_lead.length > 0) {
$('#row_field').remove();
}   

$.each(msg, function(index) {
$("<tr id='row_field_"+i+"' class='voucher_row'><td><select class='form-control call_field_rows' name='call_field_row[]' id='call_field"+i+"' style='width:250px'><option value='call_type'>marketing channel</option><option value='cd_call_status'>call status</option><option value='cd_leg2duration'>call duration</option><option value='cd_leg1start_time'>call datetime</option><option value='recordingurl'>recording</option><option value='uv_keyword'>keyword</option><option value='cd_did'>tracking number</option><option value='cd_receiving_number'>recieving number</option><option value='cd_leg1telno'>caller number</option><option value='tactic_label'>tactic label</option><option value='label'>label</option><option value='description'>description</option><option value='cd_state'>state</option><option value='cd_city'>city</option><option value='country'>country</option><option value='cd_country'>company</option><option value='campaign_name'>campaign name</option><option value='adgroup'>ad group</option></select></td><td><select class='form-control sale_force_field_row' name=zoho_value[]' id='lead_zoho"+i+"' style='width:250px'></select></td><td><input type='text' name='default_value[]' placeholder='Default Value' required class='form-control default_value' id='default_value"+i+"' style='width:100%'></td><td><a id='remScnt'><i class='form-control glyphicon glyphicon-trash'></a></td></tr>").appendTo("#row_container");

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
data: {task:'field_mapping_from_zoho', api_name: 'Leads'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
return $("<option data-type='"+val.type+"'></option>").val(val.name).html(val.label);
});
setTimeout(function() {
$('.sale_force_field_row').append(options);
}, 1000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});


$.ajax({
type: "GET",
url: url,
data: {task:'lead_mapping_edit', mapping_type:'lead'},
dataType : "json",
success: function(msg){ 
const arr_lead = Object.keys(msg).map((key) => [key, msg[key]]);   
if (arr_lead.length > 0) {
$('#row_field').remove();
}   

var l = 1;
setTimeout(function() {
$.each(msg, function(index) {
var lead_zoho_id = "#lead_zoho"+l;

var call_field = msg[index].call_field;
var default_value = msg[index].default_value;
var mapping_type = msg[index].mapping_type;
var zoho_field = msg[index].zoho_field; 


var call_field_id = "#call_field"+l;
$(call_field_id).val(call_field).change();
$(lead_zoho_id).val(zoho_field).change();
//$(call_field_id+ ` option[value='${call_field}']`).prop('selected', true);
//$(lead_sale_force_id+` option[value='${sale_force}']`).prop('selected', true);
var default_value_id = "#default_value"+l;
$(default_value_id).val(default_value);
//$(".call_field_rows").select2({})
$(".call_field_rows").select2({})
$(".sale_force_field_row").select2({})

l++;
});
}, 3000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});





 });


</script>







