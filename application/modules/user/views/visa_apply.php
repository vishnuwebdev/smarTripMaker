<?php $this->load->view("include/head"); ?>
<?php $this->load->view("include/header");

 ?>


<style>
  @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
@import url('https://fonts.googleapis.com/css?family=Raleway');

.wrapper{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}


.box {
  display: block;
  min-width: 300px;
  height: 300px;
  margin: 10px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  overflow: hidden;
}

.upload-options:hover{
  background-color: lighten(cadetblue, 10%);
}

.upload-options input{
  width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.upload-options label {
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    font-weight: 400;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    overflow: hidden;
  }

.upload-options label::after {
      content: 'Passport Front'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }

.upload-options label::after {
      content: 'Passport Front'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }
.upload-options {
  position: relative;
  height: 75px;
  background-color: cadetblue;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
  }



  .upload-options:hover{
  background-color: lighten(cadetblue, 10%);
}

.upload-options input{
  width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.upload-options label {
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    font-weight: 400;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    overflow: hidden;
  }

.upload-options label::after {
      content: 'Passport Front'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }

.upload-options label::after {
      content: 'Passport Front'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }
.upload-options {
  position: relative;
  height: 75px;
  background-color: cadetblue;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
  }



  // ------------


  .upload-options1:hover{
  background-color: lighten(cadetblue, 10%);
}

.upload-options1 input{
  width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.upload-options1 label {
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    font-weight: 400;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    overflow: hidden;
  }

.upload-options1 label::after {
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }

.upload-options1 label::after {
      content: 'Passport Back'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }
.upload-options1 {
  position: relative;
  height: 75px;
  background-color: cadetblue;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
  }



  // 


    .upload-options2:hover{
  background-color: lighten(cadetblue, 10%);
}

.upload-options2 input{
  width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.upload-options2 label {
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    font-weight: 400;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    overflow: hidden;
  }

.upload-options2 label::after {
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }

.upload-options2 label::after {
      content: 'Photograph'; 
      position: absolute;
      font-size: 12px;
      color: rgba(230, 230, 230, 1);
      top: calc(80% - 2.5rem);
      left: calc(10% - 1.25rem);
      z-index: 0;
    }
.upload-options2 {
  position: relative;
  height: 75px;
  background-color: cadetblue;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
  }



.js--image-preview::after{
  content: "photo_size_select_actual"; 
    font-family: 'Material Icons';
    position: relative;
    font-size: 4.5em;
    color: rgba(230, 230, 230, 1);
    top: calc(50% - 3rem);
    left: calc(50% - 2.25rem);
    z-index: 0;
}
.js--no-default::after {
    display: none;
  }


.js--no-default:nth-child(2) {
    background-image: url('http://bastianandre.at/giphy.gif');
  }

.js--image-preview {
  height: 225px;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-image: url('');
  background-color: white;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
}

i.material-icons {
  transition: color 100ms ease-in-out;
  font-size: 2.25em;
  line-height: 55px;
  color: white;
  display: block;
}

.drop {
  display: block;
  position: absolute;
  background: transparentize(cadetblue, .8);
  border-radius: 100%;
  transform:scale(0);
}

.animate {
  animation: ripple 0.4s linear;
}

@keyframes ripple {
    100% {opacity: 0; transform: scale(2.5);}
}
</style>

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
                    <h1 class="mb-0"><i class="icofont-visa"></i> Apply Visa</h1>
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
                                <li class="list-inline-item mr-0 breadcrumb-item">Apply Visa</li>
                            </ul>
                          </div>
                </div>
              </div>
            </div>
            <div class="paul-card-content">
              <div class="paul-layout">
                
                          <h4 class="htl-title">Upload Documents</h4>
                          <ul>
                            <li>Upload colored passport copies.</li>
                              <li>Passport should be valid 6 months from the date of entry in UAE.</li>
                              <li>Upload photograph with white background</li>
                          </ul>
            <form name="frmTransaction" method="POST" action="<?php echo site_url('user/deposite_payment_request');?>" id="frmTransaction" onsubmit="return validate_payu()">
             <div class="row">               
                            
                              
                            
                            
                                                   
                           
                            
<div class="wrapper">
  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" accept="image/*" />
      </label>
    </div>
  </div>

  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options1">
      <label>
        <input type="file" class="image-upload" accept="image/*" />
      </label>
    </div>
  </div>

  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options2">
      <label>
        <input type="file" class="image-upload" accept="image/*" />
      </label>
    </div>
  </div>
</div>

<div class="col-lg-12">
   <br />
   <h4 class="htl-title">Fill Form</h4>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">First Name</label>
                                  <input type="text" name="firstname" id="deposit-amount" class="form-control" placeholder="First Name" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Last Name</label>
                                  <input type="text" name="lastname" id="deposit-amount" class="form-control" placeholder="Last Name" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Marital Status</label>
                                  <select name="marital_status" class="form-control">
                                    <option>Select Marital Status</option>
                                    <option value="Child">Child</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Deceased">Deceased</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Unspecific">Unspecific</option>
                                  </select>
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Gender</label>
                                  <select name="gender" class="form-control">
                                    <option>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Nationality</label>
                                  <select class="form-control" name="nationality">
                                    <option>Select Nationality</option>
                                    <?php 

                                    for($i=0; $i<count($nationality); $i++) { ?>
                                    <option value="<?php echo $nationality[$i]->nationality ?>"><?php echo $nationality[$i]->nationality ?></option>
                                  <?php } ?>
                                  </select>
                                 
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Religion</label>
                                  <select class="form-control" name="religion">
<option>Select Religion</option>
<option value="Hindu">Hindu</option>
<option value="Christian ">Christian</option> 
<option value="Muslim">Muslim</option>
<option value="Sikh">Sikh</option>
<option value="Zoroastrian">Zoroastrian</option>
<option value="Buddhist">Buddhist</option>
<option value="Jewish">Jewish</option>
<option value="Others">Others</option>
                                  </select>
                                </div>
</div>


<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Date of Birth</label>
                                  <input type="date" name="dob" id="deposit-amount" class="form-control" placeholder="Name" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Country of Birth</label>
                                  
                                  <select class="form-control" name="birth_country">
                                    <option>Select Country of Birth</option>
                                    <?php 

                                    for($i=0; $i<count($nationality); $i++) { ?>
                                    <option value="<?php echo $nationality[$i]->en_short_name ?>"><?php echo $nationality[$i]->en_short_name; ?></option>
                                  <?php } ?>
                                  </select>



                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Place of Birth</label>
                                  <input type="text" name="birth_place" id="deposit-amount" class="form-control" placeholder="Place of Birth" value="" required="required">
                                </div>
</div>


<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Mother's Name</label>
                                  <input type="text" name="mothername" id="deposit-amount" class="form-control" placeholder="Mother's Name" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Father's Name</label>
                                  <input type="text" name="fathername" id="deposit-amount" class="form-control" placeholder="Father's Name" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Profession</label>
                                  <select name="profession" class="form-control">
 <option>Select Profession</option>                                   
<option value="Retired">Retired</option>
<option value="Student">Student</option>
<option value="Business">Business</option>
<option value="Employee">Employee</option>
<option value="Housewife">Housewife</option>
<option value="None">None</option>


                                  </select>
                                </div>
</div>







<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Passport Number</label>
                                  <input type="text" name="passport_number" id="deposit-amount" class="form-control" placeholder="Passport Number" value="" required="required">
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Do you booked your flight tickets?</label>
                                  <select name="flight_ticker_booked" class="form-control">
 <option>Booked Fight Tickets?</option>                                   
<option value="Yes">Yes</option>
<option value="No">No</option>
                                  </select>
                                </div>
</div>
<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Departure Date</label>
                                  <input type="date" name="departure_date" id="deposit-amount" class="form-control" placeholder="Departure Date" value="" required="required">
                                </div>
</div>

<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Arrival Date</label>
                                  <input type="date" name="arrival_date" id="deposit-amount" class="form-control" placeholder="Arrival Date" value="" required="required">
                                </div>
</div>



<div class="col-md-4">
  <div class="form-group">
                                  <label for="deposit-amount">Visa Type</label>
                                  <select class="form-control" name="visa_type">
                                    <option>Select Visa Type</option>
<option value="30 Days Stay Single Entry">30 Days Stay Single Entry</option>
<option value="30 Days Stay Multiple Entry">30 Days Stay Multiple Entry</option>
<option value="90 Days Stay Single Entry">90 Days Stay Single Entry</option>
<option value="90 Days Stay Multiple Entry">90 Days Stay Multiple Entry</option>
                                  </select>
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





function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }
  
  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file){
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }
  
}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}



/// drop-effect
function initDropEffect(box){
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
  
  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);
  
  function fireRipple(e){
    area = e.currentTarget
    // create drop
    if(!drop){
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';
    
    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';
    
    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");
    
    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
    
    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
    
  }
}

</script>