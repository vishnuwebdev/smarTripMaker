<style>
.suggestionsBox img {
	display: none;
}

.suggestionsBox {
	position: absolute;
	padding: 0px;
	background-color: #FFFFFF !important;
	/* border-top: 1px solid #FDFDFD; */
	color: #3C8DBC;
	z-index: 2;
	height: auto;
	max-height: 200px;
	overflow-y: scroll;
	box-shadow: 0px 3px 7px 2px #C1C1C1;
	margin: 0px 0px 0px 0px;
}

.suggestionList ul li {
	list-style: none !important;
	margin: 0px;
	padding: 6px 15px !important;
	border-bottom: 1px solid #E4E0E0;
	cursor: pointer;
	color: #333;
}

.suggestionList ul {
	padding: 0px;
}

.suggestionList ul li:hover {
	color: #FFF;
	background: #693554;
}
</style>


<?php  

        if(isset($_SESSION ['hotel'] ['search_data'])){

             $search_data=$_SESSION ['hotel'] ['search_data'];

          //   print_r($search_data);

        } 

        $current_link = uri_string(); 
        
        if($current_link =="hotel/result" || $current_link =="hotel/select_room" ) {  
    
            $date1= date_create(date("d-m-Y"));
            $date2=date_create( $search_data['checkIn']);
            $diff=date_diff($date1,$date2);
            $min_date= $diff->format("%R%ad");  
        ?>
        

        <form action="<?php echo site_url();?>hotel/search" id="hotel_search_form" method="post">
                <h3 class="tab-title">Hotel Search</h3>
                <ul class="form-list">
                    <li class="location w40"><label>Where</label> <input type="text" value="<?php echo $search_data['location']; ?>" class="bp_hotel_search_validation" autocomplete="off" placeholder="Region, City, Area (Worldwide)" name="location" id="country" onkeyup="suggest(this.value);" onblur="fill();" /> <input type="hidden" value="<?php echo $search_data['cityDom']; ?>" class="cityDom" name="cityDom" />
                        <div class="suggestionsBox" id="suggestions" style="display: none; margin-top: 47px;">
                            <div class="suggestionList" id="suggestionsList">&nbsp;</div>
                        </div></li>
                    <li class="date w20"><label>Check-in</label> <input type="text" value="<?php echo $search_data['checkIn']; ?>" class="bp_hotel_search_validation bp_check_in_date" placeholder="Select Date"  name="checkin" readonly required=""></li>
                    <li class="date w20"><label>Check-out</label> <input type="text" value="<?php echo $search_data['checkOut']; ?>" class="bp_hotel_search_validation bp_check_out_date" placeholder="Select Date" name="checkout" placeholder="Check-Out" readonly required=""></li>
                    <li class="car w20"><label>Rating</label> <select name="rating">
                            <option  <?php if($search_data['rating']=="0_5 "){ echo "selected"; }  ?> value="0_5">All Star</option>
                            <option  <?php if($search_data['rating']=="0_1 "){ echo "selected"; }  ?> value="0_1">One Star Or Less</option>
                            <option  <?php if($search_data['rating']=="0_2 "){ echo "selected"; }  ?>value="0_2">Two Star Or Less</option>
                            <option  <?php if($search_data['rating']=="0_3 "){ echo "selected"; }  ?>value="0_3">Three Star Or Less</option>
                            <option  <?php if($search_data['rating']=="0_4 "){ echo "selected"; }  ?>value="0_4">Four Star Or Less</option>
                            <option  <?php if($search_data['rating']=="0_5 "){ echo "selected"; }  ?>value="0_5">Five Star Or Less</option>
                            <option  <?php if($search_data['rating']=="1_5 "){ echo "selected"; }  ?>value="1_5">One Star Or More</option>
                            <option  <?php if($search_data['rating']=="2_5 "){ echo "selected"; }  ?>value="2_5">Two Star Or More</option>
                            <option  <?php if($search_data['rating']=="3_5 "){ echo "selected"; }  ?> value="3_5">Three Star Or More</option>
                            <option  <?php if($search_data['rating']=="4_5 "){ echo "selected"; }  ?> value="4_5">Four Star Or More</option>
                            <option  <?php if($search_data['rating']=="5_5 "){ echo "selected"; }  ?>value="5_5">Five Star Or More</option>
                    </select></li>
                    <li class="rooms w60"><label>Rooms</label> <select class="bp_room_select" name="room">
                            <option <?php if($search_data['room']=="1"){ echo "selected"; }  ?> value="1">1 Room</option>
                            <option <?php if($search_data['room']=="2"){ echo "selected"; }  ?> value="2">2 Rooms</option>
                            <option <?php if($search_data['room']=="3"){ echo "selected"; }  ?> value="3">3 Rooms</option>
                            <option <?php if($search_data['room']=="4"){ echo "selected"; }  ?> value="4">4 Rooms</option>
                    </select>
                        <div class="hotelguestsdetails" style="display: none;">
                            <div class="bp_room_data">
                                <div class="roombox clearfix">
                                    <span class="block fz16 fwb black-color">Room 1:</span>
                                    <div class="roomchildbox clearfix pt15 border-top">
                                        <div class="row mt15">
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Adult</span> <select name="adult_1" id="adult_1" class="block width-100 border radius">
                                                    <option <?php if($search_data['adult_1']=="1"){ echo "selected"; }  ?> value="1">1 Adult</option>
                                                    <option <?php if($search_data['adult_1']=="2"){ echo "selected"; }  ?> value="2">2 Adults</option>
                                                    <option <?php if($search_data['adult_1']=="3"){ echo "selected"; }  ?> value="3">3 Adults</option>
                                                    <option <?php if($search_data['adult_1']=="4"){ echo "selected"; }  ?> value="4">4 Adults</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Child</span> <select name="child_1" id="child_1" class="block width-100 border radius" onchange="return bp_child_age(this.value,1);">
                                                    <option <?php if($search_data['child_1']=="1"){ echo "selected"; }  ?>value="0">0 Child</option>
                                                    <option <?php if($search_data['child_1']=="2"){ echo "selected"; }  ?> value="1">1 Child</option>
                                                    <option <?php if($search_data['child_1']=="3"){ echo "selected"; }  ?> value="2">2 Children</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="bp_for_child_dob_1"></div>
                                    </div>
                                </div>
                            </div>
                        </div></li>
                        <li class="house w20"><label>Nationality</label> <select name="country" id="select_country" class="country bp_hotel_search_validation"> 
                                                        <option value="">Select Country--</option>
                                                        
                                                                                                    <option value="AF_Afghanistan">Afghanistan</option>
                                                                                                    <option value="AL_Albania">Albania</option>
                                                                                                    <option value="DZ_Algeria">Algeria</option>
                                                                                                    <option value="AS_American Samoa">American Samoa</option>
                                                                                                    <option value="AD_Andorra">Andorra</option>
                                                                                                    <option value="AO_Angola">Angola</option>
                                                                                                    <option value="AI_Anguilla">Anguilla</option>
                                                                                                    <option value="AQ_Antarctica">Antarctica</option>
                                                                                                    <option value="AG_Antigua And Barbuda">Antigua And Barbuda</option>
                                                                                                    <option value="AR_Argentina">Argentina</option>
                                                                                                    <option value="AM_Armenia">Armenia</option>
                                                                                                    <option value="AW_Aruba">Aruba</option>
                                                                                                    <option value="AU_Australia">Australia</option>
                                                                                                    <option value="AT_Austria">Austria</option>
                                                                                                    <option value="AZ_Azerbaijan">Azerbaijan</option>
                                                                                                    <option value="BS_Bahamas The">Bahamas The</option>
                                                                                                    <option value="BH_Bahrain">Bahrain</option>
                                                                                                    <option value="BD_Bangladesh">Bangladesh</option>
                                                                                                    <option value="BB_Barbados">Barbados</option>
                                                                                                    <option value="BY_Belarus">Belarus</option>
                                                                                                    <option value="BE_Belgium">Belgium</option>
                                                                                                    <option value="BZ_Belize">Belize</option>
                                                                                                    <option value="BJ_Benin">Benin</option>
                                                                                                    <option value="BM_Bermuda">Bermuda</option>
                                                                                                    <option value="BT_Bhutan">Bhutan</option>
                                                                                                    <option value="BO_Bolivia">Bolivia</option>
                                                                                                    <option value="BA_Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                                    <option value="BW_Botswana">Botswana</option>
                                                                                                    <option value="BV_Bouvet Island">Bouvet Island</option>
                                                                                                    <option value="BR_Brazil">Brazil</option>
                                                                                                    <option value="IO_British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                                                    <option value="BN_Brunei">Brunei</option>
                                                                                                    <option value="BG_Bulgaria">Bulgaria</option>
                                                                                                    <option value="BF_Burkina Faso">Burkina Faso</option>
                                                                                                    <option value="BI_Burundi">Burundi</option>
                                                                                                    <option value="KH_Cambodia">Cambodia</option>
                                                                                                    <option value="CM_Cameroon">Cameroon</option>
                                                                                                    <option value="CA_Canada">Canada</option>
                                                                                                    <option value="CV_Cape Verde">Cape Verde</option>
                                                                                                    <option value="KY_Cayman Islands">Cayman Islands</option>
                                                                                                    <option value="CF_Central African Republic">Central African Republic</option>
                                                                                                    <option value="TD_Chad">Chad</option>
                                                                                                    <option value="CL_Chile">Chile</option>
                                                                                                    <option value="CN_China">China</option>
                                                                                                    <option value="CX_Christmas Island">Christmas Island</option>
                                                                                                    <option value="CC_Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                                                    <option value="CO_Colombia">Colombia</option>
                                                                                                    <option value="KM_Comoros">Comoros</option>
                                                                                                    <option value="CG_Republic Of The Congo">Republic Of The Congo</option>
                                                                                                    <option value="CD_Democratic Republic Of The Congo">Democratic Republic Of The Congo</option>
                                                                                                    <option value="CK_Cook Islands">Cook Islands</option>
                                                                                                    <option value="CR_Costa Rica">Costa Rica</option>
                                                                                                    <option value="CI_Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
                                                                                                    <option value="HR_Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                                                                                    <option value="CU_Cuba">Cuba</option>
                                                                                                    <option value="CY_Cyprus">Cyprus</option>
                                                                                                    <option value="CZ_Czech Republic">Czech Republic</option>
                                                                                                    <option value="DK_Denmark">Denmark</option>
                                                                                                    <option value="DJ_Djibouti">Djibouti</option>
                                                                                                    <option value="DM_Dominica">Dominica</option>
                                                                                                    <option value="DO_Dominican Republic">Dominican Republic</option>
                                                                                                    <option value="TP_East Timor">East Timor</option>
                                                                                                    <option value="EC_Ecuador">Ecuador</option>
                                                                                                    <option value="EG_Egypt">Egypt</option>
                                                                                                    <option value="SV_El Salvador">El Salvador</option>
                                                                                                    <option value="GQ_Equatorial Guinea">Equatorial Guinea</option>
                                                                                                    <option value="ER_Eritrea">Eritrea</option>
                                                                                                    <option value="EE_Estonia">Estonia</option>
                                                                                                    <option value="ET_Ethiopia">Ethiopia</option>
                                                                                                    <option value="XA_External Territories of Australia">External Territories of Australia</option>
                                                                                                    <option value="FK_Falkland Islands">Falkland Islands</option>
                                                                                                    <option value="FO_Faroe Islands">Faroe Islands</option>
                                                                                                    <option value="FJ_Fiji Islands">Fiji Islands</option>
                                                                                                    <option value="FI_Finland">Finland</option>
                                                                                                    <option value="FR_France">France</option>
                                                                                                    <option value="GF_French Guiana">French Guiana</option>
                                                                                                    <option value="PF_French Polynesia">French Polynesia</option>
                                                                                                    <option value="TF_French Southern Territories">French Southern Territories</option>
                                                                                                    <option value="GA_Gabon">Gabon</option>
                                                                                                    <option value="GM_Gambia The">Gambia The</option>
                                                                                                    <option value="GE_Georgia">Georgia</option>
                                                                                                    <option value="DE_Germany">Germany</option>
                                                                                                    <option value="GH_Ghana">Ghana</option>
                                                                                                    <option value="GI_Gibraltar">Gibraltar</option>
                                                                                                    <option value="GR_Greece">Greece</option>
                                                                                                    <option value="GL_Greenland">Greenland</option>
                                                                                                    <option value="GD_Grenada">Grenada</option>
                                                                                                    <option value="GP_Guadeloupe">Guadeloupe</option>
                                                                                                    <option value="GU_Guam">Guam</option>
                                                                                                    <option value="GT_Guatemala">Guatemala</option>
                                                                                                    <option value="XU_Guernsey and Alderney">Guernsey and Alderney</option>
                                                                                                    <option value="GN_Guinea">Guinea</option>
                                                                                                    <option value="GW_Guinea-Bissau">Guinea-Bissau</option>
                                                                                                    <option value="GY_Guyana">Guyana</option>
                                                                                                    <option value="HT_Haiti">Haiti</option>
                                                                                                    <option value="HM_Heard and McDonald Islands">Heard and McDonald Islands</option>
                                                                                                    <option value="HN_Honduras">Honduras</option>
                                                                                                    <option value="HK_Hong Kong S.A.R.">Hong Kong S.A.R.</option>
                                                                                                    <option value="HU_Hungary">Hungary</option>
                                                                                                    <option value="IS_Iceland">Iceland</option>
                                                                                                    <option value="IN_India">India</option>
                                                                                                    <option value="ID_Indonesia">Indonesia</option>
                                                                                                    <option value="IR_Iran">Iran</option>
                                                                                                    <option value="IQ_Iraq">Iraq</option>
                                                                                                    <option value="IE_Ireland">Ireland</option>
                                                                                                    <option value="IL_Israel">Israel</option>
                                                                                                    <option value="IT_Italy">Italy</option>
                                                                                                    <option value="JM_Jamaica">Jamaica</option>
                                                                                                    <option value="JP_Japan">Japan</option>
                                                                                                    <option value="XJ_Jersey">Jersey</option>
                                                                                                    <option value="JO_Jordan">Jordan</option>
                                                                                                    <option value="KZ_Kazakhstan">Kazakhstan</option>
                                                                                                    <option value="KE_Kenya">Kenya</option>
                                                                                                    <option value="KI_Kiribati">Kiribati</option>
                                                                                                    <option value="KP_Korea North">Korea North</option>
                                                                                                    <option value="KR_Korea South">Korea South</option>
                                                                                                    <option value="KW_Kuwait">Kuwait</option>
                                                                                                    <option value="KG_Kyrgyzstan">Kyrgyzstan</option>
                                                                                                    <option value="LA_Laos">Laos</option>
                                                                                                    <option value="LV_Latvia">Latvia</option>
                                                                                                    <option value="LB_Lebanon">Lebanon</option>
                                                                                                    <option value="LS_Lesotho">Lesotho</option>
                                                                                                    <option value="LR_Liberia">Liberia</option>
                                                                                                    <option value="LY_Libya">Libya</option>
                                                                                                    <option value="LI_Liechtenstein">Liechtenstein</option>
                                                                                                    <option value="LT_Lithuania">Lithuania</option>
                                                                                                    <option value="LU_Luxembourg">Luxembourg</option>
                                                                                                    <option value="MO_Macau S.A.R.">Macau S.A.R.</option>
                                                                                                    <option value="MK_Macedonia">Macedonia</option>
                                                                                                    <option value="MG_Madagascar">Madagascar</option>
                                                                                                    <option value="MW_Malawi">Malawi</option>
                                                                                                    <option value="MY_Malaysia">Malaysia</option>
                                                                                                    <option value="MV_Maldives">Maldives</option>
                                                                                                    <option value="ML_Mali">Mali</option>
                                                                                                    <option value="MT_Malta">Malta</option>
                                                                                                    <option value="XM_Man (Isle of)">Man (Isle of)</option>
                                                                                                    <option value="MH_Marshall Islands">Marshall Islands</option>
                                                                                                    <option value="MQ_Martinique">Martinique</option>
                                                                                                    <option value="MR_Mauritania">Mauritania</option>
                                                                                                    <option value="MU_Mauritius">Mauritius</option>
                                                                                                    <option value="YT_Mayotte">Mayotte</option>
                                                                                                    <option value="MX_Mexico">Mexico</option>
                                                                                                    <option value="FM_Micronesia">Micronesia</option>
                                                                                                    <option value="MD_Moldova">Moldova</option>
                                                                                                    <option value="MC_Monaco">Monaco</option>
                                                                                                    <option value="MN_Mongolia">Mongolia</option>
                                                                                                    <option value="MS_Montserrat">Montserrat</option>
                                                                                                    <option value="MA_Morocco">Morocco</option>
                                                                                                    <option value="MZ_Mozambique">Mozambique</option>
                                                                                                    <option value="MM_Myanmar">Myanmar</option>
                                                                                                    <option value="NA_Namibia">Namibia</option>
                                                                                                    <option value="NR_Nauru">Nauru</option>
                                                                                                    <option value="NP_Nepal">Nepal</option>
                                                                                                    <option value="AN_Netherlands Antilles">Netherlands Antilles</option>
                                                                                                    <option value="NL_Netherlands The">Netherlands The</option>
                                                                                                    <option value="NC_New Caledonia">New Caledonia</option>
                                                                                                    <option value="NZ_New Zealand">New Zealand</option>
                                                                                                    <option value="NI_Nicaragua">Nicaragua</option>
                                                                                                    <option value="NE_Niger">Niger</option>
                                                                                                    <option value="NG_Nigeria">Nigeria</option>
                                                                                                    <option value="NU_Niue">Niue</option>
                                                                                                    <option value="NF_Norfolk Island">Norfolk Island</option>
                                                                                                    <option value="MP_Northern Mariana Islands">Northern Mariana Islands</option>
                                                                                                    <option value="NO_Norway">Norway</option>
                                                                                                    <option value="OM_Oman">Oman</option>
                                                                                                    <option value="PK_Pakistan">Pakistan</option>
                                                                                                    <option value="PW_Palau">Palau</option>
                                                                                                    <option value="PS_Palestinian Territory Occupied">Palestinian Territory Occupied</option>
                                                                                                    <option value="PA_Panama">Panama</option>
                                                                                                    <option value="PG_Papua new Guinea">Papua new Guinea</option>
                                                                                                    <option value="PY_Paraguay">Paraguay</option>
                                                                                                    <option value="PE_Peru">Peru</option>
                                                                                                    <option value="PH_Philippines">Philippines</option>
                                                                                                    <option value="PN_Pitcairn Island">Pitcairn Island</option>
                                                                                                    <option value="PL_Poland">Poland</option>
                                                                                                    <option value="PT_Portugal">Portugal</option>
                                                                                                    <option value="PR_Puerto Rico">Puerto Rico</option>
                                                                                                    <option value="QA_Qatar">Qatar</option>
                                                                                                    <option value="RE_Reunion">Reunion</option>
                                                                                                    <option value="RO_Romania">Romania</option>
                                                                                                    <option value="RU_Russia">Russia</option>
                                                                                                    <option value="RW_Rwanda">Rwanda</option>
                                                                                                    <option value="SH_Saint Helena">Saint Helena</option>
                                                                                                    <option value="KN_Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                                                                                                    <option value="LC_Saint Lucia">Saint Lucia</option>
                                                                                                    <option value="PM_Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                                                    <option value="VC_Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                                                                                                    <option value="WS_Samoa">Samoa</option>
                                                                                                    <option value="SM_San Marino">San Marino</option>
                                                                                                    <option value="ST_Sao Tome and Principe">Sao Tome and Principe</option>
                                                                                                    <option value="SA_Saudi Arabia">Saudi Arabia</option>
                                                                                                    <option value="SN_Senegal">Senegal</option>
                                                                                                    <option value="RS_Serbia">Serbia</option>
                                                                                                    <option value="SC_Seychelles">Seychelles</option>
                                                                                                    <option value="SL_Sierra Leone">Sierra Leone</option>
                                                                                                    <option value="SG_Singapore">Singapore</option>
                                                                                                    <option value="SK_Slovakia">Slovakia</option>
                                                                                                    <option value="SI_Slovenia">Slovenia</option>
                                                                                                    <option value="XG_Smaller Territories of the UK">Smaller Territories of the UK</option>
                                                                                                    <option value="SB_Solomon Islands">Solomon Islands</option>
                                                                                                    <option value="SO_Somalia">Somalia</option>
                                                                                                    <option value="ZA_South Africa">South Africa</option>
                                                                                                    <option value="GS_South Georgia">South Georgia</option>
                                                                                                    <option value="SS_South Sudan">South Sudan</option>
                                                                                                    <option value="ES_Spain">Spain</option>
                                                                                                    <option value="LK_Sri Lanka">Sri Lanka</option>
                                                                                                    <option value="SD_Sudan">Sudan</option>
                                                                                                    <option value="SR_Suriname">Suriname</option>
                                                                                                    <option value="SJ_Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>
                                                                                                    <option value="SZ_Swaziland">Swaziland</option>
                                                                                                    <option value="SE_Sweden">Sweden</option>
                                                                                                    <option value="CH_Switzerland">Switzerland</option>
                                                                                                    <option value="SY_Syria">Syria</option>
                                                                                                    <option value="TW_Taiwan">Taiwan</option>
                                                                                                    <option value="TJ_Tajikistan">Tajikistan</option>
                                                                                                    <option value="TZ_Tanzania">Tanzania</option>
                                                                                                    <option value="TH_Thailand">Thailand</option>
                                                                                                    <option value="TG_Togo">Togo</option>
                                                                                                    <option value="TK_Tokelau">Tokelau</option>
                                                                                                    <option value="TO_Tonga">Tonga</option>
                                                                                                    <option value="TT_Trinidad And Tobago">Trinidad And Tobago</option>
                                                                                                    <option value="TN_Tunisia">Tunisia</option>
                                                                                                    <option value="TR_Turkey">Turkey</option>
                                                                                                    <option value="TM_Turkmenistan">Turkmenistan</option>
                                                                                                    <option value="TC_Turks And Caicos Islands">Turks And Caicos Islands</option>
                                                                                                    <option value="TV_Tuvalu">Tuvalu</option>
                                                                                                    <option value="UG_Uganda">Uganda</option>
                                                                                                    <option value="UA_Ukraine">Ukraine</option>
                                                                                                    <option value="AE_United Arab Emirates">United Arab Emirates</option>
                                                                                                    <option value="GB_United Kingdom">United Kingdom</option>
                                                                                                    <option value="US_United States">United States</option>
                                                                                                    <option value="UM_United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                                                    <option value="UY_Uruguay">Uruguay</option>
                                                                                                    <option value="UZ_Uzbekistan">Uzbekistan</option>
                                                                                                    <option value="VU_Vanuatu">Vanuatu</option>
                                                                                                    <option value="VA_Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                                                                                    <option value="VE_Venezuela">Venezuela</option>
                                                                                                    <option value="VN_Vietnam">Vietnam</option>
                                                                                                    <option value="VG_Virgin Islands (British)">Virgin Islands (British)</option>
                                                                                                    <option value="VI_Virgin Islands (US)">Virgin Islands (US)</option>
                                                                                                    <option value="WF_Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                                                                                                    <option value="EH_Western Sahara">Western Sahara</option>
                                                                                                    <option value="YE_Yemen">Yemen</option>
                                                                                                    <option value="YU_Yugoslavia">Yugoslavia</option>
                                                                                                    <option value="ZM_Zambia">Zambia</option>
                                                                                                    <option value="ZW_Zimbabwe">Zimbabwe</option>
                                                                                                </select></li>
                    <li class="small float-right bt">
                    <button type="button" class="btn btn-primary float-right hotel_search_button" title="Find Hotels">Find Hotels</button></li>
                </ul>
            </form>
            
         
       
       
        
        
        <?php  } if($current_link =="")  {  ?>

        <form action="<?php echo site_url();?>hotel/search" id="hotel_search_form" method="post">
                <h3 class="tab-title">Hotel Search</h3>
                <ul class="form-list">
                    <li class="location w40"><label>Where</label> <input type="text" class="bp_hotel_search_validation" autocomplete="off" placeholder="Region, City, Area (Worldwide)" name="location" id="country" onkeyup="suggest(this.value);" onblur="fill();" /> <input type="hidden" class="cityDom" name="cityDom" />
                        <div class="suggestionsBox" id="suggestions" style="display: none; margin-top: 47px;">
                            <div class="suggestionList" id="suggestionsList">&nbsp;</div>
                        </div></li>
                    <li class="date w20"><label>Check-in</label> <input type="text" class="bp_hotel_search_validation bp_check_in_date" placeholder="Select Date"  name="checkin" readonly required=""></li>
                    <li class="date w20"><label>Check-out</label> <input type="text" class="bp_hotel_search_validation bp_check_out_date" placeholder="Select Date"      name="checkout" placeholder="Check-Out" readonly required=""></li>
                    <li class="car w20"><label>Rating</label> <select name="rating">
                            <option value="0_5">All Star</option>
                            <option value="0_1">One Star Or Less</option>
                            <option value="0_2">Two Star Or Less</option>
                            <option value="0_3">Three Star Or Less</option>
                            <option value="0_4">Four Star Or Less</option>
                            <option value="0_5">Five Star Or Less</option>
                            <option value="1_5">One Star Or More</option>
                            <option value="2_5">Two Star Or More</option>
                            <option value="3_5">Three Star Or More</option>
                            <option value="4_5">Four Star Or More</option>
                            <option value="5_5">Five Star Or More</option>
                    </select></li>
                    <li class="rooms w60"><label>Rooms</label> <select class="bp_room_select" name="room">
                            <option value="1">1 Room</option>
                            <option value="2">2 Rooms</option>
                            <option value="3">3 Rooms</option>
                            <option value="4">4 Rooms</option>
                    </select>
                        <div class="hotelguestsdetails" style="display: none;">
                            <div class="bp_room_data">
                                <div class="roombox clearfix">
                                    <span class="block fz16 fwb black-color">Room 1:</span>
                                    <div class="roomchildbox clearfix pt15 border-top">
                                        <div class="row mt15">
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Adult</span> <select name="adult_1" id="adult_1" class="block width-100 border radius">
                                                    <option value="1">1 Adult</option>
                                                    <option value="2">2 Adults</option>
                                                    <option value="3">3 Adults</option>
                                                    <option value="4">4 Adults</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Child</span> <select name="child_1" id="child_1" class="block width-100 border radius" onchange="return bp_child_age(this.value,1);">
                                                    <option value="0">0 Child</option>
                                                    <option value="1">1 Child</option>
                                                    <option value="2">2 Children</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="bp_for_child_dob_1"></div>
                                    </div>
                                </div>
                            </div>
                        </div></li>
                        <li class="house w20"><label>Nationality</label> <select name="country" class="country bp_hotel_search_validation"> 
                                                        <option value="">Select Country--</option>
                                                        
                                                                                                    <option value="AF_Afghanistan">Afghanistan</option>
                                                                                                    <option value="AL_Albania">Albania</option>
                                                                                                    <option value="DZ_Algeria">Algeria</option>
                                                                                                    <option value="AS_American Samoa">American Samoa</option>
                                                                                                    <option value="AD_Andorra">Andorra</option>
                                                                                                    <option value="AO_Angola">Angola</option>
                                                                                                    <option value="AI_Anguilla">Anguilla</option>
                                                                                                    <option value="AQ_Antarctica">Antarctica</option>
                                                                                                    <option value="AG_Antigua And Barbuda">Antigua And Barbuda</option>
                                                                                                    <option value="AR_Argentina">Argentina</option>
                                                                                                    <option value="AM_Armenia">Armenia</option>
                                                                                                    <option value="AW_Aruba">Aruba</option>
                                                                                                    <option value="AU_Australia">Australia</option>
                                                                                                    <option value="AT_Austria">Austria</option>
                                                                                                    <option value="AZ_Azerbaijan">Azerbaijan</option>
                                                                                                    <option value="BS_Bahamas The">Bahamas The</option>
                                                                                                    <option value="BH_Bahrain">Bahrain</option>
                                                                                                    <option value="BD_Bangladesh">Bangladesh</option>
                                                                                                    <option value="BB_Barbados">Barbados</option>
                                                                                                    <option value="BY_Belarus">Belarus</option>
                                                                                                    <option value="BE_Belgium">Belgium</option>
                                                                                                    <option value="BZ_Belize">Belize</option>
                                                                                                    <option value="BJ_Benin">Benin</option>
                                                                                                    <option value="BM_Bermuda">Bermuda</option>
                                                                                                    <option value="BT_Bhutan">Bhutan</option>
                                                                                                    <option value="BO_Bolivia">Bolivia</option>
                                                                                                    <option value="BA_Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                                    <option value="BW_Botswana">Botswana</option>
                                                                                                    <option value="BV_Bouvet Island">Bouvet Island</option>
                                                                                                    <option value="BR_Brazil">Brazil</option>
                                                                                                    <option value="IO_British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                                                    <option value="BN_Brunei">Brunei</option>
                                                                                                    <option value="BG_Bulgaria">Bulgaria</option>
                                                                                                    <option value="BF_Burkina Faso">Burkina Faso</option>
                                                                                                    <option value="BI_Burundi">Burundi</option>
                                                                                                    <option value="KH_Cambodia">Cambodia</option>
                                                                                                    <option value="CM_Cameroon">Cameroon</option>
                                                                                                    <option value="CA_Canada">Canada</option>
                                                                                                    <option value="CV_Cape Verde">Cape Verde</option>
                                                                                                    <option value="KY_Cayman Islands">Cayman Islands</option>
                                                                                                    <option value="CF_Central African Republic">Central African Republic</option>
                                                                                                    <option value="TD_Chad">Chad</option>
                                                                                                    <option value="CL_Chile">Chile</option>
                                                                                                    <option value="CN_China">China</option>
                                                                                                    <option value="CX_Christmas Island">Christmas Island</option>
                                                                                                    <option value="CC_Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                                                    <option value="CO_Colombia">Colombia</option>
                                                                                                    <option value="KM_Comoros">Comoros</option>
                                                                                                    <option value="CG_Republic Of The Congo">Republic Of The Congo</option>
                                                                                                    <option value="CD_Democratic Republic Of The Congo">Democratic Republic Of The Congo</option>
                                                                                                    <option value="CK_Cook Islands">Cook Islands</option>
                                                                                                    <option value="CR_Costa Rica">Costa Rica</option>
                                                                                                    <option value="CI_Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
                                                                                                    <option value="HR_Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                                                                                    <option value="CU_Cuba">Cuba</option>
                                                                                                    <option value="CY_Cyprus">Cyprus</option>
                                                                                                    <option value="CZ_Czech Republic">Czech Republic</option>
                                                                                                    <option value="DK_Denmark">Denmark</option>
                                                                                                    <option value="DJ_Djibouti">Djibouti</option>
                                                                                                    <option value="DM_Dominica">Dominica</option>
                                                                                                    <option value="DO_Dominican Republic">Dominican Republic</option>
                                                                                                    <option value="TP_East Timor">East Timor</option>
                                                                                                    <option value="EC_Ecuador">Ecuador</option>
                                                                                                    <option value="EG_Egypt">Egypt</option>
                                                                                                    <option value="SV_El Salvador">El Salvador</option>
                                                                                                    <option value="GQ_Equatorial Guinea">Equatorial Guinea</option>
                                                                                                    <option value="ER_Eritrea">Eritrea</option>
                                                                                                    <option value="EE_Estonia">Estonia</option>
                                                                                                    <option value="ET_Ethiopia">Ethiopia</option>
                                                                                                    <option value="XA_External Territories of Australia">External Territories of Australia</option>
                                                                                                    <option value="FK_Falkland Islands">Falkland Islands</option>
                                                                                                    <option value="FO_Faroe Islands">Faroe Islands</option>
                                                                                                    <option value="FJ_Fiji Islands">Fiji Islands</option>
                                                                                                    <option value="FI_Finland">Finland</option>
                                                                                                    <option value="FR_France">France</option>
                                                                                                    <option value="GF_French Guiana">French Guiana</option>
                                                                                                    <option value="PF_French Polynesia">French Polynesia</option>
                                                                                                    <option value="TF_French Southern Territories">French Southern Territories</option>
                                                                                                    <option value="GA_Gabon">Gabon</option>
                                                                                                    <option value="GM_Gambia The">Gambia The</option>
                                                                                                    <option value="GE_Georgia">Georgia</option>
                                                                                                    <option value="DE_Germany">Germany</option>
                                                                                                    <option value="GH_Ghana">Ghana</option>
                                                                                                    <option value="GI_Gibraltar">Gibraltar</option>
                                                                                                    <option value="GR_Greece">Greece</option>
                                                                                                    <option value="GL_Greenland">Greenland</option>
                                                                                                    <option value="GD_Grenada">Grenada</option>
                                                                                                    <option value="GP_Guadeloupe">Guadeloupe</option>
                                                                                                    <option value="GU_Guam">Guam</option>
                                                                                                    <option value="GT_Guatemala">Guatemala</option>
                                                                                                    <option value="XU_Guernsey and Alderney">Guernsey and Alderney</option>
                                                                                                    <option value="GN_Guinea">Guinea</option>
                                                                                                    <option value="GW_Guinea-Bissau">Guinea-Bissau</option>
                                                                                                    <option value="GY_Guyana">Guyana</option>
                                                                                                    <option value="HT_Haiti">Haiti</option>
                                                                                                    <option value="HM_Heard and McDonald Islands">Heard and McDonald Islands</option>
                                                                                                    <option value="HN_Honduras">Honduras</option>
                                                                                                    <option value="HK_Hong Kong S.A.R.">Hong Kong S.A.R.</option>
                                                                                                    <option value="HU_Hungary">Hungary</option>
                                                                                                    <option value="IS_Iceland">Iceland</option>
                                                                                                    <option value="IN_India">India</option>
                                                                                                    <option value="ID_Indonesia">Indonesia</option>
                                                                                                    <option value="IR_Iran">Iran</option>
                                                                                                    <option value="IQ_Iraq">Iraq</option>
                                                                                                    <option value="IE_Ireland">Ireland</option>
                                                                                                    <option value="IL_Israel">Israel</option>
                                                                                                    <option value="IT_Italy">Italy</option>
                                                                                                    <option value="JM_Jamaica">Jamaica</option>
                                                                                                    <option value="JP_Japan">Japan</option>
                                                                                                    <option value="XJ_Jersey">Jersey</option>
                                                                                                    <option value="JO_Jordan">Jordan</option>
                                                                                                    <option value="KZ_Kazakhstan">Kazakhstan</option>
                                                                                                    <option value="KE_Kenya">Kenya</option>
                                                                                                    <option value="KI_Kiribati">Kiribati</option>
                                                                                                    <option value="KP_Korea North">Korea North</option>
                                                                                                    <option value="KR_Korea South">Korea South</option>
                                                                                                    <option value="KW_Kuwait">Kuwait</option>
                                                                                                    <option value="KG_Kyrgyzstan">Kyrgyzstan</option>
                                                                                                    <option value="LA_Laos">Laos</option>
                                                                                                    <option value="LV_Latvia">Latvia</option>
                                                                                                    <option value="LB_Lebanon">Lebanon</option>
                                                                                                    <option value="LS_Lesotho">Lesotho</option>
                                                                                                    <option value="LR_Liberia">Liberia</option>
                                                                                                    <option value="LY_Libya">Libya</option>
                                                                                                    <option value="LI_Liechtenstein">Liechtenstein</option>
                                                                                                    <option value="LT_Lithuania">Lithuania</option>
                                                                                                    <option value="LU_Luxembourg">Luxembourg</option>
                                                                                                    <option value="MO_Macau S.A.R.">Macau S.A.R.</option>
                                                                                                    <option value="MK_Macedonia">Macedonia</option>
                                                                                                    <option value="MG_Madagascar">Madagascar</option>
                                                                                                    <option value="MW_Malawi">Malawi</option>
                                                                                                    <option value="MY_Malaysia">Malaysia</option>
                                                                                                    <option value="MV_Maldives">Maldives</option>
                                                                                                    <option value="ML_Mali">Mali</option>
                                                                                                    <option value="MT_Malta">Malta</option>
                                                                                                    <option value="XM_Man (Isle of)">Man (Isle of)</option>
                                                                                                    <option value="MH_Marshall Islands">Marshall Islands</option>
                                                                                                    <option value="MQ_Martinique">Martinique</option>
                                                                                                    <option value="MR_Mauritania">Mauritania</option>
                                                                                                    <option value="MU_Mauritius">Mauritius</option>
                                                                                                    <option value="YT_Mayotte">Mayotte</option>
                                                                                                    <option value="MX_Mexico">Mexico</option>
                                                                                                    <option value="FM_Micronesia">Micronesia</option>
                                                                                                    <option value="MD_Moldova">Moldova</option>
                                                                                                    <option value="MC_Monaco">Monaco</option>
                                                                                                    <option value="MN_Mongolia">Mongolia</option>
                                                                                                    <option value="MS_Montserrat">Montserrat</option>
                                                                                                    <option value="MA_Morocco">Morocco</option>
                                                                                                    <option value="MZ_Mozambique">Mozambique</option>
                                                                                                    <option value="MM_Myanmar">Myanmar</option>
                                                                                                    <option value="NA_Namibia">Namibia</option>
                                                                                                    <option value="NR_Nauru">Nauru</option>
                                                                                                    <option value="NP_Nepal">Nepal</option>
                                                                                                    <option value="AN_Netherlands Antilles">Netherlands Antilles</option>
                                                                                                    <option value="NL_Netherlands The">Netherlands The</option>
                                                                                                    <option value="NC_New Caledonia">New Caledonia</option>
                                                                                                    <option value="NZ_New Zealand">New Zealand</option>
                                                                                                    <option value="NI_Nicaragua">Nicaragua</option>
                                                                                                    <option value="NE_Niger">Niger</option>
                                                                                                    <option value="NG_Nigeria">Nigeria</option>
                                                                                                    <option value="NU_Niue">Niue</option>
                                                                                                    <option value="NF_Norfolk Island">Norfolk Island</option>
                                                                                                    <option value="MP_Northern Mariana Islands">Northern Mariana Islands</option>
                                                                                                    <option value="NO_Norway">Norway</option>
                                                                                                    <option value="OM_Oman">Oman</option>
                                                                                                    <option value="PK_Pakistan">Pakistan</option>
                                                                                                    <option value="PW_Palau">Palau</option>
                                                                                                    <option value="PS_Palestinian Territory Occupied">Palestinian Territory Occupied</option>
                                                                                                    <option value="PA_Panama">Panama</option>
                                                                                                    <option value="PG_Papua new Guinea">Papua new Guinea</option>
                                                                                                    <option value="PY_Paraguay">Paraguay</option>
                                                                                                    <option value="PE_Peru">Peru</option>
                                                                                                    <option value="PH_Philippines">Philippines</option>
                                                                                                    <option value="PN_Pitcairn Island">Pitcairn Island</option>
                                                                                                    <option value="PL_Poland">Poland</option>
                                                                                                    <option value="PT_Portugal">Portugal</option>
                                                                                                    <option value="PR_Puerto Rico">Puerto Rico</option>
                                                                                                    <option value="QA_Qatar">Qatar</option>
                                                                                                    <option value="RE_Reunion">Reunion</option>
                                                                                                    <option value="RO_Romania">Romania</option>
                                                                                                    <option value="RU_Russia">Russia</option>
                                                                                                    <option value="RW_Rwanda">Rwanda</option>
                                                                                                    <option value="SH_Saint Helena">Saint Helena</option>
                                                                                                    <option value="KN_Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                                                                                                    <option value="LC_Saint Lucia">Saint Lucia</option>
                                                                                                    <option value="PM_Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                                                    <option value="VC_Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                                                                                                    <option value="WS_Samoa">Samoa</option>
                                                                                                    <option value="SM_San Marino">San Marino</option>
                                                                                                    <option value="ST_Sao Tome and Principe">Sao Tome and Principe</option>
                                                                                                    <option value="SA_Saudi Arabia">Saudi Arabia</option>
                                                                                                    <option value="SN_Senegal">Senegal</option>
                                                                                                    <option value="RS_Serbia">Serbia</option>
                                                                                                    <option value="SC_Seychelles">Seychelles</option>
                                                                                                    <option value="SL_Sierra Leone">Sierra Leone</option>
                                                                                                    <option value="SG_Singapore">Singapore</option>
                                                                                                    <option value="SK_Slovakia">Slovakia</option>
                                                                                                    <option value="SI_Slovenia">Slovenia</option>
                                                                                                    <option value="XG_Smaller Territories of the UK">Smaller Territories of the UK</option>
                                                                                                    <option value="SB_Solomon Islands">Solomon Islands</option>
                                                                                                    <option value="SO_Somalia">Somalia</option>
                                                                                                    <option value="ZA_South Africa">South Africa</option>
                                                                                                    <option value="GS_South Georgia">South Georgia</option>
                                                                                                    <option value="SS_South Sudan">South Sudan</option>
                                                                                                    <option value="ES_Spain">Spain</option>
                                                                                                    <option value="LK_Sri Lanka">Sri Lanka</option>
                                                                                                    <option value="SD_Sudan">Sudan</option>
                                                                                                    <option value="SR_Suriname">Suriname</option>
                                                                                                    <option value="SJ_Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>
                                                                                                    <option value="SZ_Swaziland">Swaziland</option>
                                                                                                    <option value="SE_Sweden">Sweden</option>
                                                                                                    <option value="CH_Switzerland">Switzerland</option>
                                                                                                    <option value="SY_Syria">Syria</option>
                                                                                                    <option value="TW_Taiwan">Taiwan</option>
                                                                                                    <option value="TJ_Tajikistan">Tajikistan</option>
                                                                                                    <option value="TZ_Tanzania">Tanzania</option>
                                                                                                    <option value="TH_Thailand">Thailand</option>
                                                                                                    <option value="TG_Togo">Togo</option>
                                                                                                    <option value="TK_Tokelau">Tokelau</option>
                                                                                                    <option value="TO_Tonga">Tonga</option>
                                                                                                    <option value="TT_Trinidad And Tobago">Trinidad And Tobago</option>
                                                                                                    <option value="TN_Tunisia">Tunisia</option>
                                                                                                    <option value="TR_Turkey">Turkey</option>
                                                                                                    <option value="TM_Turkmenistan">Turkmenistan</option>
                                                                                                    <option value="TC_Turks And Caicos Islands">Turks And Caicos Islands</option>
                                                                                                    <option value="TV_Tuvalu">Tuvalu</option>
                                                                                                    <option value="UG_Uganda">Uganda</option>
                                                                                                    <option value="UA_Ukraine">Ukraine</option>
                                                                                                    <option value="AE_United Arab Emirates">United Arab Emirates</option>
                                                                                                    <option value="GB_United Kingdom">United Kingdom</option>
                                                                                                    <option value="US_United States">United States</option>
                                                                                                    <option value="UM_United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                                                    <option value="UY_Uruguay">Uruguay</option>
                                                                                                    <option value="UZ_Uzbekistan">Uzbekistan</option>
                                                                                                    <option value="VU_Vanuatu">Vanuatu</option>
                                                                                                    <option value="VA_Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                                                                                    <option value="VE_Venezuela">Venezuela</option>
                                                                                                    <option value="VN_Vietnam">Vietnam</option>
                                                                                                    <option value="VG_Virgin Islands (British)">Virgin Islands (British)</option>
                                                                                                    <option value="VI_Virgin Islands (US)">Virgin Islands (US)</option>
                                                                                                    <option value="WF_Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                                                                                                    <option value="EH_Western Sahara">Western Sahara</option>
                                                                                                    <option value="YE_Yemen">Yemen</option>
                                                                                                    <option value="YU_Yugoslavia">Yugoslavia</option>
                                                                                                    <option value="ZM_Zambia">Zambia</option>
                                                                                                    <option value="ZW_Zimbabwe">Zimbabwe</option>
                                                                                                </select></li>
                    <li class="small float-right bt">
                    <button type="button" class="btn btn-primary float-right hotel_search_button" title="Find Hotels">Find Hotels</button></li>
                </ul>
            </form>
           
         <?php } ?>


