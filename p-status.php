<?php
require_once "./secret.php";
/* Go away if you are not admin, thanks. */
header("Content-Type: application/json");
if($_REQUEST["key"]!=$secret){
    echo "{'msg':'No access - wrong key.'}";
    exit();
}
$jan_28_return = array();
$jan_28_new_state = $_REQUEST["status"];
if($jan_28_new_state == 200 || $jan_28_new_state == 403 || $jan_28_new_state == 301 || $jan_28_new_state == 520){
    $jan_28_return["code"] = 200;
    $jan_28_file_handler = fopen("./status.jan28","w");
    
    $jan_28_writein = $jan_28_new_state;
    fwrite($jan_28_file_handler,$jan_28_writein);
    fclose($jan_28_file_handler);
    
    /* Done writing.  Now we check and re-check.*/
    
    $jan_28_return["msg"] = "Tried writing.";
    $jan_28_file_handle = fopen("./status.jan28","r");
    $jan_28_status_num = fgets($jan_28_file_handle);
    
    if($jan_28_status_num == $jan_28_new_state){
        $jan_28_return["msg"] = $jan_28_return["msg"] . " Checked & Completed.";
    }
    else{
        $jan_28_return["msg"] = $jan_28_return["msg"] . " But check error.";
    }
    $jan_28_return["nstate"] = $jan_28_status_num;
    
    

}
else{
    $jan_28_return["code"] = 400; // bad request.
}

echo json_encode($jan_28_return);
exit();



?>
