
<style>
    select.form-control{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Lead Option</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                            <!-- mubeen siddiqui adding switching button -->
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="lead_option" data-toggle="toggle" value="new_caller_lead" id="new_caller_lead">
                        </div>   
                        
                        </div>
                        Automatically add new callers as a lead within zoho.
                    </label>
                </div>
                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                      
                         <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="lead_option" data-toggle="toggle" value="total_length" id="total_length">
                        </div> 
                        
                        </div>
                       Conditionally add based on the talk time of the call instead of the total length of the phone call.
                    </label>
                </div> -->

                <div class="col-md-12">
                    <label class="btn" for="input_active">Post Calls Data</label><br/>
                    <div class="col-md-6">
                        <select class="form-control post_calls_data">
                            <option value="start" selected>As the call begins</option>
                            <option value="end">As the call ends</option>
                            <option value="delay">As the call ends with Seconds delay</option>
                        </select>
                        
                    </div>
                    <span id="second_delay"><input class="form-control second_delays" style="width: 100px; display: none;" type="text" name="delay" id="delay" value="0" size="4" maxlength="4"></span>
                </div>
                
                <div class="col-md-12">
                <br/>
                    <label class="btn" for="input_active">Sync to zoho only for the following Campaigns</label><br/>
                    <div class="col-md-6">
                <select class="js-example-basic-multiple form-control campaign" id="campaign" name="states[]" multiple="multiple" style="width: 500x; height:300x;">
                   
                </select>
            
                    </div>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp; (Leaving none selected will work as if all were selected )</p>
                </div>

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active">Only add callers as leads when the call lasts longer than </label><br/>

                    <div class="col-md-2">
                        <input type="text" class="form-control time_length" value="5" name="" class="form-control" >
                    </div>
                    <div class="col-md-2" style="margin-left: -20px">
                        <select class="form-control time_smh">
                            <option value="Seconds">Seconds</option>
                            <option value="Minutes">Minutes</option>
                            <option value="Hours">Hours</option>
                        </select>
                    </div>
                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active">Default Status for new lead </label><br/>
                    <div class="col-md-6">
                        <select class="form-control defualt_status">
                            <option value="Connected">Connected</option>
                            <option value="Disconnected">Disconnected</option>
                        </select>
                    </div>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;By Default we use the builtin status (picklist) from the select lead object. For custom objects we can also check a custom field named Status_c (picklist).</p>
                </div>

                <div class="col-md-12">
                    <label class="btn" for="input_active">Use a default email address when creating a lead from a caller who has no email address</label><br/>
                    <div class="col-md-6">
                        <input type="text" value="" name="" class="form-control email_address" placeholder="{{Caller_number}}@example.com">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="btn" for="input_active">Lead/Contact/Object Record Type (Optional)</label><br/>
                    <div class="col-md-6">
                        <select class="form-control record_type">
                            <option value="">None</option>
                            <option value="">None</option>
                        </select>
                    </div>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;By Default, Object do not have a record type. If you want to use a record type, you must first define them in Salesforce.</p>
                </div> -->
<!-- 
                <div class="col-md-12">
                <br/>
                    <span>&nbsp;&nbsp;&nbsp;Sync to Salesforce only the following:</span><br/>
                    <span>&nbsp;&nbsp;&nbsp;Hint: Leaving none selected will work as if all were selected.</span>
                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active">Tracking Sources</label><br/>
                    <div class="col-md-12">
                        <input type="text" class="form-control tracking_source" value="" name="" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="btn" for="input_active">Tracking Numbers</label><br/>
                    <div class="col-md-12">
                        <input type="text" class="form-control tracking_number" value="" name="" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="btn" for="input_active">Recieving Numbers</label><br/>
                    <div class="col-md-12">
                        <input type="text" class="form-control recieving_number" value="" name="" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="btn" for="input_active">Menu Keypress</label><br/>
                    <div class="col-md-12">
                        <input type="text" class="form-control menu_keypress" value="" name="" class="form-control" placeholder="">
                    </div>
                </div> -->

            </div>

        </div>
    </div>
    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-12" >
                    <button type="button" id="lead_option_save" class="btn btn-primary">Save Lead Options</button>
                </div>
            </div>
        </h3>
    </div>
</div>


<script>
$(document).ready(function(){

$('.js-example-basic-multiple').select2();
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';

$.ajax({
type: "GET",
url: url,
data: {task:'getcampaign'},
dataType : "json",
success: function(msg){

var options = msg.map(function(val, ind){
    var title_phone = "";
    if(val.title != null){
        var title_phone = val.title+" - "+val.phone_no;
    }else if(val.title == null){
        var title_phone = val.phone_no;
    }

return $("<option></option>").val(val.phone_id).html(title_phone);
});

$('#campaign').append(options);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});

$("#lead_option_save").click(function(){
event.stopImmediatePropagation();
var checked = '';
$('.lead_option:checked').each(function(){        
var values = $(this).val();
checked += values+",";
});
var time_length = $(".time_length").val();
var time_smh = $(".time_smh :selected").val();
var defualt_status = $(".defualt_status :selected").val();
var email_address = $(".email_address").val();
var record_type = $(".record_type :selected").val();
var post_calls_data = $(".post_calls_data :selected").val();
var campaign = $(".campaign").val();
var second_delays = $(".second_delays").val();
var tracking_source = $(".tracking_source").val();
var tracking_number = $(".tracking_number").val();
var recieving_number = $(".recieving_number").val();
var menu_keypress = $(".menu_keypress").val();    

$.ajax({
type: "POST",
url: url,
data: {task:'lead_option',checked:checked, time_length: time_length, time_smh: time_smh, defualt_status:defualt_status, email_address:email_address, record_type:record_type, tracking_source:tracking_source, tracking_number:tracking_number, recieving_number:recieving_number, menu_keypress:menu_keypress, post_calls_data:post_calls_data, second_delays:second_delays, campaign:campaign},
dataType : "text",
success: function(msg){
toastr.success(msg);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
toastr.error(errorThrown);
}
});     
});

$.ajax({
type: "GET",
url: url,
data: {task:'lead_option_edit'},
dataType : "json",
success: function(msg){
if(msg){
let text = msg.call_time;
const time_smh = text.split(" ");

$(".time_length").val(time_smh[0]);
$(`.time_smh option[value='${time_smh[1]}']`).prop('selected', true); 
$(`.defualt_status option[value='${msg.default_status}']`).prop('selected', true);    
$(".email_address").val(msg.email_address);
$(".email_address").val(msg.email_address);
$(`.record_type option[value='${msg.record_type}']`).prop('selected', true);
$(`.post_calls_data option[value='${msg.post_call_data}']`).prop('selected', true);

 var campaign_number=msg.campaign;
 var arrayArea = campaign_number.split(',');
 var array = [campaign_number].toString().replace(/\s*\,\s*/g, ",").trim().split(",");


$('.campaign').val(array).change();

//$('.campaign').select2('val',arrayArea );
//$('#campaign').val([msg.campaign]).change();
$(".tracking_source").val(msg.tracking_source);
$(".tracking_number").val(msg.tracking_number);
$(".recieving_number").val(msg.recieving_number);
$(".menu_keypress").val(msg.menu_keypress);
if(msg.post_call_data == "delay"){
    $(".second_delays").css("display", "revert");
    $(".second_delays").val(msg.second_delay);
}



$('.lead_option').each(function(){
var id = $(this).attr('id');
var arr = Object.entries(msg[id]);
if(arr[0][1] == 1){
$('#'+id)[0].checked = true;  
$('#'+id).parent().removeClass('btn-default off') 
$('#'+id).parent().addClass('btn-primary') 
}
});

}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{

}
});


$('.post_calls_data').change(function() {
if($(this).val() == "delay"){
$(".second_delays").hide().css("display", "revert");
}else{
$(".second_delays").hide().css("display", "none");
}

});

});

</script>