<?php if(isset( $search_data['nationality'])){ ?>
    <script type="text/javascript">
        $("#select_country option").each(function(){
            var data =$(this).val();
            var arr = data.split('_');
            if(arr[0] == "<?php echo $search_data['nationality'] ?>"){
                $(this).attr("selected","selected");
            }
        }); 


       
    
    </script>
<?php } ?>




<script type="text/javascript">



$(function(){
	  $( ".bp_check_in_date" ).datepicker({
           dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
           showOn: 'both',
           buttonText: '',
           dateFormat: 'dd-mm-yy',
           onSelect: function (selectedDate)
             {
               $(".bp_check_out_date").datepicker("option", "minDate", selectedDate);
             }
      });

	  $( ".bp_check_out_date" ).datepicker({
            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            minDate: "<?php if(isset($min_date)){echo $min_date;} else{ echo 0 ;} ?>",
            showOn: 'both',
            buttonText: '',
            dateFormat: 'dd-mm-yy',
     });
    
});
//------Hotel Check in date--------End------------------
</script>
<script>
$(".bp_room_select").click(function (){
	 $(".hotelguestsdetails").show();
});
$(".bp_room_select").change(function (){
    	 $(".hotelguestsdetails").show();
	var bp_no_rooms = this.value;
	var bp_room_data = "";
	for(var i = 1; i <= bp_no_rooms; i++){
	  bp_room_data += '<div class="roombox clearfix mt-10">\
                         <span class="block fz16 fwb black-color">Room '+i+':</span>\
                         <div class="roomchildbox clearfix border-top">\
                           <div class="row mt15">\
                              <div class="col-sm-6">\
                                <span class="block mb10 black-color fz12">Adult</span>\
                                  <select name="adult_'+i+'" id="adult_'+i+'" class="block width-100 border radius">\
                                    <option value="1">1 Adult</option>\
                                    <option value="2">2 Adults</option>\
                                    <option value="3">3 Adults</option>\
                                    <option value="4">4 Adults</option>\
                                  </select>\
                              </div>\
                              <div class="col-sm-6">\
                                 <span class="block mb10 black-color fz12">Child</span>\
                                 <select name="child_'+i+'" id="child_'+i+'" class="block width-100 border radius" onchange="return bp_child_age(this.value,'+i+');">\
                                    <option value="">0 Child</option>\
                                    <option value="1">1 Child</option>\
                                    <option value="2">2 Children</option>\
                                 </select>\
                              </div>\
                           </div>\
                        <div class="clearfix"></div>\
                        <div id="bp_for_child_dob_'+i+'"></div>\
                        </div>\
                      </div>';	 	
		}
	$(".bp_room_data").html(bp_room_data);
	});
