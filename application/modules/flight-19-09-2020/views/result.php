<?php 
// print_r($searchID);
$searchdata = array();
$resultdata = array();
//$searchID = "5a48bab0f2002";
if (isset($_SESSION["flight"][$searchID]["Search_data_json"])) {

    $searchdata = json_decode($_SESSION["flight"][$searchID]["Search_data_json"]);
    $resultdata = json_decode($_SESSION["flight"][$searchID]["Search_Result_json"]);
}

// echo "<pre>";
// print_r($resultdata->Response->Results[1]);die;

$requestdata = $_SESSION["flight"][$searchID]["search_RequestData"];
$data = array();
$data['resultdata']= $resultdata;
$data['requestdata']= $requestdata;
$data['searchdata']=$searchdata;
$data["searchID"]=$searchID;

if(isset($resultdata->Response->Results[1])){ 
     $this->load->view("returnView",$data);
  
} else {
    
    $this->load->view("oneWayView",$data);
    
}  ?>

