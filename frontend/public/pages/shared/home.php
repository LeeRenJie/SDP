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
            Judgeable is a one-stop web application that allows organisers to organize competitions, participants to join the competitions, and judges to judge the competitions.
          </p>
          <a href="../shared/view-event.php" class="btn btn-primary mt-5 animate-right-3">View Active Events</a>
        </div>
        <div class="title-img-container">
          <img src="../../images/title-img.png" alt="title image" class="title-img">
          <img src="../../images/title-ppl.png" alt="title people image" class="title-ppl bounce">
          <img src="../../images/title-chart.png" alt="title chart image" class="title-chart bounce">
          <svg class="blob" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#EAEEF8" d="M48.8,-57.9C65.2,-44.4,81.7,-30.9,85.5,-14.3C89.3,2.2,80.4,21.7,68.9,38.1C57.5,54.5,43.5,67.8,27.6,71.8C11.7,75.9,-6.1,70.7,-22,63.6C-38,56.5,-52.1,47.4,-59.4,34.4C-66.7,21.5,-67.1,4.8,-65.6,-12.9C-64.1,-30.7,-60.7,-49.4,-49.4,-63.9C-38.1,-78.3,-19.1,-88.4,-1.4,-86.7C16.2,-85,32.4,-71.5,48.8,-57.9Z" transform="translate(100 100)" />
          </svg>
        </div>
      </section>
      <section id="missions">
        <div class="row text-center position-relative mission-container">
          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-person-chalkboard"></span>
            </div>
            <h3 class="box-title pt-2 mb-3">Organizers</h3>
            <p>Create competitions, invite judges, and manage the competition.</p>
          </div>
          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-people-group"></span>
            </div>
            <h3 class="box-title pt-2 mb-3">Participants</h3>
            <p>Join competitions as a group or individually.</p>
          </div>

          <div class="col-lg-4">
            <div class="icon icon-shape shadow-soft border border-light rounded-circle">
              <span class="fa-solid fa-person-military-pointing"></span>
            </div>
            <h3 class="box-title pt-2 mb-3">Judges</h3>
            <p>
              Judge the competitions, give score and comment for participants.
            </p>
          </div>
        </div>
      </section>
      <section id="about-us" class="about-container">
        <div class="about-text text-center">
          <h2 class="bold">Want to know more about us?</h2>
          <a href="../shared/about-us.php" class="btn btn-primary mt-5 animate-up-3">About Us</a>
          <a href="../shared/t&c.php" class="ml-3 btn btn-primary mt-5 animate-up-3">Terms & Conditions</a>
        </div>
        <div class="about-img-container">
          <img src="../../images/about-us.png" alt="about us image" class="about-img">
          <img src="../../images/about-ppl.png" alt="people image" class="about-ppl bounce">
        </div>
      </section>
      <section id="contact" class="contact-container">
        <div class="contact-text text-center">
          <h2 class="bold">Reach Out To Us</h2>
          <a href="../shared/contact-us.php" class="btn btn-primary mt-5 animate-up-3">Contact Us</a>
        </div>
        <div class="contact-img-container">
          <img src="../../images/contact-us.png" alt="contact us image" class="contact-img">
          <img src="../../images/contact-ppl.png" alt="people image" class="contact-ppl bounce">
        </div>
      </section>
      <section id="faq" class="faq-container mt-5">
        <div class="faq-text">
          <h2 class="bold mb-5">Frequently Asked Questions</h2>
          <div class="accordion shadow-soft rounded" id="accordionExample1">
            <div class="card card-sm card-body bg-primary border-light mb-0">
              <a href="#panel-1" data-target="#panel-1" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">How to create events as an organizer?</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-1">
                <div class="pt-3">
                  <p class="mb-0">
                    Click on my-events from the sidebar and click on create new event.
                    Enter the relevant details in all the inputs provided and click on create.
                  </p>
                </div>
              </div>
            </div>
            <div class="card card-sm card-body bg-primary border-light mb-0">
              <a href="#panel-2" data-target="#panel-2" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">How to join events as a participant?</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-2">
                <div class="pt-3">
                  <p class="mb-0">
                    Click on view-events from the sidebar and click on any events.
                    Click on participate at the event details page.
                    Choose if you are a team leader or team member to register for the event.
                  </p>
                </div>
              </div>
            </div>
            <div class="card card-sm card-body bg-primary border-light">
              <a href="#panel-3" data-target="#panel-3" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                <span class="h6 mb-0 font-weight-bold">How to judge event as a judge?</span>
                <span class="icon"><span class="fas fa-plus"></span></span>
              </a>
              <div class="collapse" id="panel-3">
                <div class="pt-3">
                  <p class="mb-0">
                    Click on judge at the navbar.
                    Enter the unique code provided by the organizer to join the event as a judge.
                    Head over to the judgemnet page to start judging in the competiton.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>