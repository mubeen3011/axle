<?php

//ini_set("display_errors",1);
$dir1 = "../../";
include_once($dir1 . "config.php");
include($dir1 . "app_top.php");
//include_once($dir1 . "includes/classes/func.class.php");
//include_once($dir1 . "includes/classes/Message.class.php");


$Zoho = new ZohoApi();


/********************** zoho insertion making connection *******************************/
if ($_REQUEST['task'] == 'zoho_integration') {

     if(!empty($_REQUEST['code'])){
        $code = $_REQUEST['code'];
        $location = $_REQUEST['location'];
        $accounts_server = $_REQUEST['accounts_server']; //url of account server
       
        $results = $Zoho->make_connention_zoho($code, $location, $accounts_server, $method="POST");
        echo json_encode($results['msg']);          
     }
}
/********************** zoho insertion making connection end*******************************/


/********************** zoho checking app connected aur not *******************************/
if ($_REQUEST['task'] == 'zoho_connected') {
   
    $results = $Zoho->get_zoho_connected_app();
    if($results['status'] == "success"){
        echo json_encode($results);
    }else{
        echo json_encode(0);
    }     
}
/********************** zoho checking app connected aur not *******************************/


/********************** zoho delete connection *******************************/
if ($_POST['task'] == 'zoho_delete_connection') {
     
    $results = $Zoho->delete_connention_zoho();
    echo json_encode($results['msg']);        
 
}
/********************** zoho delete connection end*******************************/



/********************** zoho app status *******************************/
if ($_POST['task'] == 'zoho_connection_active') {

    $results = $Zoho->connected_app_status_active_deactive($_POST['status']);
    if($results['status'] == "success"){
        echo json_encode($results);
    }else{
        echo json_encode("something are wrong");
    }     
}
/********************** zoho app status *******************************/


/********************** zoho_setup insertion and update *******************************/
if ($_POST['task'] == 'zoho_setup') {   
    
    // if(isset($_POST['checked']) && !empty($_POST['checked'])){
         $results = $Zoho->insert_zoho_integration_option($_POST['checked']);
         echo json_encode($results['msg']);
    // }
 }
 /********************* zoho_setup insertion  end ****************************/


/********************** zoho_setup edit **************************/
if ($_REQUEST['task'] == 'zoho_setup_edit') {
    $results = $Zoho->insert_zoho_integration_option_edit();
    echo json_encode($results[0]);    
}

/********************** zoho_setup edit end *********************/


/*********************************** campaign mapping get **************************************************/
if ($_REQUEST['task'] == 'getcampaign') {
    $results = $Zoho->getCampaigns();
    echo json_encode($results);   

}
/*********************************** campaign mapping get *************************************************/



/************************ lead option insertion and update ********************************/
if ($_POST['task'] == 'lead_option') {
    if(isset($_POST) && !empty($_POST)){
        
        $results = $Zoho->insert_zoho_lead_option($_POST['checked'], $_POST);
        echo json_encode($results['msg']);
    }
}
/************************* lead option insertion and update end ****************************/



/************************* lead option edit ***************************/
if ($_REQUEST['task'] == 'lead_option_edit') {
    $results = $Zoho->insert_zoho_lead_option_edit();
    echo json_encode($results[0]);    
}
/*********************** lead option edit end ***********************/



/********************** zoho get data from api users field*******************************/
if ($_REQUEST['task'] == 'user_mapping_from_zoho') {
    
    $results = $Zoho->get_users_from_api();
    
    if($results['status'] == "success"){
        
        echo json_encode($results['response']);
    }else{
        echo json_encode("something are wrong");
    }     
}
/********************** zoho get data from api users *******************************/



/********************** default lead owner insertion and update **************************/
if ($_POST['task'] == 'default_lead_owner') {
    if(isset($_POST) && !empty($_POST)){
        $results = $Zoho->insert_zoho_default_lead_owner($_POST);
        echo json_encode($results['msg']);
    }
}
/********************** default lead owner insertion and update ******************************/


/********************** default lead owner edit **************************/
if ($_REQUEST['task'] == 'default_lead_owner_edit') {
    $results = $Zoho->insert_zoho_default_lead_owner_edit();
    echo json_encode($results[0]); 
}
/********************** default lead owner edit ******************************/


/******************************** user alias dynamic form insertion and update *****************************/
if ($_POST['task'] == 'user_alias') {
    $results = $Zoho->insert_user_alias($_POST);
    echo json_encode($results['msg']);  
}
/***************************** user alias dynamic form insertion and update ********************************/

if ($_REQUEST['task'] == 'user_alias_edit') {
    $results = $Zoho->edit_user_alias();
    echo json_encode($results);  
}


/********************** zoho get data from api leads field*******************************/
if ($_REQUEST['task'] == 'field_mapping_from_zoho') {
    
    $results = $Zoho->get_lead_field_from_api($_REQUEST['api_name']);
    if($results['status'] == "success"){
        echo json_encode($results['response']);
    }else{
        echo json_encode("something are wrong");
    }     
}
/********************** zoho get data from api leads field *******************************/


/********************** lead mapping dynamic form insertion and update **************************/
if ($_POST['task'] == 'lead') {
    if(count(array_unique($_POST['zoho_value']))<count($_POST['zoho_value']))
    {
        echo json_encode(array('status' => false, 'msg' => "can't save duplicate custom field into column"));  
    }
    else
    {
        $results = $Zoho->insert_lead_mapping($_POST);
        echo json_encode(array('status' => true, 'msg' => $results['msg']));  
    // Array does not have duplicates
    }
}
/********************** lead mapping dynamic form insertion and update **************************/


/******************************************** lead mapping edit **************************************************/
if ($_REQUEST['task'] == 'lead_mapping_edit') {
    $results = $Zoho->edit_sfmapping_edit($_REQUEST['mapping_type']);
    echo json_encode($results);  
}
/******************************************** lead mapping edit *************************************************/


/********************** task mapping dynamic form insertion and update **************************/
if ($_POST['task'] == 'task') {

    if(count(array_unique($_POST['zoho_value']))<count($_POST['zoho_value']))
    {
        echo json_encode(array('status' => false, 'msg' => "can't save duplicate custom field into column"));  
    }
    else
    {
        $results = $Zoho->insert_lead_mapping($_POST);
        echo json_encode(array('status' => true, 'msg' => $results['msg']));  
    // Array does not have duplicates
    }

    
}
/********************** task mapping dynamic form insertion and update **************************/


/********************** task option edit **************************/
if ($_REQUEST['task'] == 'task_mapping_edit') {
    $results = $Zoho->edit_sfmapping_edit($_REQUEST['mapping_type']);
    echo json_encode($results);  
}
/********************** lead mapping edit **************************/




