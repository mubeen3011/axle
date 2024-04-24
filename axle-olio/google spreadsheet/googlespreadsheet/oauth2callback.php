<?php
  //ini_set('display_errors' , 1);
$dir1 = "../../";
include_once($dir1 . "config.php");
include_once($dir1 . "app_top.php");
$db = new PDB();

include_once $dir1 . "../myaccounts/vendor/autoload.php";
spl_autoload_register("__autoload");

use Google\Client;
use Google\Service\Drive;

$client = new Google\Client();
$client->setAuthConfig('data/client_secret_50288606169-2kljoirjoevi9kouvk9h5gt2th1fbhr0.apps.googleusercontent.com.json');
//$client->setAuthConfig('data/client_secret_449717736357-eh10sq87g30rb992p7hi23hvgdehr71u.apps.googleusercontent.com.json');
$client->addScope(Google_Service_Drive::DRIVE);
$client->addScope('https://www.googleapis.com/auth/userinfo.email');
$client->addScope('https://www.googleapis.com/auth/userinfo.profile');

$GoogleAuthApi = new GoogleAuthApi();


if ($_REQUEST['task'] == 'google_auth') {
   
//$client->addScope(Google\Service\Drive::DRIVE_FILE);
   

    $client->setRedirectUri('https://app.avidtrak2.com/accounts/integrate/googlespreadsheet/oauth2callback.php');
    // offline access will give you both an access and refresh token so that
    // your app can refresh the access token without user interaction.
    $client->setAccessType('offline');
    // Using "consent" ensures that your application always receives a refresh token.
    // If you are not using offline access, you can omit this.
    $client->setPrompt('consent');
    $client->setIncludeGrantedScopes(true);   // incremental auth
    
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

}


if(isset($_REQUEST['code']) && !empty($_REQUEST['code'])){
    
    $client->setRedirectUri('https://app.avidtrak2.com/accounts/integrate/googlespreadsheet/oauth2callback.php');
    $client->setAccessType('offline');
    $client->setApprovalPrompt("force");
    // Using "consent" ensures that your application always receives a refresh token.
    // If you are not using offline access, you can omit this.
    $client->setPrompt('consent');
    $client->setIncludeGrantedScopes(true);   // incremental auth
    $client->authenticate($_GET['code']);
    $access_token = $client->getAccessToken();
    
    //echo "<pre>";print_r($access_token);exit;
    $client1 = new Google\Client();
    $accessToken = $access_token;
    $client1->setAccessToken($accessToken['access_token']);
    // $service = new Google_Service_Oauth2($client1);
    // $userInfo = $service->userinfo->get();
   
    // $name = $userInfo->getName();
    // $email = $userInfo->getEmail();


    

    // Create a service object for the People API
    $peopleService = new Google_Service_PeopleService($client1);

    // Use the "people/me" special value to get information about the authenticated user
    $person = $peopleService->people->get('people/me', [
    'personFields' => 'names,emailAddresses',
    ]);

    $name = $person->getNames()[0]->getDisplayName();
    $email = $person->getEmailAddresses()[0]->getValue();


    $user_info = array('name'=>$name, "email"=>$email, 'phone'=>$phone);
    $response = $GoogleAuthApi->createConnection($access_token, $user_info);
    
    if($response){
    header("Location: index.php");
    }
}

if ($_POST['task'] == 'google_connection_remove') {
    
    $results = $GoogleAuthApi->delete_connention_google();
    if($results['status']){
    echo json_encode($results['msg']);
    }else{
    echo json_encode($results['msg']);
    }        
}


