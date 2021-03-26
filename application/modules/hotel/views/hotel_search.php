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
    z-index: 22;
    height: auto;
    max-height: 200px;
    overflow-y: scroll;
    box-shadow: 0px 3px 7px 2px #C1C1C1;
    margin: 0px 0px 0px 0px;
    top: 100%;
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
.ui-datepicker-trigger{
    right: 0px;
}
</style>
	<div class="search-bar-col flight-wrap-col hotel-wrap-col">
					  			<form action="<?php echo site_url();?>hotel/search" id="hotel_search_form" method="post">
					  				<div class="row">
					  					<div class="col-md-6">
				  							<label for="">Region, City, Area (Worldwide)</label>
				  							<div class="input-group mb-3">
				  								<div class="input-group-prepend">
				  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
												</div>
												<input type="text" class="form-control input-lg bp_hotel_search_validation" autocomplete="off" placeholder="Region, City, Area (Worldwide)" name="location" id="country" onkeyup="suggest(this.value);" onblur="bp_fill();" />
												<div class="suggestionsBox" id="suggestions" style="display: none;">
												<div class="suggestionList" id="suggestionsList">&nbsp;</div>
												</div>
												<input type="hidden" id="cityDom" name="cityDom" /> 
											</div>
				  						</div>
				  						<div class="col-md-3">
				  							<label for="">Check In</label>
				  							<div class="input-group mb-3">
				  								<div class="input-group-prepend">
				  									<span class="input-group-text">
				  										<i class="icofont-ui-calendar"></i>
				  									</span>
												</div>
												<input type="text" class="form-control input-lg bp_hotel_search_validation" placeholder="Check-in" id="bp_check_in_date" name="checkin" required="" autocomplete="off"> 
											</div>
				  						</div>
				  						<div class="col-md-3">
				  							<label for="">Check Out</label>
				  							<div class="input-group mb-3">
				  								<div class="input-group-prepend">
				  									<span class="input-group-text">
				  										<i class="icofont-ui-calendar"></i>
				  									</span>
												</div>
												<input type="text" class="form-control input-lg bp_hotel_search_validation" placeholder="Check-out" id="bp_check_out_date" name="checkout" placeholder="Check-Out" required="" autocomplete="off"> 
											</div>
				  						</div>
				  						<div class="col-md-4">
				  							<div class="form-group mb-3">
				  								<label for="">Select Rating</label>
				  								<select id="select-rating" class="form-control custom-select" name="rating">
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
				  								</select>
				  							</div>
				  						</div>
				  						<div class="col-md-4">
				  							<div class="form-group mb-3">
				  								<label for="">Nationality</label>
				  								<select id="select-rating" name="country" class="form-control  custom-select bp_hotel_search_validation" name="rating">
				  									<option value="">Select Nationality</option>
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
						                            <option selected value="IN_India">India</option>
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
				  								</select>
				  							</div>
				  						</div>
				  						<div class="col-md-4">
				  							<div class="form-group mb-3">
				  								<label for="">Select Room</label>
				  								<select id="adults" class="form-control bp_room_select custom-select" name="room">
				  									<option value="1">1</option>
						  							<option value="2">2</option>
						  							<option value="3">3</option>
						  							<option value="4">4</option>
													<option value="5">5</option>
						  							<option value="6">6</option>
				  								</select>
				  								<div class="hotelguestsdetails" style="display: none;">
				  									<div class="bp_room_data">
				  										<div class="roombox">
				  											<span class="d-block rmttl fwd mb-1">Room 1:</span>
				  											<div class="roomchildbox border-top pt-2">
				                                              <div class="row mb-2">
				                                                  <div class="col-sm-6">
				                                                      <label>Adult(12+ Yrs)</label>
				                                                      <select name="adult_1" id="adult_1" class="form-control custom-select">
				                                                          <option value="1">1 Adult</option>
				                                                          <option value="2">2 Adults</option>
				                                                          <option value="3">3 Adults</option>
				                                                          <option value="4">4 Adults</option>
																		  <option value="5">5 Adults</option>
				                                                          <option value="6">6 Adults</option>
				                                                          <option value="7">7 Adults</option>
				                                                          <option value="8">8 Adults</option>
				                                                      </select>
				                                                  </div>
				                                                  <div class="col-sm-6">
				                                                      <label class="block mb10 black-color fz12">Child(2-11 Yrs)</label>
				                                                      <select name="child_1" id="child_1" class="form-control custom-select" onchange="bp_child_age(this.value,1);">
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
					                                  <div class="addremovedone pt-2 text-md-right">
					                                        <a id="rooms_add" class="btn btn-search searchenginehoteldone">DONE</a>
					                                   </div>
					                              </div>
				  							</div>
				  						</div>
				  						<div class="col-md-12">
				  							<button  id="" type="button" class="btn btn-search hotel_search_button">Search</button>
				  						</div>
					  				</div>
					  			</form>
					  		</div>