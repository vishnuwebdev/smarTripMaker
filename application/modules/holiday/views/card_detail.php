
<?php // $this->load->view('holidaylayout/head'); ?>
<?php $this->load->view('holidaylayout/header'); ?>
<style>
    .clshide
    {
        display:none;
    }
</style>

<div class="container-fluid tourextradetailsfluid pt50 pb50 light-bg">
   
	<div class="container tourextradetailscontainer">
            
                
                 

  <!--  <h1 class="block fz24 black-color mb15 fwb">Booking Details</h1>
    <div class="row tourextradetailsrow"> -->
   
        
      <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">Card Details</div>
            <div class="panel-body">
                <div id="err_msg" class="alert alert-danger clshide">
			<strong id="er_msg" ></strong>
		</div>
              <div class="modal-body">
             
                <form id="card_from" method="post" action="<?php echo site_url(); ?>holiday/card_details">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix mt15">
                                <label for="">First Name</label>
                                <input name="crecard_first_name" type="text" class="input block width-100 border" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clearfix mt15">
                              <label for="">Last Name</label>
                              <input name="crecard_last_name" type="text" class="input block width-100 border" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clearfix mt15">
                              <label for="">Card Name</label>
                              <input name="crecard_card_name" type="text" class="input block width-100 border" placeholder="Enter your card name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clearfix mt15">
                             <label for="">Card Type</label>
                              <select id="crecard_card_type" name="crecard_card_type" class="select block width-100 border" required>
                                  <option value="visa">visa</option>
                                  <option value="mastercard">mastercard</option>
                                  <option value="American Express">American Express</option>
                                  <option value="Discover">Discover</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="clearfix mt15">
                              <label for="">Card Number</label>
                              <input id="crecard_card_number" name="crecard_card_number" type="text" class="input block width-100 border" placeholder="Enter your Card Number" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="clearfix mt15">
                              <label for="">Card Expiration Month</label>
                              <select name="crecard_expiry_month" class="select block width-100 border" required>
                                  <option value="01">Jan (01)</option>
                                  <option value="02">Feb (02)</option>
                                  <option value="03">Mar (03)</option>
                                  <option value="04">Apr (04)</option>
                                  <option value="05">May (05)</option>
                                  <option value="06">June (06)</option>
                                  <option value="07">July (07)</option>
                                  <option value="08">Aug (08)</option>
                                  <option value="09">Sep (09)</option>
                                  <option value="10">Oct (10)</option>
                                  <option value="11">Nov (11)</option>
                                  <option value="12">Dec (12)</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="clearfix mt15">
                              <label for="">Card Expiration Year</label>
                              <select name="crecard_expiry_year" class="select block width-100 border" required>
                                  <option value="01">2018</option>
                                  <option value="02">2019</option>
                                  <option value="03">2020</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="clearfix mt15">
                              <label for="">Card CVV (3 Digit code)</label>
                              <input name="crecard_cvv" type="text" class="input block width-100 border" placeholder="Enter your Card CVV" maxlength="3" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="clearfix mt15 tac">
                                <button id="sbmt" type="button" onclick="testCreditCard()" class="btn btn-success">Continue</button>
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <div class="clearfix">
                              <h3 class="fz14 fwb main-color mt0">Conditions & Cancellation Policy</h3>
                              <ul class="fz12">
                                  <li class="mt10">When paying by credit card, your card is charged the total amount as soon as we receive confirmation of your booking.</li>
                                  <li class="mt10">If confirmation isn't received instantly, an authorization is held against your card until it arrives.</li>
                                  <li class="mt10">If you change or cancel your booking request, charges may apply.</li>
                              </ul>
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





<Script>
    
function testCreditCard () {
  myCardNo = document.getElementById('crecard_card_number').value;
  myCardType = document.getElementById('crecard_card_type').value;
  if (checkCreditCard (myCardNo,myCardType)) {
     document.getElementById('err_msg').style.display = "none";
    // document.getElementById("card_from").submit();
      document.getElementById('sbmt').type = 'submit';
   
  } 
  else {
      document.getElementById('err_msg').style.display = "block";
      document.getElementById("er_msg").innerHTML = ccErrors[ccErrorNo];
      
   //   alert (ccErrors[ccErrorNo])
     };
}
    
    
var ccErrorNo = 0;
var ccErrors = new Array ()

ccErrors [0] = "Unknown card type";
ccErrors [1] = "No card number provided";
ccErrors [2] = "Credit card number is in invalid format";
ccErrors [3] = "Credit card number is invalid";
ccErrors [4] = "Credit card number has an inappropriate number of digits";
ccErrors [5] = "Warning! This credit card number is associated with a scam attempt";

