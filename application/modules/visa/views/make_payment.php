<?php $this->load->view("include/head"); ?>
<?php $this->load->view("include/header"); ?>

 <!-- User dashboard start from here -->
<section class="user-dashboard dash-wrap">
	<div class="container-fluid">
		<div class="row">
		 <?php $this->load->view("customersidebar"); ?>
			 <div class="col-md-9">
			 	<div class="user-sidebar-wrapper pt-2 pt-md-5">
			 		<div class="inner-user-paul">
			 			<div class="card-header-paul">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<div class="card-head-top">
			 							<h1 class="mb-0"><i class="icofont-rupee-plus"></i> Payment Upload</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"><?php echo $this->session->userdata("Userlogin")["name"]; ?>!</span> </h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Payment Upload</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
			 					
			                    <h4 class="htl-title">Upload Payment</h4>
						<form name="frmTransaction" method="POST" action="<?php echo site_url('user/deposite_payment_request');?>" id="frmTransaction" onsubmit="return validate_payu()">
			       <input type="hidden" class="form-control" placeholder="City" value="New Delhi" name="city">
				  <input type="hidden" class="form-control" placeholder="State" value="New Delhi" name="state"> <input type="hidden" class="form-control" placeholder="Postal Code" value="110031" name="zipcode"> <input type="hidden" value="India" name="country">
							  <div class="row">							  
			                    	
			                        <div class="col-md-4">
			                        	<div class="form-group">
			                        		<label for="deposit-amount">Name</label>
			                        		<input type="text" name="firstname" id="deposit-amount" class="form-control" placeholder="Name" value="" required="required">
				                        </div>
				                    </div>
				                    <div class="col-md-4">
				                    	<div class="form-group">
				                    		<label for="deposit-branch">Email</label>
				                    		<input type="email" name="email" id="deposit-branch" class="form-control" value="" required="" placeholder="Email">
			                        	</div>
			                      </div>
			                      <div class="col-md-4">
			                        <div class="form-group">
			                        	<label for="cheque-issue-bank">Mobile</label>
			                        	<input type="number" name="phone" id="cheque-issue-bank" class="form-control" value="" required="" placeholder="Mobile No.">
			                        </div>
			                      </div>
			                      <div class="col-md-4">
			                      	<div class="form-group">
			                      		<label for="cheque-issue-bank">Address</label>
			                      		<input type="text" name="address1" id="cheque-issue-date" class="form-control" value="" required="" placeholder="Address">
			                        </div>
			                      </div>
			                      <div class="col-md-4">
			                        <div class="form-group">
			                          <label for="cheque-issue-bank">Amount</label>
			                          <input type="text" name="amount1" id="cheque-number" class="form-control srdv_amount" value="" required="" onkeypress="validate(event)" onkeyup="validate_amount(this.value)" onchange="validate_amount()" placeholder="Enter Amount">
			                        </div>
			                      </div>		                    
			                     
			                      <div class="col-md-4">
			                        <div class="form-group">
									  <label for="cheque-issue-bank">Description</label>
			                         <input type="text" name="description" id="cheque-issue-date" class="form-control" value="Online Payment" required="">
			                        </div>
			                      </div>
								   <div class="col-md-4">
			                         <div class="form-group">
									<!--Hidden fields--->
									<input type="hidden" name="con_fee" value="<?php echo $getwayList->dsapayg_convenience_fee?>" class="convenience_fee" />
									<input type="hidden" name="con_fee_type" value="<?php echo $getwayList->dsapayg_type?>" class="convenience_fee_type" />
									
									<!----->
									<label class="control-label"><strong>Payment Mode</strong></label>
									<div class="input text">
										<p>Grand Total</p> <b><p class="srdv_for_final_payment"></p></b>
								<input type="hidden" class="form-control" placeholder="Enter Amount" name="amount" id="net_pay" readonly="">
									</div>
								</div>
			                        </div>
								  
			                       <div class="col-md-8">
			                          <div class="form-group">
			                              <button class="btn btn-search" id="upload_profile">Submit</button>
			                          </div>
			                        </div>
			                    </div>
								
								</form>
								
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>
	</div>
</section>
<!-- User dashboard end from here -->
    
  

<?php $this->load->view("include/footer"); ?>
<?php $this->load->view("js"); ?>

<script>
$('#upload_profile').click(function(){
	$('#update_data').submit();
})
</script>
			<script type="text/javascript">
		$(document).ready(function() {
			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');
			    accordion_head.on('click', function(event) {
				event.preventDefault();
				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}
			});
		});
	</script>
	<script>
   $(".srdv_check_balance").click(function(){
     $(this).html('Account bal (Cash) <i class="fa fa-inr" aria-hidden="true"></i> ');
   });
	</script>
	<script>
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
	  alert("Kindly Enter Only Nubmers");
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  } 
}
</script>
<script>
function validate_payu(){
	var frm = document.frmTransaction;
	var aName = Array();

	aName['amount1'] = 'Amount';
	aName['description'] = 'Description';
	aName['firstname'] = 'Billing Name';
	aName['address1'] = 'Billing Address';
	aName['city'] = 'Billing City';
	aName['state'] = 'Billing State';
	aName['zipcode'] = 'Billing Postal Code';
	aName['country'] = 'Billing Country';
	aName['email'] = 'Billing Email';
	aName['phone'] = 'Billing Phone Number';
	for(var i = 0; i < frm.elements.length-1 ; i++){
		if((frm.elements[i].value.length == 0)){
						if((frm.elements[i].name=='country'))
					alert("Select the " + aName[frm.elements[i].name]);
					else
					alert("Enter the " + aName[frm.elements[i].name]);
				frm.elements[i].focus();
				return false;
			}
	
			
			if(frm.elements[i].name=='amount'){
			if(!validateNumeric(frm.elements[i].value)){
					alert("Amount should be NUMERIC");
					$('#amount_alert').text('Amount should be NUMERIC');
					
			frm.elements[i].focus();
			return false;
			}
			}
			if((frm.elements[i].name=='zipcode'))
			{
			if(!validateNumeric(frm.elements[i].value)){
					alert("Postal code should be NUMERIC");
			frm.elements[i].focus();
			return false;
			}
			}	
			

    	
    
	
		if((frm.elements[i].name == 'firstname'))
		{
		
		if(validateNumeric(frm.elements[i].value)){
					alert("Enter your Name");
			frm.elements[i].focus();
			return false;
			}
		}
		
				
			if((frm.elements[i].name=='phone')){
			if(!validateNumeric(frm.elements[i].value)){
					alert("Enter a Valid CONTACT NUMBER");
			frm.elements[i].focus();
			return false;
			}
			}
    
			
							
		if(frm.elements[i].name == 'email'){
				if(!validateEmail(frm.elements[i].value)){
					alert("Invalid input for " + aName[frm.elements[i].name]);
					frm.elements[i].focus();
					return false;
				}		
			}
			
	}  
	return true;
	
	
}


	function validateNumeric(numValue){
		if (!numValue.toString().match(/^[-]?\d*\.?\d*$/)) 
				return false;
		return true;		
	}

