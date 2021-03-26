<?php  
    if ($bp_rooms > 1) {		 
        if ($bp_room_result->RoomCombinations->InfoSource == "FixedCombination"){	
            $typeofcombination = $bp_room_result->RoomCombinations->InfoSource; 						
            foreach($bp_room_result->RoomCombinations->RoomCombination as $key => $RoomCombinations) {
                if($typeofcombination == "FixedCombination"){
                    $bp_room_index_for_select = "";
                    foreach ( $RoomCombinations->RoomIndex as $RoomCombinationss ) {
                        if ($bp_room_index_for_select == "") {
                            $bp_room_index_for_select = $RoomCombinationss;
                        } else {
                            $bp_room_index_for_select = $bp_room_index_for_select . "_" . $RoomCombinationss;
                        }
                    }							
                }				
                if($typeofcombination == "OpenCombination"){									
                    $bp_room_index_for_select = $bp_room_result->RoomCombinations->RoomCombination[$key]->RoomIndex[0] . "_" . $bp_room_result->RoomCombinations->RoomCombination[$key]->RoomIndex[1];
                }							
                foreach($bp_room_detail as $bp_room_key => $bp_room_details) {			
                    if ($bp_room_details->RoomIndex == $RoomCombinations->RoomIndex [0]) {
                        $bp_customer_price=bp_get_hotel_fare_pernight($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff,$nights)['final_fare'];				
                        echo $this->load->view ("room_card",[
                            "bp_customer_price" => $bp_customer_price,
                            "bp_room_key" => $bp_room_key,
                            "bp_room_details" => $bp_room_details,
                            "nights" => $nights,
                            "symbol" => $symbol,
                            "bp_room_index_for_select" => $bp_room_index_for_select
                        ]);
                    } 
                } 
            } 
        } else {
            echo "No Rooms Available";
        }  
    }else{  
        $i = 0; 
        foreach($bp_room_detail as $bp_room_key => $bp_room_details){  
            $bp_customer_price=bp_get_hotel_fare_pernight($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff,$nights)['final_fare']; 
            echo $this->load->view ("room_card",[
                "bp_customer_price" => $bp_customer_price,
                "bp_room_key" => $bp_room_key,
                "bp_room_details" => $bp_room_details,
                "nights" => $nights,
                "symbol" => $symbol,
                "loginBlock" => true
            ]);
            $i++; 
        } 
    } 
?>
