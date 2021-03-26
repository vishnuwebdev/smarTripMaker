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
	<form action="<?php echo site_url();?>visa/search" id="visa_search_form" method="post">
		<div class="row">
			<div class="col-md-3">
				<label for="">Destination</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							<i class="icofont-pin"></i>
						</span>
					</div>
					<select id="select-destination" class="form-control custom-select" name="destination">
						<option value="">Select Destination</option>
						<?php 
						if(!empty($location_list)) { 
							foreach($location_list as $locationdata){ 
								// if($locationdata->location_id == 3){
								?>
								<option value="<?php echo bp_hash($locationdata->location_id); ?>"><?php echo $locationdata->location_location; ?></option>
							<?php }  //} 
						} ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-3">
					<label for="">Visa Type</label>
					<select id="select-rating" class="form-control bp_hotel_search_validation custom-select" name="type" required="">
						<option value="">Select Visa Type</option>
						<?php if(!empty($visalist)) { 
							foreach($visalist as $visadata){ ?>
								<option value="<?php echo $visadata->id ?>"><?php echo $visadata->visa_title.'(<b>Visa Fee : '.convertPrice($visadata->visa_amount).'</b>)' ?></option>
						<?php } } ?>	
					</select>
				</div>
			</div>

			<div class="col-md-12">
				<button  id="" type="button" class="btn btn-search visa_search_button">Search</button>
			</div>
		</div>
	</form>
</div>




					  		  





					  		