function validateEmail(email) {
    //Validating the email field
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	//"
    if (! email.match(re)) {
        return (false);
    }
    return(true);
}


Array.prototype.inArray = function (value)
// Returns true if the passed value is found in the
// array.  Returns false if it is not.
{
    var i;
    for (i=0; i < this.length; i++) {
        // Matches identical (===), not just similar (==).
        if (this[i] === value) {
            return true;
        }
    }
    return false;
};

function validate_amount()
{
    var amount=$(".srdv_amount").val();
	if(amount!="")
	{	
        $(".srdv_for_final_payment").show();
		var payment_mode=$(".srdv_payment_mode").val();		
		var convenience_fee=$(".convenience_fee").val();
		var type=$(".convenience_fee_type").val();
		
		
	// alert(type);
	
	
			if(type == "fix"){
		 
				var sadsad= parseFloat(amount);
				$(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
				document.getElementById("net_pay").value=(sadsad.toFixed(2));		  
				var pay_t_amount = convenience_fee;
			  var sadsad= parseFloat(pay_t_amount)+parseFloat(amount);
			  $(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
			  document.getElementById("net_pay").value=(sadsad.toFixed(2));
		  
		  $(".srdv_for_convence_fee_display").html('0 % Convenience Fee On Net Banking<br> (if amount > 5000 else <i class="fa fa-inr" aria-hidden="true"></i> 12 )');
		}
		else{
			 var pay_t_amount = convenience_fee;
			 var payment_getway_tax=pay_t_amount/100;
			 var pay_t_amount=payment_getway_tax*amount;
			 var sadsad= parseFloat(pay_t_amount)+parseFloat(amount);
			 $(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
			$(".srdv_for_convence_fee_display").html('2 % Convenience Fee On Credit/Debit Card<br> (Charge -  <i class="fa fa-inr" aria-hidden="true"></i> '+pay_t_amount+')');
			 document.getElementById("net_pay").value=(sadsad.toFixed(2));
		}
	} else {
		$(".srdv_for_final_payment").hide();
	}
	
	
	
		// if(payment_mode == "net_banking"){
		  // if(amount >= 5000){
				// var sadsad= parseFloat(amount);
				// $(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
				// document.getElementById("net_pay").value=(sadsad.toFixed(2));
		  // }else{
			  // var pay_t_amount=12;
			  // var sadsad= parseFloat(pay_t_amount)+parseFloat(amount);
			  // $(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
			  // document.getElementById("net_pay").value=(sadsad.toFixed(2));
		  // }
		  // $(".srdv_for_convence_fee_display").html('0 % Convenience Fee On Net Banking<br> (if amount > 5000 else <i class="fa fa-inr" aria-hidden="true"></i> 12 )');
		// }else{
			 // var pay_t_amount=2;
			 // var payment_getway_tax=pay_t_amount/100;
			 // var pay_t_amount=payment_getway_tax*amount;
			 // var sadsad= parseFloat(pay_t_amount)+parseFloat(amount);
			 // $(".srdv_for_final_payment").html('<i class="fa fa-inr" aria-hidden="true"></i> '+sadsad);
			// $(".srdv_for_convence_fee_display").html('2 % Convenience Fee On Credit/Debit Card<br> (Charge -  <i class="fa fa-inr" aria-hidden="true"></i> '+pay_t_amount+')');
			 // document.getElementById("net_pay").value=(sadsad.toFixed(2));
		// }
	// } else {
		// $(".srdv_for_final_payment").hide();
	// }
	
}
</script>
	<script>
$(function () {
    var url = window.location.pathname; 
    var accordion_head = $('.accordion > li > a'),
	accordion_body = $('.accordion li > .sub-menu');
	    $('.accordion > li > a').each(function () {  
	     var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1);
            if (linkPage == "profile") { 
            	accordion_body.slideUp('normal');
				$(this).next().stop(true,true).slideToggle('normal');
				accordion_head.removeClass('active');
				$(this).addClass('active');
            }          
        });	
})
</script>
	<script>
$(function () {
    var url = window.location.pathname; 
    var accordion_head = $('.accordion > li > a'),
	accordion_body = $('.accordion li > .sub-menu');
	    $('.accordion > li > ul > li > a').each(function () {  
	     var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1);
            if (linkPage=="profile") { 
            	$(this).css("background-color","white");
            } 
        });
})
</script>