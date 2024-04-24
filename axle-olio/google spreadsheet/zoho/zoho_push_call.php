<?php


$dir1 = "../../";
include_once($dir1 . "config.php");
include($dir1 . "app_top.php");



$Zoho = new ZohoApi();



if (isset($_REQUEST['customer_id']) && isset($_REQUEST['callsid'])) {
    
    if(isset($_REQUEST['call_status']) && $_REQUEST['call_status'] == $Zoho::$start){
        //0 is cd_salesforce_update;
        $result = $Zoho->get_call_now($_REQUEST['customer_id'], $_REQUEST['callsid'], 0);
        
        foreach($result as $data) {
        if(isset($data) && empty($data['zoho_update'])){
            $Zoho->push_call_insert($data);
         }
        }
    }
    elseif(isset($_REQUEST['call_status']) && $_REQUEST['call_status'] == $Zoho::$end){
        //1 is cd_salesforce_update;
        $result = $Zoho->get_call_now($_REQUEST['customer_id'], $_REQUEST['callsid'], 1);
        foreach($result as $data) {
            if(isset($data) && !empty($data['zoho_update'])){
            $Zoho->push_call_update($data);
         }   
        }
    }else{
        $result = $Zoho->get_call_now($_REQUEST['customer_id'], $_REQUEST['callsid'], 0);
         
    }
           
}














?>