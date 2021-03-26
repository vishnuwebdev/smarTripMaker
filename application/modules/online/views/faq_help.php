<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

<section class="inner-header pt-2 pb-2 pt-md-4 pb-md-4">
  <div class="container">
    <div class="section-heading--title position-relative">
      <h1 class="text-center title-show-title">FAQ &amp; HELP</h1>
      <h1 class="text-center title-back-title">FAQ &amp; HELP</h1>
    </div>
  </div>
</section>


<main class="main-contant-wrap pt-md-3 pb-md-3">
  <div class="container">
    <div class="innerpage-com p-2 pt-md-3 pb-md-3 accordion-wrap-col">
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#travel-infant" aria-expanded="true" aria-controls="collapseOne">
                1. I am travelling with infant_ Is there anything special I need to carry?
              </button>
            </h5>
          </div>

          <div id="travel-infant" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <p><strong>Ans:</strong> Babies b/w the age of 0 to 2 years are considered t be Infant 2 to 12 years are considered to be a child.</p>
              <p>Infants are not allocated to separate seats. For an infant Ticket, it is mandatory to carry Birth Certificate of the infant along with the Ticket.</p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#age-limit" aria-expanded="false" aria-controls="collapseTwo">
                2. What is the age limit of Infant, Child, Adult and Senior Citizen.?
              </button>
            </h5>
          </div>
          <div id="age-limit" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <p><strong>Ans:</strong> Age Range of Infant : 0-2 years</p>
              <ul class="list-unstyled">
                <li>Age Range of Child : 2-12 years</li>
                <li>Age Range of Adult :  12-60</li>
                <li>Age Range of Senior Citizen : Above 60 years</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#pass-pnr" aria-expanded="false" aria-controls="collapseThree">
                3. How many Passengers can be booked in one PNR.?
              </button>
            </h5>
          </div>
          <div id="pass-pnr" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong>Ans:</strong> Maximum Nine Passengers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php $this->load->view('include/footer'); ?>