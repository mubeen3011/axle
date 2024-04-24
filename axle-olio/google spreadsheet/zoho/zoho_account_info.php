<?php
//ini_set("display_errors",1);
?>
<style>
    hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border-top: 1px solid #eee;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Account
                Info</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-3">
                        <hr><label>Name</label><br><hr>
                        <span class="name"></span>
                    </div>
                    <div class="col-md-3">
                        <hr><label>Email</label><br><hr>
                        <span class="email"></span>
                    </div>
                    <div class="col-md-3">
                        <hr><label>Phone</label><br><hr>
                        <span class="contact"></span>
                    </div>
                    <div class="col-md-3">
                        <hr><label>Instance Url</label><br><hr>
                        <span class="instance_url"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-12" >
                    <div style="float: left;">
                       
                    </div>
                    <div style="float: right;padding-right: 5px">
                    <button id="pause" data-active="0" type="button" class="btn btn-primary pause" style="display: none;">Pause Integration</button> 
                      
                        <!-- <button type="button" class="btn btn-danger">Unlink Account...</button> -->

                        <!-- <span class="salesforce_login" style="display: none;">
                            <button id="salesforces" class="btn btn-danger">Setup...</button>
                        </span> -->
                        <!-- <span class="panel-footer salesforce_delete" style="display: none;">
                            <button id="salesforces_delete" class="btn btn-danger">Unlink Account...</button>
                        </span> -->
                        <?php $scope = "ZohoCRM.modules.custom.all,ZohoCRM.modules.contacts.all,ZohoCRM.modules.accounts.all,ZohoCRM.modules.deals.all,ZohoCRM.modules.events.all,ZohoCRM.modules.tasks.all,ZohoCRM.modules.calls.all,ZohoCRM.modules.invoices.all,ZohoCRM.modules.pricebooks.all,ZohoCRM.modules.salesorders.all,ZohoCRM.modules.purchaseorders.all,ZohoCRM.modules.products.all,ZohoCRM.modules.cases.all,ZohoCRM.modules.solutions.all,ZohoCRM.modules.vendors.all,ZohoCRM.modules.quotes.all,ZohoCRM.modules.ALL,ZohoCRM.settings.ALL,ZohoCRM.users.ALL,ZohoCRM.org.ALL,aaaserver.profile.ALL,ZohoCRM.settings.functions.all,ZohoCRM.functions.execute.read,ZohoCRM.functions.execute.create,ZohoCRM.settings.layout_rules.read,ZohoCRM.notifications.all,ZohoCRM.settings.fields.READ,ZohoCRM.settings.fields.ALL,ZohoCRM.coql.READ,ZohoMarketingAutomation.lead.ALL"; ?>
                        <div class="panel-footer zoho_login">
                            <a id="zoho" href="https://accounts.zoho.com/oauth/v2/auth?scope=<?=$scope?>&client_id=1000.0FK7N8VB8Z3G7G1V8OKH3S65NIUCSR&response_type=code&access_type=offline&redirect_uri=https://app.avidtrak2.com/accounts/integrate/zoho/zoho_setup.php" class="btn downloadBtn"
                                data-toggle="tooltip" data-placement="bottom"
                                title="">Setup
                            </a>
                        </div>
                        
                        <span class="panel-footer zoho_delete" style="display: none;">
                           
                            <button id="zoho_deleted" class="btn btn-danger">Unlink Account...</button>
                        </span> 

                    </div>
                </div>
            </div>
        </h3>
    </div>
</div>
<div class="connected" class="connected" style="visibility: hidden;">
<?php include( "zoho_integration_options.php"); ?>
<?php include( "zoho_lead_options_setting.php"); ?>
<?php include( "zoho_default_lead_owner.php"); ?>
<?php include( "task_options.php"); ?>
<?php include( "zoho_routers.php"); ?>
<?php include( "field_mapping.php"); ?>
<?php include( "zoho_lead_mapping.php"); ?>
<?php include( "zoho_task_mapping.php"); ?>
<?php include( "contact_mapping.php"); ?>
<?php include( "campaign_mapping.php"); ?>
<?php include( "associate_campaigns.php"); ?>
<?php include( "import_past_data.php"); ?>
<?php include( "configure_open_cti.php"); ?>
<?php include( "configure_call_tab.php"); ?>
<?php include( "single_sign_on.php"); ?>
</div>
<script>