function checkCreditCard (cardnumber, cardname) {
     
  // Array to hold the permitted card characteristics
  var cards = new Array();

  // Define the cards we support. You may add addtional card types as follows.
  
  //  Name:         As in the selection box of the form - must be same as user's
  //  Length:       List of possible valid lengths of the card number for the card
  //  prefixes:     List of possible prefixes for the card
  //  checkdigit:   Boolean to say whether there is a check digit
  
  cards [0] = {name: "Visa", 
               length: "13,16", 
               prefixes: "4",
               checkdigit: true};
  cards [1] = {name: "MasterCard", 
               length: "16", 
               prefixes: "51,52,53,54,55",
               checkdigit: true};
  cards [2] = {name: "DinersClub", 
               length: "14,16", 
               prefixes: "36,38,54,55",
               checkdigit: true};
  cards [3] = {name: "CarteBlanche", 
               length: "14", 
               prefixes: "300,301,302,303,304,305",
               checkdigit: true};
  cards [4] = {name: "AmEx", 
               length: "15", 
               prefixes: "34,37",
               checkdigit: true};
  cards [5] = {name: "Discover", 
               length: "16", 
               prefixes: "6011,622,64,65",
               checkdigit: true};
  cards [6] = {name: "JCB", 
               length: "16", 
               prefixes: "35",
               checkdigit: true};
  cards [7] = {name: "enRoute", 
               length: "15", 
               prefixes: "2014,2149",
               checkdigit: true};
  cards [8] = {name: "Solo", 
               length: "16,18,19", 
               prefixes: "6334,6767",
               checkdigit: true};
  cards [9] = {name: "Switch", 
               length: "16,18,19", 
               prefixes: "4903,4905,4911,4936,564182,633110,6333,6759",
               checkdigit: true};
  cards [10] = {name: "Maestro", 
               length: "12,13,14,15,16,18,19", 
               prefixes: "5018,5020,5038,6304,6759,6761,6762,6763",
               checkdigit: true};
  cards [11] = {name: "VisaElectron", 
               length: "16", 
               prefixes: "4026,417500,4508,4844,4913,4917",
               checkdigit: true};
  cards [12] = {name: "LaserCard", 
               length: "16,17,18,19", 
               prefixes: "6304,6706,6771,6709",
               checkdigit: true};
               
  // Establish card type
  var cardType = -1;
  for (var i=0; i<cards.length; i++) {

    // See if it is this card (ignoring the case of the string)
    if (cardname.toLowerCase () == cards[i].name.toLowerCase()) {
      cardType = i;
      break;
    }
  }
  
  // If card type not found, report an error
  if (cardType == -1) {
     ccErrorNo = 0;
     return false; 
  }
   
  // Ensure that the user has provided a credit card number
  if (cardnumber.length == 0)  {
     ccErrorNo = 1;
     return false; 
  }
    
  // Now remove any spaces from the credit card number
  cardnumber = cardnumber.replace (/\s/g, "");
  
  // Check that the number is numeric
  var cardNo = cardnumber
  var cardexp = /^[0-9]{13,19}$/;
  if (!cardexp.exec(cardNo))  {
     ccErrorNo = 2;
     return false; 
  }
       
  // Now check the modulus 10 check digit - if required
  if (cards[cardType].checkdigit) {
    var checksum = 0;                                  // running checksum total
    var mychar = "";                                   // next char to process
    var j = 1;                                         // takes value of 1 or 2
  
    // Process each digit one by one starting at the right
    var calc;
    for (i = cardNo.length - 1; i >= 0; i--) {
    
      // Extract the next digit and multiply by 1 or 2 on alternative digits.
      calc = Number(cardNo.charAt(i)) * j;
    
      // If the result is in two digits add 1 to the checksum total
      if (calc > 9) {
        checksum = checksum + 1;
        calc = calc - 10;
      }
    
      // Add the units element to the checksum total
      checksum = checksum + calc;
    
      // Switch the value of j
      if (j ==1) {j = 2} else {j = 1};
    } 
  
    // All done - if checksum is divisible by 10, it is a valid modulus 10.
    // If not, report an error.
    if (checksum % 10 != 0)  {
     ccErrorNo = 3;
     return false; 
    }
  }  
  
  // Check it's not a spam number
  if (cardNo == '5490997771092064') { 
    ccErrorNo = 5;
    return false; 
  }

  // The following are the card-specific checks we undertake.
  var LengthValid = false;
  var PrefixValid = false; 
  var undefined; 

  // We use these for holding the valid lengths and prefixes of a card type
  var prefix = new Array ();
  var lengths = new Array ();
    
  // Load an array with the valid prefixes for this card
  prefix = cards[cardType].prefixes.split(",");
      
  // Now see if any of them match what we have in the card number
  for (i=0; i<prefix.length; i++) {
    var exp = new RegExp ("^" + prefix[i]);
    if (exp.test (cardNo)) PrefixValid = true;
  }
      
  // If it isn't a valid prefix there's no point at looking at the length
  if (!PrefixValid) {
     ccErrorNo = 3;
     return false; 
  }
    
  // See if the length is valid for this card
  lengths = cards[cardType].length.split(",");
  for (j=0; j<lengths.length; j++) {
    if (cardNo.length == lengths[j]) LengthValid = true;
  }
  
  // See if all is OK by seeing if the length was valid. We only check the length if all else was 
  // hunky dory.
  if (!LengthValid) {
     ccErrorNo = 4;
     return false; 
  };   
  
  // The credit card is in the required format.
  return true;
}

/*================================================================================================*/

</script>


<?php $this->load->view('holidaylayout/footer'); ?>
<?php // $this->load->view('commenLayout/copyright'); ?>