</script>
<script>
	function bp_child_age(value, sect){
	if(value == ""){
	$("#bp_for_child_dob_"+sect).fadeOut(300);
		} else {
	$("#bp_for_child_dob_"+sect).fadeIn(300);
			}
	var bp_age_div_data = "";			
	bp_age_div_data +='<div class="row mt15">';
	for(var i = 1; i <= value; i++){
                        bp_age_div_data +='<div class="col-sm-6">\
                                                <span class="block mb10 black-color fz12">Child '+i+' Age</span>\
                                                <select name="age_'+sect+'_'+i+'" id="age_'+sect+'_'+i+'" class="block width-100 border radius">\
                                                    <option value="1">1 Year</option>\
                                                    <option value="2">2 Years</option>\
                                                    <option value="3">3 Years</option>\
                                                    <option value="4">4 Years</option>\
                                                    <option value="5">5 Years</option>\
                                                    <option value="6">6 Years</option>\
                                                    <option value="7">7 Years</option>\
                                                    <option value="8">8 Years</option>\
                                                    <option value="9">9 Years</option>\
                                                    <option value="10">10 Years</option>\
                                                    <option value="11">11 Years</option>\
                                                    <option value="12">12 Years</option>\
                                                </select>\
                                            </div>';
                                            }
                  bp_age_div_data +='</div>';			
    $("#bp_for_child_dob_"+sect).html(bp_age_div_data);
	
	}
</script>
<script>



function fill(thisValue,code) {
	var addvalue="";
    addvalue=thisValue;
	$('#country').val(addvalue);
	$('.cityDom').val(code);
	$("#country").removeAttr("data-validation");
	$('#suggestions').fadeOut();
}
function suggest(inputString) {
	if(inputString.length <3) {
			 $('#suggestions').fadeOut();	
		}
		else{	
			$('#country').addClass('load');	 
		    $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/hotel/fetch_city",
            data: {id: inputString},
            success: 
              function(data){
				  if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
              }
 });
	   }
   }
</script>
<script>
$(".hotel_search_button").click(function(){
	var data_error=0;
            $(".bp_hotel_search_validation").each(function () {
                if ($(this).val() == "")
                {   data_error=1;
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0)
                } else
                {
                    $(this).css({"border": ""});

                }
            });
	if(data_error == 0){
	//	$(".bp_hotel_search_loaction").text($(".country option:selected").text());
		$(".bp_hotel_check_in").text($(".bp_check_in_date").val());
		$(".bp_hotel_check_out").text($(".bp_check_out_date").val());
		$('#hotel_search_popup').modal('show'); 
		$("#hotel_search_form").submit();
	}else{
      return false;
	}

});
</script>
	