if($("input[name='username']").val() != 'undefined' && $("input[name='username']").val() != ''){
$("#zoho").text('Connect');
}else{
$("#zoho").text('Setup');
}




$(document).ready(function(){
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
 

$("#zoho").click(function(){
    window.location.replace(document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_setup.php');
});
  
$.ajax({
type: "GET",
url: url,
data: {task:'zoho_connected'},
dataType : "json",
success: function(res){ 
//console.log(res.response);
//alert();

$(".name").html(res.response.user_id);
$(".contact").html(res.response.contact);
$(".instance_url").html(res.response.instance_url);
$('#pause').attr('data-active', res.response.active);
var emails = res.response.email.replace(/\s/g,'').split(",");

$(".email").html(emails[0]);


if(res.status == "success"){
if(res.status_active == 1){
$('#pause').text('Pause Integration');
$('#pause').attr('name', res.status);
}else{
 $('#pause').text('Activate Integration');
 $('#pause').attr('name', '0'); 
}

$(".zoho_login").hide().css("display", "none");
$(".zoho_delete").hide().css("display", "revert");
$("#pause").hide().css("display", "revert");
}else{
   
$(".zoho_login").hide().css("display", "revert");
$(".zoho_delete").hide().css("display", "none");
}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});

$("#pause").click(function(){
//var status =  $('#pause').attr('name');
var status = $('#pause').attr('data-active');
$.ajax({
type: "POST",
url: url,
data: {task:'zoho_connection_active', status: status},
dataType : "json",
success: function(res){

console.log(res.msg);
if(status == 1){
    $('#pause').attr('data-active', '0');
}else{
    $('#pause').attr('data-active', '1');
}
    
toastr.success(res.msg);
if(res.response == 1){
    $('#pause').text('Pause Integration');
    $('#pause').attr('name', '1');
   // $('#pause').attr('data-active', '0');
}else{
    $('#pause').text('Activate Integration');
    $('#pause').attr('name', '0');
   // $('#pause').attr('data-active', '1');
}

setTimeout(function(){
    window.location.reload(1);
}, 3000);

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    toastr.error(errorThrown);
}
});   
}); 



//connect button work
$("#zoho_deleted").click(function(){
   
$.ajax({
type: "POST",
url: url,
data: {task:'zoho_delete_connection'},
dataType : "text",
success: function(msg){
    toastr.success(msg);
    setTimeout(function(){
    window.location.reload(1);
}, 3000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    toastr.error(errorThrown);
}
});  
});    
//end code salesforce delete connection

//start code make connection
const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('code');
const location = urlParams.get('location');
const accounts_server = urlParams.get('accounts-server');
if(myParam != null){    
$.ajax({
type: "GET",
url: url,
data: {task:'zoho_integration', code:myParam, location:location, accounts_server:accounts_server},
dataType : "json",
success: function(msg){
    toastr.success(msg);
    setTimeout(function(){
        //salesforce_connected();
      //  
    
        window.location.replace(document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_setup.php');
        
    }, 1000);
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});
}
//end code make connection  

//start code app connected or not
// var salesforce_connected = function(){
$.ajax({
type: "GET",
url: url,
data: {task:'zoho_connected'},
dataType : "json",
success: function(msg){ 
if(msg.status == "success"){
$(".zoho_login").hide().css("display", "none");
$(".zoho_delete").hide().css("display", "revert");
$(".salesforce_setup").hide().css("display", "revert");
if(msg.status_active == 1){
    $(".connected").css("visibility", "visible");
}else{
    $(".connected").css("visibility", "hidden");
}


}else{
$(".zoho_login").hide().css("display", "revert");
$(".zoho_delete").hide().css("display", "none");
$(".salesforce_setup").hide().css("display", "none");
$(".connected").hide().css("display", "none");
}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});
//}




//end code app connected or not






});



</script>
