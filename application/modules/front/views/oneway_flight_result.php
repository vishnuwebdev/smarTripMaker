
	<?php $this->load->view('header') ?>

		
	
		<!-- ============================================================== -->
		<!-- Concierge Services Starts -->
		<!-- ============================================================== -->
		<section>
			<div class="container position-relative">
				<div class="mb-5 row">
					<div class="col-12 detail-col-left">
						<h2 class="purple">Select your flights</h2>						
						<h3 class="sub-heading">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="42px" height="42px">
								<path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M40.358,23.177 L40.811,22.616 C41.745,21.469 41.690,19.813 40.700,18.663 L40.299,18.209 C39.069,16.872 37.332,16.095 35.515,16.093 L26.995,16.057 L13.010,2.019 C11.833,0.842 10.203,0.173 8.494,0.171 L7.319,0.169 C6.945,0.169 6.544,0.409 6.331,0.729 C6.144,1.076 6.118,1.477 6.306,1.824 L14.414,16.016 L9.233,16.011 L4.366,11.464 C3.885,10.983 3.244,10.715 2.523,10.741 L1.614,10.740 C1.241,10.740 0.867,10.953 0.654,11.273 C0.467,11.620 0.467,11.994 0.601,12.342 L4.323,20.599 L0.540,29.195 C0.380,29.569 0.434,29.997 0.675,30.291 C0.916,30.585 1.236,30.745 1.637,30.719 L2.598,30.720 C3.239,30.721 3.854,30.481 4.441,30.001 L9.323,25.439 L14.505,25.498 L6.374,39.672 C6.188,40.019 6.188,40.447 6.376,40.794 C6.429,40.901 6.483,40.955 6.563,41.035 C6.777,41.248 7.071,41.383 7.391,41.383 L8.567,41.384 C10.276,41.386 11.905,40.720 13.105,39.519 L27.086,25.539 L35.392,25.522 C37.342,25.551 39.184,24.671 40.358,23.177 ZM35.391,24.026 L26.737,24.016 C26.523,24.016 26.336,24.096 26.203,24.229 L12.009,38.423 C11.075,39.357 9.847,39.836 8.538,39.861 L8.004,39.861 L16.374,25.127 C16.508,24.886 16.507,24.619 16.374,24.379 C16.320,24.325 16.320,24.272 16.267,24.218 C16.133,24.085 15.946,24.004 15.732,24.004 L8.948,23.943 C8.734,23.943 8.574,23.996 8.414,24.156 L3.344,28.905 C3.184,29.065 2.891,29.251 2.543,29.224 L2.169,29.224 L5.846,20.895 C5.926,20.708 5.926,20.494 5.819,20.280 L2.231,12.263 L2.551,12.264 C2.711,12.264 3.085,12.318 3.353,12.585 L8.460,17.372 C8.593,17.506 8.780,17.586 8.967,17.559 L15.752,17.567 C16.019,17.567 16.259,17.434 16.392,17.194 C16.526,16.954 16.525,16.686 16.391,16.446 L7.961,1.666 L8.496,1.666 C9.778,1.668 11.034,2.177 11.943,3.086 L26.142,17.338 C26.275,17.472 26.462,17.552 26.676,17.553 L35.517,17.589 C36.906,17.591 38.242,18.180 39.178,19.223 L39.579,19.677 C40.087,20.238 40.088,21.093 39.635,21.654 L39.181,22.214 C38.248,23.361 36.886,24.028 35.391,24.026 Z"/>
							</svg>
							Outbound: Almeria (LEI) - Riyadh (RUH)
							<span>Monday, March 12, 2018</span>
						</h3>
						<ul class="steps step-4 step-4-1">
							<li class="current">
								<span class="number">1</span>
								<span class="label">1 Flights</span>
							</li>
							<li>
								<span class="number">2</span>
								<span class="label">2 Passengers</span>
							</li>
							<li>
								<span class="number">3</span>
								<span class="label">3 Complete your flight</span>
							</li>
							<li>
								<span class="number">4</span>
								<span class="label">4 Payment</span>
							</li>
						</ul>						
					</div>					
				</div>
				<div class="mb-4 row">
					<div class="col-12">
						<div class="white-tabs-large-div">
						  <button id="modify-btn" class="btn btn-primary modify-btn">Modify Search</button>
						  <div class="clear"></div>
							<div class="tabs-detail" id="modify-form">
							<div class="inner">
								<div class="tab-detail active" rel="tab1">
									<form>
										<h3 class="tab-title">Airline Tickets</h3>
										<ul class="form-list">
											<li class="small margin-top-58">
												<div class="radio-btn">
													<span class="radioBt">
														<input type="radio" value="Return" id="return" name="way" checked="checked"><span></span>										
													</span>
													<label for="return">Return</label>
												</div>
												<div class="radio-btn">
													<span class="radioBt">
														<input type="radio" value="One Way" id="oneway" name="way"><span></span>										
													</span>
													<label for="oneway">One Way</label>
												</div>
											</li>
											<li class="location">
												<label>Flying From</label>											
												<input type="text" placeholder="City or airport">
											</li>
											<li class="location">
												<label>Flying To</label>											
												<input type="text" placeholder="City or airport">
											</li>
											<li class="small button-col">
												<a href="#" class="btn btn-primary" title="Search Flights">Search Flights</a>
											</li>
											<li class="small date">
												<label>Departing on</label>											
												<input type="text" placeholder="DD/MM/YYYY" id="departingon" class="hasDatepicker">
											</li>
											<li class="small date">
												<label>Returning on</label>											
												<input type="text" placeholder="DD/MM/YYYY" id="returningon" class="hasDatepicker">
											</li>
											<li class="small class">
												<label>Select class</label>											
												<div class="select"><select class="select-hidden">
													<option>Economy</option>
													<option>Business</option>													
												</select><div class="select-styled selected_undefined" rel="Economy">Economy</div><ul class="select-options option_undefined"><li rel="Economy">Economy</li><li rel="Business">Business</li></ul></div>
											</li>
											<li class="x-small adults">
												<label>Adults (18+)</label>											
												<div class="select"><select class="select-hidden">
													<option>1</option>
													<option>2</option>
													<option>3</option>
												</select><div class="select-styled selected_undefined" rel="1">1</div><ul class="select-options option_undefined"><li rel="1">1</li><li rel="2">2</li><li rel="3">3</li></ul></div>
											</li>
											<li class="x-small child">
												<label>Children (2-12)</label>											
												<div class="select"><select class="select-hidden">
													<option>1</option>
													<option>2</option>
													<option>3</option>
												</select><div class="select-styled selected_undefined" rel="1">1</div><ul class="select-options option_undefined"><li rel="1">1</li><li rel="2">2</li><li rel="3">3</li></ul></div>
											</li>
											<li class="x-small infant">
												<label>Infant (&lt; 2)</label>											
												<div class="select"><select class="select-hidden">
													<option>1</option>
													<option>2</option>
													<option>3</option>
												</select><div class="select-styled selected_undefined" rel="1">1</div><ul class="select-options option_undefined"><li rel="1">1</li><li rel="2">2</li><li rel="3">3</li></ul></div>
											</li>
										</ul>									
									</form>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="select-flight-tbl">
							<table width="100%">
							    <thead>
									<tr>
										<th  class="white-bg-select">
											<div class="text">Depature  -  Arrival</div>
										</th>
										<th>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="left">
												<div>
													<span class="float-left">20:50  -</span>
													<span class="float-right text-right">
														22:55<br/>
														<span class="font-size-12">+1 day</span>
													</span>
												</div>
												<div class="font-size-12">
													Duration:  24h 5m
												</div>
											</div>
											<div class="right">
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-1.jpg"/>
													Air Nostrum
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-2.jpg"/>
													Iberia
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-3.jpg"/>
													British Airways
												</div>
												<div class="font-size-12">
													2 Stopovers &nbsp;-&nbsp; LEI, MAD, LHR, RUH
												</div>
											</div>
										</td>
										<td>
											<div class="radio-btn">
												<span class="radioBt">
													<input type="radio" value="" name="flightradio" id="flightrow1"><span></span>
												</span>
												<label for="flightrow1">381 €</label>
											</div>
											<span class="tick"><img src="<?php echo site_url();?>assets/images/tick.png"/></span>
										</td>
									</tr>								
									<tr>
										<td>
											<div class="left">
												<div>
													<span class="float-left">20:50  -</span>
													<span class="float-right text-right">
														22:55<br/>
														<span class="font-size-12">+1 day</span>
													</span>
												</div>
												<div class="font-size-12">
													Duration:  24h 5m
												</div>
											</div>
											<div class="right">
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-1.jpg"/>
													Air Nostrum
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-2.jpg"/>
													Iberia
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-3.jpg"/>
													British Airways
												</div>
												<div class="font-size-12">
													2 Stopovers &nbsp;-&nbsp; LEI, MAD, LHR, RUH
												</div>
											</div>
										</td>
										<td>
											<div class="radio-btn">
												<span class="radioBt">
													<input type="radio" value="" name="flightradio" id="flightrow23"><span></span>
												</span>
												<label for="flightrow23">381 €</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left">
												<div>
													<span class="float-left">20:50  -</span>
													<span class="float-right text-right">
														22:55<br/>
														<span class="font-size-12">+1 day</span>
													</span>
												</div>
												<div class="font-size-12">
													Duration:  24h 5m
												</div>
											</div>
											<div class="right">
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-1.jpg"/>
													Air Nostrum
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-2.jpg"/>
													Iberia
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-3.jpg"/>
													British Airways
												</div>
												<div class="font-size-12">
													2 Stopovers &nbsp;-&nbsp; LEI, MAD, LHR, RUH
												</div>
											</div>
										</td>
										<td>
											<div class="radio-btn">
												<span class="radioBt">
													<input type="radio" value="" name="flightradio" id="flightrow33"><span></span>
												</span>
												<label for="flightrow33">381 €</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left">
												<div>
													<span class="float-left">20:50  -</span>
													<span class="float-right text-right">
														22:55<br/>
														<span class="font-size-12">+1 day</span>
													</span>
												</div>
												<div class="font-size-12">
													Duration:  24h 5m
												</div>
											</div>
											<div class="right">
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-1.jpg"/>
													Air Nostrum
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-2.jpg"/>
													Iberia
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-3.jpg"/>
													British Airways
												</div>
												<div class="font-size-12">
													2 Stopovers &nbsp;-&nbsp; LEI, MAD, LHR, RUH
												</div>
											</div>
										</td>
										<td>
											<div class="radio-btn">
												<span class="radioBt">
													<input type="radio" value="" name="flightradio" id="flightrow43"><span></span>
												</span>
												<label for="flightrow43">381 €</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left">
												<div>
													<span class="float-left">20:50  -</span>
													<span class="float-right text-right">
														22:55<br/>
														<span class="font-size-12">+1 day</span>
													</span>
												</div>
												<div class="font-size-12">
													Duration:  24h 5m
												</div>
											</div>
											<div class="right">
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-1.jpg"/>
													Air Nostrum
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-2.jpg"/>
													Iberia
												</div>
												<div>
													<img src="<?php echo site_url();?>assets/images/airline-3.jpg"/>
													British Airways
												</div>
												<div class="font-size-12">
													2 Stopovers &nbsp;-&nbsp; LEI, MAD, LHR, RUH
												</div>
											</div>
										</td>
										<td>
											<div class="radio-btn">
												<span class="radioBt">
													<input type="radio" value="" name="flightradio" id="flightrow53"><span></span>
												</span>
												<label for="flightrow53">381 €</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="notes">
							<div class="row">
								<div class="col-12 col-md-7 font-size-14 font-medium">
									Please select an outbound flight<br/>
									Please select a return flight
								</div>
								<div class="col-12 col-md-5 text-right btn-div">
									<a href="#" class="btn btn-primary float-right margin-right-14" title="Continue">Continue</a>
								</div>
								<div class="col-12 font-size-14 margin-top-23">
									Total price, includes air fare, <a href="#" title="taxes" class="font-medium">taxes</a> [Open in a new window] (except those charged at certain airports at the time of check-in), handling fees, operator charges and selected options. If you choose to pay for your trip with one of these <a href="#" title="cards" class="font-medium">cards</a> [Open in a new window], a surcharge of 1% of the final amount on long-haul flights and 2% on all other flights will apply per booking.
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="flight-detail-popup">
					<div class="flight-detail-popup-row">
						<a href="#" class="close-btn"></a>
						<div class="row flight-items-row">
							<div class="col-12 col-md-4 flight-item">													
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABEVBMVEX////y8vLFxcWwr6/JyMjq6ur////+/v7Hxsa2tbXZ2dn6+vrJyMitrKzOzs709PTMy8upqKjz8/P4+Pjn5+fj4+Pt7e3Pzs7Jx8f7+/vg4ODAv7+pqKjV1dXR0dHHxsbx8fH+/v7o6Oisq6vV1NSop6fQz8/9/f3X19erqqry8vL+/v7a2tq1tLTZ2Nj5+fnPz8+sq6vFxMTm5eX39/fS0tKrqqqqqanGxcXp6ene3t6xsLDR0NDw8PDu7u7Ix8ezsrLW1dX39/fKysqzsrLDwsLm5ub9/f26ubm2tbXT0tL19fWvrq69vLzk5OTn5+erqqq5uLjKysrc29v9/f3o6Oiop6epp6eop6aopqb///+vfLbxAAAAVnRSTlMAJ6npnz4BA6XXbw6e8Y8flvskFUVRNI6hC1u5/HqGpCgCQ/N8/ooGdfYmBGvYcBKM9KpKGIP1+ahBYeWILDGh3nkXmuCxSQfL1oEd68JORvfOm2cFRNGxLC0AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEiI5PXFougAAAOVJREFUKM9jYGBgYGRiZmFlY8AJ2DnCwsI4ubhxK+ABKgjj5ePHpYBNAKQgTJBHCCEmLCIqxg5XIB4GUSHBCOZLSknLhIWFM8vClcuB5cPDZOQVFJVYlCHKw6QR5qlAhcJUmcPCIiCmqakjOUIDKh8JpTV5tEDC2nAFOqpA8yOgsrp6+mBBA0MjY4gzTUzNYFaYW1jCwssKyLW2sWWwszeHyTo4OiFZ6wwWc4FIRYTJuLopooSNu0cY1GtAp3t6eWMEHr8PxLm+Nn7CWEPXPyAwKFgsBE8EMgxdEIofMMACHR5xqAAASelOZFAB/sMAAAAASUVORK5CYII=" />
										</svg>
										20:50h
									</div>
									<div class="font-size-12">
										Duration: 1h 10m
									</div>
								</div>
								<div class="float-left">
									Almeria<br/>Almeria (LEI)
								</div>													
							</div>
							<div class="col-12 col-md-5 flight-item">
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABLFBMVEX////+/v6ysLCop6fa2dnNzMzg4ODq6emqqano6Oiwr6+trKzx8fHMzMy1tLT6+vrBwcG8u7vp6enDwsL////W1taqqang39/+/v6wr6/Z2dn19fWpqKjU09PLysqrqqrv7++9vb3Ozs7o6Oi3trb8/Pzc3NzKysr+/v6vrq7NzMz5+fmzsrK9vLzHxsbPz8/Z2Ni6ubnl5eXPzs6vrq7e3d3t7e37+/v7+/vi4uLGxcWtrKzBwMDQz8/f39/4+Pj9/f3m5ubMy8uysbGpqKjIyMju7u7Avr6urq61tLT19fXv7u7j4+PY19e4t7fR0dG2tbXr6+vs6+vq6urf3t7T09PIx8fAwMC3tbXW1tbm5uby8vL39/e7u7vGxsaop6epp6eop6aopqb///+tip68AAAAX3RSTlMAAub+bZNbP/lC5/AqldgPtcRBsAF4+FwD6W4d/X+Z9y7Aj0TTCWabBOuUEt/BpIxwykyO6mI1Cw1Vp/G2il4UB0iW4/ygMrvs2RwwUXPQhtc6OT1fgKK413dJJRjGpkuq5W8AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEjAe4I+tAgAAAQNJREFUKM9jYIACRiZmFgZ8gDWemQ2fPHt8PAcnHnlGrvh4bh48Cnjj4+P5+NFFBQTZoSwhoHy8sAiavGi8mDiEJSEJUiCFJi8tE88sC2HKgeTlFdAUKAIFlcCmKoPk41VUUeXVQILqEkCWhiZYgRaqvDZHfEJ8vI6unr6BIVA2IZ7ZCFWBsTxIFAmYmJqZIyuwsLSyRlEQH8+sY2NrZ49Q4uDo5BwPMyYRqsjFVRvJFBE3UXcPFIsS4j290DzL7+3jy2vDJwaUTQIp8UOT9w8IFLEMYhDxCg4JDbMJt0IPzYj4yKh4DoxIgoNoNoeY2DhGBuoBZfyAAe7bJCidiOT/+HgARSBQxne40BwAAAAASUVORK5CYII=" />
										</svg>
										22:00h
									</div>															
								</div>
								<div class="float-left">
									Madrid
									<div class="light-color-text">
										Adolfo Suarez Barajas<br/>
										(MAD)<br/>
										Terminal 4
									</div>
								</div>													
							</div>
							<div class="col-12 col-md-3 flight-item">
								<div class="flight-item-left margin-right-10">														
									<img src="assets/images/airline-1.jpg" alt="Air Nostrum"/>														
								</div>
								<div class="float-left width-auto">
									<a href="#">IB8597</a>
									<div>
										Air Nostrum<br/>CRK
									</div>
								</div>													
							</div>
						</div>
					</div>
					<div class="flight-detail-popup-row">
						<div class="row flight-items-row">
							<div class="col-12 col-md-4 flight-item">													
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABEVBMVEX////y8vLFxcWwr6/JyMjq6ur////+/v7Hxsa2tbXZ2dn6+vrJyMitrKzOzs709PTMy8upqKjz8/P4+Pjn5+fj4+Pt7e3Pzs7Jx8f7+/vg4ODAv7+pqKjV1dXR0dHHxsbx8fH+/v7o6Oisq6vV1NSop6fQz8/9/f3X19erqqry8vL+/v7a2tq1tLTZ2Nj5+fnPz8+sq6vFxMTm5eX39/fS0tKrqqqqqanGxcXp6ene3t6xsLDR0NDw8PDu7u7Ix8ezsrLW1dX39/fKysqzsrLDwsLm5ub9/f26ubm2tbXT0tL19fWvrq69vLzk5OTn5+erqqq5uLjKysrc29v9/f3o6Oiop6epp6eop6aopqb///+vfLbxAAAAVnRSTlMAJ6npnz4BA6XXbw6e8Y8flvskFUVRNI6hC1u5/HqGpCgCQ/N8/ooGdfYmBGvYcBKM9KpKGIP1+ahBYeWILDGh3nkXmuCxSQfL1oEd68JORvfOm2cFRNGxLC0AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEiI5PXFougAAAOVJREFUKM9jYGBgYGRiZmFlY8AJ2DnCwsI4ubhxK+ABKgjj5ePHpYBNAKQgTJBHCCEmLCIqxg5XIB4GUSHBCOZLSknLhIWFM8vClcuB5cPDZOQVFJVYlCHKw6QR5qlAhcJUmcPCIiCmqakjOUIDKh8JpTV5tEDC2nAFOqpA8yOgsrp6+mBBA0MjY4gzTUzNYFaYW1jCwssKyLW2sWWwszeHyTo4OiFZ6wwWc4FIRYTJuLopooSNu0cY1GtAp3t6eWMEHr8PxLm+Nn7CWEPXPyAwKFgsBE8EMgxdEIofMMACHR5xqAAASelOZFAB/sMAAAAASUVORK5CYII=" />
										</svg>
										20:50h
									</div>
									<div class="font-size-12">
										Duration: 1h 10m
									</div>
								</div>
								<div class="float-left">
									Almeria<br/>Almeria (LEI)
								</div>													
							</div>
							<div class="col-12 col-md-5 flight-item">
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABLFBMVEX////+/v6ysLCop6fa2dnNzMzg4ODq6emqqano6Oiwr6+trKzx8fHMzMy1tLT6+vrBwcG8u7vp6enDwsL////W1taqqang39/+/v6wr6/Z2dn19fWpqKjU09PLysqrqqrv7++9vb3Ozs7o6Oi3trb8/Pzc3NzKysr+/v6vrq7NzMz5+fmzsrK9vLzHxsbPz8/Z2Ni6ubnl5eXPzs6vrq7e3d3t7e37+/v7+/vi4uLGxcWtrKzBwMDQz8/f39/4+Pj9/f3m5ubMy8uysbGpqKjIyMju7u7Avr6urq61tLT19fXv7u7j4+PY19e4t7fR0dG2tbXr6+vs6+vq6urf3t7T09PIx8fAwMC3tbXW1tbm5uby8vL39/e7u7vGxsaop6epp6eop6aopqb///+tip68AAAAX3RSTlMAAub+bZNbP/lC5/AqldgPtcRBsAF4+FwD6W4d/X+Z9y7Aj0TTCWabBOuUEt/BpIxwykyO6mI1Cw1Vp/G2il4UB0iW4/ygMrvs2RwwUXPQhtc6OT1fgKK413dJJRjGpkuq5W8AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEjAe4I+tAgAAAQNJREFUKM9jYIACRiZmFgZ8gDWemQ2fPHt8PAcnHnlGrvh4bh48Cnjj4+P5+NFFBQTZoSwhoHy8sAiavGi8mDiEJSEJUiCFJi8tE88sC2HKgeTlFdAUKAIFlcCmKoPk41VUUeXVQILqEkCWhiZYgRaqvDZHfEJ8vI6unr6BIVA2IZ7ZCFWBsTxIFAmYmJqZIyuwsLSyRlEQH8+sY2NrZ49Q4uDo5BwPMyYRqsjFVRvJFBE3UXcPFIsS4j290DzL7+3jy2vDJwaUTQIp8UOT9w8IFLEMYhDxCg4JDbMJt0IPzYj4yKh4DoxIgoNoNoeY2DhGBuoBZfyAAe7bJCidiOT/+HgARSBQxne40BwAAAAASUVORK5CYII=" />
										</svg>
										22:00h
									</div>															
								</div>
								<div class="float-left">
									Madrid
									<div class="light-color-text">
										Adolfo Suarez Barajas<br/>
										(MAD)<br/>
										Terminal 4
									</div>
								</div>													
							</div>
							<div class="col-12 col-md-3 flight-item">
								<div class="flight-item-left margin-right-10">														
									<img src="assets/images/airline-1.jpg" alt="Air Nostrum"/>														
								</div>
								<div class="float-left width-auto">
									<a href="#">IB8597</a>
									<div>
										Air Nostrum<br/>CRK
									</div>
								</div>													
							</div>
						</div>						
					</div>
					<div class="purple-bg">2h 45m layover in London, Heathrow (LHR)</div>
					<div class="flight-detail-popup-row last">
						<div class="row flight-items-row">
							<div class="col-12 col-md-4 flight-item">													
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABEVBMVEX////y8vLFxcWwr6/JyMjq6ur////+/v7Hxsa2tbXZ2dn6+vrJyMitrKzOzs709PTMy8upqKjz8/P4+Pjn5+fj4+Pt7e3Pzs7Jx8f7+/vg4ODAv7+pqKjV1dXR0dHHxsbx8fH+/v7o6Oisq6vV1NSop6fQz8/9/f3X19erqqry8vL+/v7a2tq1tLTZ2Nj5+fnPz8+sq6vFxMTm5eX39/fS0tKrqqqqqanGxcXp6ene3t6xsLDR0NDw8PDu7u7Ix8ezsrLW1dX39/fKysqzsrLDwsLm5ub9/f26ubm2tbXT0tL19fWvrq69vLzk5OTn5+erqqq5uLjKysrc29v9/f3o6Oiop6epp6eop6aopqb///+vfLbxAAAAVnRSTlMAJ6npnz4BA6XXbw6e8Y8flvskFUVRNI6hC1u5/HqGpCgCQ/N8/ooGdfYmBGvYcBKM9KpKGIP1+ahBYeWILDGh3nkXmuCxSQfL1oEd68JORvfOm2cFRNGxLC0AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEiI5PXFougAAAOVJREFUKM9jYGBgYGRiZmFlY8AJ2DnCwsI4ubhxK+ABKgjj5ePHpYBNAKQgTJBHCCEmLCIqxg5XIB4GUSHBCOZLSknLhIWFM8vClcuB5cPDZOQVFJVYlCHKw6QR5qlAhcJUmcPCIiCmqakjOUIDKh8JpTV5tEDC2nAFOqpA8yOgsrp6+mBBA0MjY4gzTUzNYFaYW1jCwssKyLW2sWWwszeHyTo4OiFZ6wwWc4FIRYTJuLopooSNu0cY1GtAp3t6eWMEHr8PxLm+Nn7CWEPXPyAwKFgsBE8EMgxdEIofMMACHR5xqAAASelOZFAB/sMAAAAASUVORK5CYII=" />
										</svg>
										20:50h
									</div>
									<div class="font-size-12">
										Duration: 1h 10m
									</div>
								</div>
								<div class="float-left">
									Almeria<br/>Almeria (LEI)
								</div>													
							</div>
							<div class="col-12 col-md-5 flight-item">
								<div class="flight-item-left">
									<div class="font-medium">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="23px">
											<image x="0px" y="0px" width="31px" height="23px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAXCAMAAADEI2RmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABLFBMVEX////+/v6ysLCop6fa2dnNzMzg4ODq6emqqano6Oiwr6+trKzx8fHMzMy1tLT6+vrBwcG8u7vp6enDwsL////W1taqqang39/+/v6wr6/Z2dn19fWpqKjU09PLysqrqqrv7++9vb3Ozs7o6Oi3trb8/Pzc3NzKysr+/v6vrq7NzMz5+fmzsrK9vLzHxsbPz8/Z2Ni6ubnl5eXPzs6vrq7e3d3t7e37+/v7+/vi4uLGxcWtrKzBwMDQz8/f39/4+Pj9/f3m5ubMy8uysbGpqKjIyMju7u7Avr6urq61tLT19fXv7u7j4+PY19e4t7fR0dG2tbXr6+vs6+vq6urf3t7T09PIx8fAwMC3tbXW1tbm5uby8vL39/e7u7vGxsaop6epp6eop6aopqb///+tip68AAAAX3RSTlMAAub+bZNbP/lC5/AqldgPtcRBsAF4+FwD6W4d/X+Z9y7Aj0TTCWabBOuUEt/BpIxwykyO6mI1Cw1Vp/G2il4UB0iW4/ygMrvs2RwwUXPQhtc6OT1fgKK413dJJRjGpkuq5W8AAAABYktHRACIBR1IAAAAB3RJTUUH4gQBEjAe4I+tAgAAAQNJREFUKM9jYIACRiZmFgZ8gDWemQ2fPHt8PAcnHnlGrvh4bh48Cnjj4+P5+NFFBQTZoSwhoHy8sAiavGi8mDiEJSEJUiCFJi8tE88sC2HKgeTlFdAUKAIFlcCmKoPk41VUUeXVQILqEkCWhiZYgRaqvDZHfEJ8vI6unr6BIVA2IZ7ZCFWBsTxIFAmYmJqZIyuwsLSyRlEQH8+sY2NrZ49Q4uDo5BwPMyYRqsjFVRvJFBE3UXcPFIsS4j290DzL7+3jy2vDJwaUTQIp8UOT9w8IFLEMYhDxCg4JDbMJt0IPzYj4yKh4DoxIgoNoNoeY2DhGBuoBZfyAAe7bJCidiOT/+HgARSBQxne40BwAAAAASUVORK5CYII=" />
										</svg>
										22:00h
									</div>															
								</div>
								<div class="float-left">
									Madrid
									<div class="light-color-text">
										Adolfo Suarez Barajas<br/>
										(MAD)<br/>
										Terminal 4
									</div>
								</div>													
							</div>
							<div class="col-12 col-md-3 flight-item">
								<div class="flight-item-left margin-right-10">														
									<img src="assets/images/airline-1.jpg" alt="Air Nostrum"/>														
								</div>
								<div class="float-left width-auto">
									<a href="#">IB8597</a>
									<div>
										Air Nostrum<br/>CRK
									</div>
								</div>													
							</div>
						</div>						
					</div>
				</div>
				
			</div>
		</section>
		<!-- ============================================================== -->
		<!-- Content Ends -->
		<!-- ============================================================== -->
	
		

<?php $this->load->view('footer') ?>
<script>
		  $("#modify-btn").click(function(){
		    $("#modify-form").toggle(700);
		  })
		</script>