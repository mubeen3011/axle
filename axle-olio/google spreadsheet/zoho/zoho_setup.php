<?php
//ini_set("display_errors",1);
$dir1 = "../../";
include_once($dir1 . "config.php");
include_once($dir1 . "app_top.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>

    <title>Zoho Setup</title>
    <?php include($dir1 . "includes/cssfiles_newui.php"); ?>
    <script type="text/javascript" src="../../../accounts/valid_variable_name.js"></script>
    <script language="javascript" src="../../includes/js/up.js"></script>
    <script language="javascript" src="../../includes/js/advance.settings.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>themes/multiple-select/multiple-select.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>includes/avidtrak_ui_jquery_1.11.1/css/at_bootstrap-switch.css">
    <script type="text/javascript" src="<?= SITE_URL ?>themes/multiple-select/jquery.multiple.select.js"></script>

   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    
    
    <script type="text/javascript">
        //---------------------------------------------------------------------------------------------------------
        $(document).ready(function() {

            $('li > a').click(function() {
                $('li').removeClass("actives");
                $(this).parent().addClass('actives');
            });

            page_load_ajax('zoho_account_info.php');
        });

        function ValidateEmailAddress(mail) {
            if (/^\w+([\.-]?\ w+)*@\w+([\.-]?\ w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true);
            } else {
                return false;
            }
        }

        function page_load_ajax($file_name) {

            $.post($file_name, '', function(data) {
                start_loader();
                $('#page_ajax').html(data);
                $("input[type=checkbox]").bootstrapToggle();
                end_loader();
            });

        }

        function end_loader() {
            $(".loading_img").hide();
            $(".overlay").hide();
        }

        function start_loader() {
            $(".loading_img").show();
            $(".overlay").show();
        }

        function flash_msg(val, html) {
            var msg = "";
            if (val == "1") {
                msg = "<div class='alert alert-success'><strong>Success! </strong>" + html + "</div>";
            } else {
                msg = "<div class='alert alert-danger'><strong>Danger! </strong>" + html + "</div>";
            }
            $('#flash_msg').html(msg)

            setTimeout(function() {
                $('#flash_msg').html('');
            }, 5000);
        }
    </script>
    <style type="text/css">
        /* <![CDATA[ */
        #steps {
            color: #B3B1B1;
            font-size: 13px;
            font-weight: bold;
            margin-left: 20px;
        }

        .dashboardsettings {
            padding: 5px 5px 5px 5px;
            border: 1px solid #D0D0D0;
        }

        #sidebar-wrapper {

            background: #f5f5f5;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
            border: 1px solid #D0CDD7 !important;
        }

        /* Sidebar Styles */

        .sidebar-nav li {
            text-indent: 20px;
            line-height: 40px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #6E6B69;
        }

        .sidebar-nav li a:hover {
            text-decoration: none;
            color: #6E6B69;
            background: #d6d5d4;
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
            text-decoration: none;
            background: #d6d5d4;
        }

        .actives {
            text-decoration: none;
            background: #d6d5d4;
        }

        .sidebar-nav>.sidebar-brand {
            height: 65px;
            font-size: 18px;
            line-height: 60px;
        }

        .sidebar-nav>.sidebar-brand a {
            color: #999999;
        }

        .sidebar-nav>.sidebar-brand a:hover {
            color: #fff;
            background: none;
        }

        .alert alert-danger {
            color: red !important;
        }

        .alert alert-success {
            color: darkgreen !important;
        }
    </style>


</head>

<body>
    <div id="wrapper">
        <div id="page-body">
            <div class="container-fluid">
                <div id="content">
                    <?php include($dir1 . "includes/client_nav_newui.php"); ?>
                    <div class="clearingfix"></div>
                    <div class="row">
                        <div class="col-md-3">
                        <div class="connected" style="visibility: hidden;">
                            <div id="sidebar-wrapper">
                                <ul class="sidebar-nav">
                                    <li class="actives"><a href="javascript:void(0)" onclick="page_load_ajax('zoho_account_info.php')">Account Info</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('zoho_integration_options.php')">Integration Options</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('zoho_lead_options_setting.php')">Lead Options Setting</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('zoho_default_lead_owner.php')">Default Lead Owner</a></li>
                                    <!-- <li><a href="javascript:void(0)" onclick="page_load_ajax('task_options.php')">Task Options</a></li> -->
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('zoho_routers.php')">Salesforce User/Alias Assignment</a></li>
                                    <!-- <li><a href="javascript:void(0)" onclick="page_load_ajax('field_mapping.php')">Field Mapping</a></li> -->
                                    <!-- <li><a href="javascript:void(0)" onclick="page_load_ajax('task_mapping.php')">Task Mapping</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('lead_mapping.php')">Lead Mapping</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('contact_mapping.php')">Contact Mapping</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('campaign_mapping.php')">Campaign Mapping</a></li> -->
                                    <!-- 
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('associate_campaigns.php')">Associate Campaigns</a></li>  
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('import_past_data.php')">Import Past Data</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('configure_open_cti.php')">Configure Open CTI</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('configure_call_tab.php')">Configure Calls Tab</a></li>
                                    <li><a href="javascript:void(0)" onclick="page_load_ajax('single_sign_on.php')">Single Sign-ON</a></li> -->
                                </ul>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-9">
                            <div id="showtable">
                                <script type="text/javascript" src="/accounts/includes/js/script.js"></script>
                                <?php
                                if ($msg != "") {
                                    echo "<div style=\"color:darkgreen;font-weight:bold;\">";
                                    echo $msg;
                                    echo "</div>";
                                    echo "<div id='disallow' style='display: none; width: 700px; height:auto; overflow-style: scrollbar; overflow: scroll;'>";
                                    echo $_SESSION["disallow_prefix"];
                                    echo "<br><a href='javascript:' onclick='$(\"#disallow\").hide();'>Hide</a>";
                                    echo "</div>";
                                }
                                ?>
                                <div id="page_ajax">
                                    <span class="loading_img" style="display:none;"><img src="<?= SITE_URL ?>themes/images/loader_2.gif" alt="" align="absmiddle" /> Loading...</span>
                                    <?php include("account_setting.php"); ?>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <!-- Sidebar -->


                    <div id="showtable2"></div>
                    <button name="reload" style="display: none;" id="reload" onclick="load_dashboard(<?= $_SESSION["user"]["show_adword"] ?>);"></button>
                   
                    <?php include($dir1 . 'includes/footer_newui.php'); ?>


</body>


<script>
var url = document.location.protocol+'//'+jQuery.url.attr("host")+'/'+jQuery.url.segment(0)+'/integrate/zoho/zoho_execute_query.php';
$.ajax({
type: "GET",
url: url,
data: {task:'zoho_connected'},
dataType : "json",
success: function(msg){ 
if(msg.status == "success"){
if(msg.status_active == 1){
$(".connected").hide().css("display", "revert");
}else{
$(".connected").css("visibility", "hidden");
}
}else{
$(".connected").css("visibility", "hidden");
}
},
error: function(XMLHttpRequest, textStatus, errorThrown)
{
}
});

</script>

</html>