/********************** salesforce checking app connected aur not *******************************/
if ($_REQUEST['task'] == 'google_connected') {
   
    $results = $GoogleAuthApi->get_google_connected_app();
    if($results['status'] == "success"){
        echo json_encode($results);
    }else{
    echo json_encode(0);
    }        
}
/********************** salesforce checking app connected aur not *******************************/


    if($_REQUEST['task'] == "data_push"){

    $response = $GoogleAuthApi->get_access_token(); 
    $cronlists = $GoogleAuthApi->getServerTime();
    if(isset($cronlists['status']) && $cronlists['response']){
    if(isset($response[0]['active']) && $response[0]['active'] == 1){
    
    foreach($cronlists['response'] as $cronlist){
    
    $params = array(
    'id'=>$cronlist['id'],
    'report_type'=>$cronlist['report_type'],
    'report_interval'=>$cronlist['report_interval'],
    'customer_id'=>$cronlist['customer_id'],
    'updated_date'=>$cronlist['updated_date'],
    );
    
    $table_call_log_datas = $GoogleAuthApi->get_table_log_data($params);

    if($table_call_log_datas){
        $get_query = $GoogleAuthApi->getQueryLogTable($table_call_log_datas);    
        $arr = $get_query;
    

        $refresh_token = $response[0]['refresh_token'];
        $accessToken = $client->fetchAccessTokenWithRefreshToken($refresh_token);
        if(isset($accessToken) && !empty($accessToken)){
        $accessToken = $accessToken['access_token'];
        $client->setAccessToken($accessToken);
        $service = new Google_Service_Drive($client);

        $folderName = 'AvidTrak';
        $query = "mimeType='application/vnd.google-apps.folder' and name='$folderName'";
        $results = $service->files->listFiles(array('q' => $query));
        $folders = $results->getFiles();
        $folderId;
        
        
        if (count($folders) > 0) {
        // Get the first folder (assuming there's only one folder with the given name)
        $folderId = $folders[0]->getId();
        } else {
        // Handle the case where the folder doesn't exist
        $fileMetadata = new Google_Service_Drive_DriveFile(array(
        'name' => $folderName,
        'mimeType' => 'application/vnd.google-apps.folder',
        'parents' => ["root"],
        ));
        $folder = $service->files->create($fileMetadata, array(
        'fields' => 'id'
        ));
        $folderId = $folder->id;
        }
    //   // // Create a folder
    //   // Create a folder

    $folderName1 = date('Y-m-d');
    $query1 = "mimeType='application/vnd.google-apps.folder' and name='$folderName1'";
    $results1 = $service->files->listFiles(array('q' => $query1));
    $folders1 = $results1->getFiles();
    $folderId1;

    if (count($folders1) > 0) {
    // Get the first folder (assuming there's only one folder with the given name)
    $folderId1 = $folders1[0]->getId();
    } else {

        
        $fileMetadata1 = new Google_Service_Drive_DriveFile(array(
        'name' => $folderName1,
        'mimeType' => 'application/vnd.google-apps.folder',
        'parents' => array($folderId)
        ));
        $folder1 = $service->files->create($fileMetadata1, array(
        'fields' => 'id'
        ));
        $folderId1 = $folder1->id;
    }
        // Create a spreadsheet
        $spreadsheetName = date('Y-m-d H:i:s')." ".$cronlist['report_interval'];
        $spreadsheetMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => $spreadsheetName,
            'mimeType' => 'application/vnd.google-apps.spreadsheet',
            'parents' => array($folderId1)
        ));
        $spreadsheet = $service->files->create($spreadsheetMetadata, array(
            'fields' => 'id'
        ));
        $spreadsheetId = $spreadsheet->id;
        $header = $GoogleAuthApi->googleSheetHeader();
        $array3 = array_merge(array($header), $arr);
    
        // Create the Google Sheets service
        $services = new Google_Service_Sheets($client);
        $range = 'Sheet1'; // Adjust this to your sheet name
        $requestBodys = new  Google\Service\Sheets\ValueRange(['values' =>  $array3]);
        $sheet_push_response = $services->spreadsheets_values->update($spreadsheetId, $range, $requestBodys, ['valueInputOption' => 'RAW']);

        if(isset($sheet_push_response['spreadsheetId']) && !empty($sheet_push_response)){
            $GoogleAuthApi->updatedCronTime($cronlist['id'], $cronlist['report_interval']);
            $sheet_log = array("total_column"=>count($array3), "message"=>"GoogleSheet has been created successfully", "request"=>$array3, "response"=>$sheet_push_response);
            $GoogleAuthApi->add_log($sheet_log);
        }else{
            $sheet_log = array("total_column"=>count($array3), "message"=>"something went wrong contact developer.", "request"=>$array3, "response"=>$sheet_push_response);
            $GoogleAuthApi->add_log($sheet_log);
        } 
      }
    }
  }
}else{
    $sheet_log = array("total_column"=>"0", "message"=>"your integration is pauses please active your integration status.", "request"=>array(), "response"=>array());
    $GoogleAuthApi->add_log($sheet_log);
    }
    }else{
    echo "you did not add cron";exit;
    } 
}


if ($_POST['task'] == 'google_connection_active') {

    $results = $GoogleAuthApi->connected_app_status_active_deactive($_POST['status']);
    if($results['status'] == "success"){
        echo json_encode($results);
    }else{
        echo json_encode("something are wrong");
    }     
}


/********************** google delete connection *******************************/
if ($_POST['task'] == 'google_delete_connection') {
   
    $results = $GoogleAuthApi->delete_connention_google();
    echo json_encode($results['msg']);        
 
}
/********************** google delete connection end*******************************/


/********************** google cron setting saved *******************************/
if ($_POST['task'] == 'google_setting_save') {

    $results = $GoogleAuthApi->google_cron_setting_save($_POST);
    echo json_encode($results);
}
/********************** google cron setting saved *******************************/


/********************** google setting view *******************************/
if ($_GET['task'] == 'google_setting_view') {

    $results = $GoogleAuthApi->google_cron_setting_view();
    $table.= "";
    $i = 1;
    if($results['status'] == 'success'){
        foreach($results['response'] as $result){
            $status = ($result['active'] == 1) ? 'Active' : 'InActive';
            $table.=  '
            <tr><td align=left>'.$i.'</td>
                <td align=left>'.$result['report_type'].'</td>
                    <td class=tb_right>'.$result['report_interval'].'</td>
                        <td class=tb_right>'.$result['created_date'].'</td>
                    <td class=tb_right>'.$status.'</td>
                <td class="tb_right"><a onclick=myFunctionedit('.$result['id'].')>Edit</a>/<a onclick=myFunction('.$result['id'].')>Delete</a></td>
            </tr>';
        $i++;
        }
    }
         echo $table;exit;
}
/********************** google setting view *******************************/

if($_POST['task'] == 'google_setting_row_delete'){

    $id = $_POST['id'];
    $results = $GoogleAuthApi->google_setting_row_delete($_POST['id']);
    if($results['status'] == 'success'){
        echo json_encode($results['msg']);
    }else{
        echo json_encode($results['msg']);
    }
}



if($_GET['task'] == 'google_setting_row_edit'){

    $results = $GoogleAuthApi->google_setting_row_get($_GET['id']);
    
    if($results['status'] == 'success'){
       echo json_encode($results['response'][0]);
    }else{
       echo json_encode(array());
    }

}









