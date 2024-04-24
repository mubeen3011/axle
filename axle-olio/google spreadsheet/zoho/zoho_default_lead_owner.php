<style>
    select.form-control {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Default Lead Owner</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">

                <div class="col-md-12">
                    <label class="btn" for="input_active">Lead Owner Type</label><br/>
                    <div class="col-md-6">
                        <select class="form-control lead_owner_type">
                            <!-- <option value="Default">Default</option>
                            <option value="None">None</option> -->
                        </select>
                    </div>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;When no answer is provided. we will default to the user who linked to zoho.</p>
                </div>

            </div>

        </div>
    </div>
    
    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="default_lead_owner_save" class="btn btn-primary">Update Default Owner</button>
                </div>
            </div>
        </h3>
    </div>
</div>


<script>
$(document).ready(function(){
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
$("#default_lead_owner_save").click(function(){
event.stopImmediatePropagation();


var lead_owner_type = $(".lead_owner_type").val();
$.ajax({
    type: "POST",
    url: url,
    data: {task:'default_lead_owner',lead_owner_type:lead_owner_type},
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
data: {task:'user_mapping_from_zoho'},
dataType : "json",
success: function(res){ 

var options = res.map(function(val, ind){
var first_name = (val.First_Name) ? val.First_Name : "";
var last_name = (val.last_Name) ? val.last_Name : "";
return $("<option></option>").val(val.Id+'_'+first_name + " " + last_name).html(first_name + " " + last_name);
});
$('.lead_owner_type').append(options);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{

}
});



$.ajax({
type: "GET",
url: url,
data: {task:'default_lead_owner_edit'},
dataType : "json",
success: function(msg){
    //  alert(msg.lead_owner_type);return false;
console.log(msg);
if(msg){    
setTimeout(function() {
$(`.lead_owner_type option[value='${msg.lead_owner_type}']`).prop('selected', true);
}, 2000);
}

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    
}
});


});
</script>