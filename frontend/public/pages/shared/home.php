<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/home.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Home page</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen home-container">
    <div class="overflow-y-auto overflow-x-hidden basis-full">
      <section id="title" class="title-container">
        <div class="title-text">
          <h1 class="bold">Judging System</h1>
          <p class="text-justify pt-3">
            Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum
            Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum
          </p>
          <button type="button" class="btn btn-primary mt-5 animate-right-3">Get Started</button>
        </div>
      </section>
      <section id="missions">
        <div class="row text-center position-relative mission-container">
          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-person-chalkboard"></span>
            </div>
            <h3 class="box-title pt-2">Organizers</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipis ac magna aliqu fugiat null</p>
          </div>

          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-people-group"></span>
            </div>
            <h3 class="box-title pt-2">Participants</h3>
            <p>A world where all pets can remain happy, healthy, and receive the best quality of products in their entire life.</p>
          </div>

          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-person-military-pointing"></span>
            </div>
            <h3 class="box-title pt-2">Judges</h3>
            <p>All products are safe for furry kids.</p>
          </div>
        </div>
      </section>
      <section id="about-us" class="about-container">
        <div class="about-text text-center">
          <h2 class="bold">Want to know more about us?</h2>
          <a href="../shared/about-us.php" class="btn btn-primary mt-5 animate-up-3">About Us</a>
          <a href="../shared/t&c.php" class="ml-3 btn btn-primary mt-5 animate-up-3">Terms & Conditions</a>
        </div>
      </section>
      <section id="faq" class="faq-container">
        <div class="faq-text text-center">
          <h2 class="bold mb-5">Frequently Asked Questions</h2>
          <div class="accordion shadow-soft rounded" id="accordionExample1">
            <div class="card card-sm card-body bg-primary border-light">
              <a href="#panel-1" data-target="#panel-1" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">Our Company</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-1">
                <div class="pt-3">
                  <p class="mb-0">
                    At Themesberg, our mission has always been focused on bringing openness and transparency to the design process. We've always believed that by providing a space where designers can share ongoing work not only empowers them to make better products, it also
                    helps them grow. We're proud to be a part of creating a more open culture and to continue building a product that supports this vision.
                  </p>
                </div>
              </div>
            </div>
            <div class="card card-sm card-body bg-primary border-light mb-0">
              <a href="#panel-2" data-target="#panel-2" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">Neumorph Components</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-2">
                <div class="pt-3">
                  <p class="mb-0">
                    At Themesberg, our mission has always been focused on bringing openness and transparency to the design process. We've always believed that by providing a space where designers can share ongoing work not only empowers them to make better products, it also
                    helps them grow. We're proud to be a part of creating a more open culture and to continue building a product that supports this vision. </p>
                </div>
              </div>
            </div>
            <div class="card card-sm card-body bg-primary border-light">
              <a href="#panel-3" data-target="#panel-3" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">Licenses</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-3">
                <div class="pt-3">
                  <p class="mb-0">
                    At Themesberg, our mission has always been focused on bringing openness and transparency to the design process. We've always believed that by providing a space where designers can share ongoing work not only empowers them to make better products, it also
                    helps them grow. We're proud to be a part of creating a more open culture and to continue building a product that supports this vision. </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="contact" class="contact-container">
        <div class="contact-text text-center">
          <h2 class="bold">Reach Out To Us</h2>
          <a href="../shared/contact-us.php" class="btn btn-primary mt-5 animate-up-3">Contact Us</a>
        </div>
      </section>
    </div>
  </div>
</body>
</html>