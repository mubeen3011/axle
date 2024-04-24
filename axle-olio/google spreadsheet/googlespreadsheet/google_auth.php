<?php
$dir1 = "../";
include_once($dir1 . "config.php");
include_once($dir1 . "app_top.php");

?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

     <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<div class="panel panel-default" style="min-height: auto">

    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Export Data To Google Drive</a>
        </h3>
    </div>
    <div id="collapseSide" class="panel-collapse collapse" aria-expanded="true" style="height: 0px; display:inline;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <hr><label>Name</label><br><hr>
                        <span class="name"></span>
                    </div>
                    
                    <div class="col-md-3">
                        <hr><label>Email</label><br><hr>
                        <span class="email"></span>
                    </div>
                    
                    <div class="col-md-2">
                        <hr><label>Phone</label><br><hr>
                        <span class="contact"></span>
                    </div>
                    
                    <div class="col-md-5">
                        <hr><label>Instance Url</label><br><hr>
                        <p><span class="instance_url"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" role="alert" style="margin-bottom : 0px">
            <!-- <h4 class="alert-heading">Well done!</h4>  -->
            <p style="color: #6E6B69;">AvidTrak requires full access to your Google drive to push call data into your Google drive. We recommend that you create a secondary Google account and connect the secondary account with AvidTrak. The secondary Google account may share its files and folders with your main account.</p>
        </div>
    </div>

    <div class="panel-footer">
        <h3 class="panel-title">
            <div class="row">
                    <div class="col-md-12" >
                        <div style="float: right;padding-right: 5px">
                        <button id="pause" type="button" class="btn btn-primary" style="display: none;">Pause Integration</button> 
                        <div class="panel-footer google_login">
                            <a id="showAlert" class="btn downloadBtn" data-toggle="tooltip" data-placement="bottom"title="">Setup</a>
                            <div id="confirmDialog" title="Google Confirm">
                            <p>AvidTrak-Google sheets integration allows view, add, edit, and delete permissions of your Google account. Your permission is required to save AvidTrak's Call Data into your Google Sheets account. Do you grant AvidTrak permission to access your Google Drive Account? Granting permission will allow AvidTrak to create CSV data log sheets with your primary information.</p>
                            </div>
                        </div>
                        
                        <span class="panel-footer google_delete" style="display: none;">
                            <button id="google_deleted" class="btn btn-danger">Unlink Account...</button>
                        </span> 
                    </div>

                    

                            
                </div>
            </div>
        </h3>
    </div>
</div>
        <?php 
            if(isset($_REQUEST['task']) && !empty($_REQUEST['task'])){
            include( "data/export_google_setting.php"); 
            }
            ?>

        <div id="showtable2"></div>
            <button name="reload" style="display: none;" id="reload" onclick="load_dashboard(<?= $_SESSION["user"]["show_adword"] ?>);"></button>
            <?php include($dir1 . 'includes/footer_newui.php'); ?>
<script type="text/javascript">
    <?php if($delete_record_time['delete_record_time'] ){ ?>
    getallphonenumber();
    <?php }?>



    function delete_record_time_setting() {
        if (confirm("Are you certain you want to give your call information to your google drive account?")) {
            if (confirm("Are you certain you want to give your call information to your google drive account?")) {
                $.post("/accounts/integrate/googlespreadsheet/execute_query.php", $("form[name=delete_records]").serialize(),
                    function (data) {
                        flash_msg(1 ,data)
                    });
            }
        }
    }

$(document).ready(function(){
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/googlespreadsheet/oauth2callback.php';


$.ajax({
type: "GET",
url: url,
data: {task:'google_connected'},
dataType : "json",
success: function(res){ 

$(".name").html(res.response.user_id);
$(".contact").html(res.response.contact);
$(".instance_url").html(res.response.instance_url);
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

$(".google_login").hide().css("display", "none");
$(".google_delete").hide().css("display", "revert");
$("#pause").hide().css("display", "revert");
}else{
   
$(".google_login").hide().css("display", "revert");
$(".google_delete").hide().css("display", "none");
}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});



$("#pause").click(function(){

var status =  $('#pause').attr('name');
$.ajax({
type: "POST",
url: url,
data: {task:'google_connection_active', status: status},
dataType : "json",
success: function(res){
    console.log(res.msg);
    toastr.success(res.msg);
if(res.response == 1){
    $('#pause').text('Pause Integration');
    $('#pause').attr('name', '1');
}else{
    $('#pause').text('Activate Integration');
    $('#pause').attr('name', '0');
}

},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
    toastr.error(errorThrown);
}
});   
}); 

//end code salesforce delete connection
$("#google_deleted").click(function(){
   
   $.ajax({
   type: "POST",
   url: url,
   data: {task:'google_delete_connection'},
   dataType : "text",
   success: function(msg){
       toastr.success(msg);
       setTimeout(function(){
       window.location.reload(1);
   }, 2000);
   },
   error: function(XMLHttpRequest, textStatus, errorThrown)
   {
       toastr.error(errorThrown);
   }
   });  
});    
   


 // Initialize the dialog but keep it hidden
 $("#confirmDialog").dialog({
    autoOpen: false,
    modal: true,
    buttons: {
      Yes: function() {
        // Handle "Yes" button click here
        $(this).dialog("close");
        window.location.href = "<?= $Config->BASE_URL ?>/accounts/integrate/googlespreadsheet/oauth2callback.php?task=google_auth";
        
      },
      No: function() {
        // Handle "No" button click here
        $(this).dialog("close");
        
      }
    }
  });

  // Show the dialog when the "Show Alert" button is clicked
  $("#showAlert").click(function() {
    $("#confirmDialog").dialog("open");
  });

});




 

</script>
