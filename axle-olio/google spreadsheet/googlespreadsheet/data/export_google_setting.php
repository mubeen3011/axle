<style>
    select.form-control {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>
<div class="connection_exist_form">
    <div class="panel panel-default" id="panel_default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Google Export Data Setting</a>
            </h3>
        </div>

        <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
            <div class="panel-body">
                <div class="row">
                    <input type="hidden" id="id" value=""/>
                    <div class="col-md-12">
                        <label class="btn" for="input_active">Report Type</label><br/>
                            <div class="col-md-6">
                                <select class="form-control report_type" required>
                                    <option disabled="disabled" seleted="seleted">  Select Option </option>
                                        <option value="call_log"> Call Log </option>
                                            <!-- <option value="visit_log"> Visit Log </option> -->
                                        <!-- <option value="campaign"> Campaign </option> -->
                                    <option value="all_print_call"> All Print Call </option>
                                </select>
                            </div>
                    </div>

                    <div class="col-md-12">
                        <label class="btn" for="input_active">Report Interval</label><br/>
                        <div class="col-md-6">
                            <select class="form-control report_interval" required>
                                <option disabled="disabled" seleted="seleted">Select Option</option>
                                    <option value="minute">30 Minute</option>
                                        <option value="hourly">Hourly</option>
                                            <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        <option value="quaterly">Quaterly</option>
                                    <option value="yearly">Yearly</option>
                                 </select>
                             <span id="second_delay"><input class="form-control second_delays" style="width: 100px; display: none;" type="text" name="delay" id="delay" value="1" size="4" maxlength="1"></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        
        <div class="panel-footer">
            <h3 class="panel-title">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="google_cron_save" class="btn btn-primary">Update Setting</button>
                    </div>
                </div>
            </h3>
        </div>

    </div>
</div>

    <div class="connection_exist_table">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Google Export Data Setting Views</a>
                </h3>
            </div>
            <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table align="center" cellpadding="0" cellspacing="0" width="100%" class="col-md-12 table table-hover table-bordered table-striped table-condensed cf dataTable no-footer">
                                    <thead>
                                        <tr><th width="10">#</th>
                                                <th width="200">Report Type</th>
                                                    <th>Report Interval</th>
                                                <th>DateTime</th>
                                            <th>Status</th>
                                        <th></th></tr>
                                    </thead>
                                <tbody id="results"></tbody></table>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="panel-footer">
                    <h3 class="panel-title">
                        <div class="row">
                        
                        </div>
                    </h3>
                </div>
            
            </div>
    </div>
</div>
<script>
 $(document).ready(function(){
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/googlespreadsheet/oauth2callback.php';
$(".report_type").select2({})
  $(".report_interval").select2({})
  $('.report_type').val('').trigger('change');
  $('.report_interval').val('').trigger('change');
 
$('.report_interval').change(function() {
if($(this).val() == "hour"){
$(".second_delays").hide().css("display", "revert");
}else{
$(".second_delays").hide().css("display", "none");
}
});


$("#google_cron_save").click(function(){
var report_type = $(".report_type :selected").val();
var report_interval = $(".report_interval :selected").val();
var id = $("#id").val();


$.ajax({
type: "POST",
url: url,
data: {task:'google_setting_save', id:id, report_type:report_type, report_interval: report_interval},
dataType : "json",
success: function(msg){

    if(msg.status == "success"){
    $("#results").empty();
    toastr.success(msg.msg);
    page_setting_view();
    $('.report_type').val('').trigger('change');
  $('.report_interval').val('').trigger('change');
  $("#id").val('');
    }else{
    toastr.warning(msg.msg);   
    }

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
toastr.error(errorThrown);
}
});     
});


function page_setting_view() {

var url1 = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/googlespreadsheet/oauth2callback.php';
$.ajax({
type: "GET",
url: url,
data: {task:'google_setting_view'},
dataType : "text",
success: function(msg){
    $("#results").append(msg);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    alert(errorThrown);
}
});

}
page_setting_view();


$.ajax({
type: "GET",
url: url,
data: {task:'google_connected'},
dataType : "json",
success: function(res){ 
    console.log(res);
if(res.status_active == "1"){
    $(".connection_exist_form").hide().css("display", "revert");
    $(".connection_exist_table").hide().css("display", "revert");
}else{
    $(".connection_exist_table").hide().css("display", "none");
    $(".connection_exist_form").hide().css("display", "none");
  
}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});



});

var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/googlespreadsheet/oauth2callback.php';

function page_setting_view() {

$.ajax({
type: "GET",
url: url,
data: {task:'google_setting_view'},
dataType : "text",
success: function(msg){
    $("#results").append(msg);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    alert(errorThrown);
}
});

}


function myFunction(id) {

$.ajax({
type: "POST",
url: url,
data: {task:'google_setting_row_delete', id:id},
dataType : "json",
success: function(msg){
toastr.success(msg);
$("#results").empty();
page_setting_view();
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
toastr.error(errorThrown);
}
});     

}


function myFunctionedit(id) {
$.ajax({
type: "GET",
url: url,
data: {task:'google_setting_row_edit', id:id},
dataType : "json",
success: function(msg){
console.log(msg);

 $("#id").val(msg.id);
 $(".report_type").val(msg.report_type).change();
 $(".report_interval").val(msg.report_interval).change();
 
$('html,body').animate({
    scrollTop: 340
}, 'slow');

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{

}
});     

}





</script>


 
