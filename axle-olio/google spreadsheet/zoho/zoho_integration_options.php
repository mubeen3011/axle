

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a aria-expanded="false" class="accordion" data-toggle="collapse" data-parent="#" href="javascript:void(0)">Zoho Integration Option</a>
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
                            <input type="checkbox" class="integration_option_zoho" data-toggle="toggle" value="caller_id" id="caller_id">
                        </div>
                        </div> 
                        Only add data when caller ID data is available
                    </label>
                </div>
                <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                        <!-- mubeen siddiqui adding switching button -->
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option_zoho" data-toggle="toggle" value="call_begin" id="call_begin">
                        </div>    
                        </div>
                        Add lead or Activity as the call begins
                    </label><br/>
                    <!-- <p style="color:darkgray">&nbsp;&nbsp;&nbsp;When not using a call queue, this option will automatically create a lead on call start</p> -->
                </div>

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                       
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option" data-toggle="toggle" value="lead_adding" id="lead_adding">
                        </div>    
                        </div>
                        Prompt when adding a lead
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;This will prompt you to choose to add the caller information to an existing lead when manually adding new calls as leads</p>
                </div> -->

                <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                            <!-- mubeen siddiqui adding switching button -->
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option_zoho" data-toggle="toggle" value="saleforce_compaign" id="zoho_compaign">
                        </div>    
                        </div>
                        Associate Zoho Campaigns to records we create
                    </label>
                </div>

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                           
                        <div class="btn-group btn-toggle"> 
                        <input type="checkbox" class="integration_option" data-toggle="toggle" value="local_number_format" id="local_number_format">    
                        </div>     
                        </div>
                        Use local number formats instead of <a href="">E.164</a>
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;e.g. instead of +112344545454 use (123)456-7890</p>
                </div> -->

                <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                             <!-- mubeen siddiqui adding switching button -->
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option_zoho" data-toggle="toggle" value="lead_object" id="lead_object">
                        </div>     
                        </div>
                        Insert a new 'Lead' object instead of updating a matching 'Lead' object
                    </label>
                </div>

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                             
                        <div class="btn-group btn-toggle"> 
                        <input type="checkbox" class="integration_option" data-toggle="toggle" value="edit_conflicts" id="edit_conflicts">    
                        </div>     
                        </div>
                        Avoid Session edit conflicts
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;When using OpenCTI, this will defer CTM-related updates to lead records</updates></p>
                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                       
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option" data-toggle="toggle" value="region_name" id="region_name">
                        </div>     
                        </div>
                        Use full region names (e.g. 'United state' instead of 'US' and 'California' instead of 'CA')
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;You may need this if you are using pickless for countries and states</p>
                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                            
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option" data-toggle="toggle" value="saleforce_edit_mode" id="saleforce_edit_mode">    
                        </div>     
                        </div>
                        Open Salesforce records in edit mode
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;This will open the lead/contact records in edit mode. this can cause locking issues if you experience then turn this open off. NOTE: this option is currently not supported in lightning.</p>
                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                             
                        <div class="btn-group btn-toggle"> 
                            <input type="checkbox" class="integration_option" data-toggle="toggle" value="saleforce_overwrite_field" id="saleforce_overwrite_field">    
                        </div>     
                        </div>
                        Overwrite Salesforec fields that are not blank
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;Enabling this option will allow overwriting Salesforec fields that already have data except for OwnerId. The default is to not overwrite data.</p>

                </div> -->

                <!-- <div class="col-md-12">
                    <label class="btn" for="input_active" onclick="">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-id-round_robin bootstrap-switch-animate bootstrap-switch-off" >
                            
                        <div class="btn-group btn-toggle"> 
                        <input type="checkbox" class="integration_option" data-toggle="toggle" value="limit_data_access" id="limit_data_access">    
                        </div>     
                        </div>
                        Limit Data Access
                    </label>
                    <p style="color:darkgray">&nbsp;&nbsp;&nbsp;Limit log access to account administrators only .</p>
                </div> -->
                <div class="panel-footer">
                    
                    <h3 class="panel-title">
                        <div class="row">
                            <div class="col-md-12" >
                                <button type="submit" class="btn btn-primary" id="formoid" style="margin-top: 15px;">Save Integration Options</button>
                            </div>
                        </div>
                    </h3>
                </div>    
            

            </div>
            
        </div>
    </div>
    
</div>

<script>
$(document).ready(function(){
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
$("#formoid").click(function(){
var checked = '';
$('.integration_option_zoho:checked').each(function(){        
    var values = $(this).val();
    checked += values+",";
});
$.ajax({
    type: "POST",
    url: url,
    data: {task:'zoho_setup',checked:checked},
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
    data: {task:'zoho_setup_edit'},
    dataType : "json",
    success: function(msg){
         
    $('.integration_option_zoho').each(function(){
       
         var id = $(this).attr('id');
      //  alert(id);
           var arr = Object.entries(msg[id]);
           //alert(arr[0][1]);
        if(arr[0][1] == 1){  
             //$('#'+id).attr('checked', true);
             $('#'+id)[0].checked = true;
             $('#'+id).parent().removeClass('btn-default off') 
             $('#'+id).parent().addClass('btn-primary') 
         }
    });
    },
    error: function(XMLHttpRequest, textStatus, errorThrown)
    {
        
    }
});

});

</script>
