<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a96430977f.js" crossorigin="anonymous"></script>
        <link href="../../../src/stylesheets/event(judge).css" rel="stylesheet"> 
        <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
        <title>Judge Event Page</title>    
    </head>
    <body>
        <!-- Include Navigation Bar -->
        <?php include '../shared/navbar.php';?>
        <div class="container-fluid">
            <!-- Side Bar -->
            <div class="row">
                <div class="col-2 ps-2">
                    <div class="card bg-primary border-light shadow-soft p-2">
                        <ul class="nav nav-pills square nav-fill flex-column vertical-tab">
                            <!-- Event -->
                            <li class="nav-item mb-2">
                                <a class="nav-link active" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-calendar mr-2"></span>Event</span></a>
                            </li>
                            <!-- Judgement -->
                            <li class="nav-item mb-2">
                                <a class="nav-link" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-clipboard mr-2"></span>Judgement</span></a>
                            </li>
                            <!-- Overall Result -->
                            <li class="nav-item mb-">
                                <a class="nav-link" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-square-poll-vertical mr-2"></span>Overall Result</span></a>
                            </li>    
                        </ul>
                        <ul class="nav nav-pills square nav-fill flex-column vertical-tab position-absolute bottom-0 col-12">
                            <!-- About Us -->
                            <li class="nav-item mb-2">
                                <a class="nav-link" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-users mr-2"></span>About Us</span></a>
                            </li>
                            <!-- T&C -->
                            <li class="nav-item mb-2">
                                <a class="nav-link" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-clipboard-check mr-2"></span>T&C</span></a>
                            </li>
                            <!-- Contact Us -->
                            <li class="nav-item mb-">
                                <a class="nav-link" data-toggle="tab" href="#"><span class="d-block"><span class="fa-solid fa-square-phone mr-2"></span>Contact Us</span></a>
                            </li>    
                        </ul>                        
                    </div> 
                </div>
                <div class="col-10">
                    <div class="container-fluid px-5">
                        <div class="row">
                            <!-- Event Description -->
                            <div class="col-8">
                                <h2><u>Event Name</u></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate, enim quis facilisis tincidunt, felis 
                                    leo sagittis velit, et iaculis libero ex id magna. Vestibulum eget risus ex. Nunc at venenatis risus. Duis hendrerit 
                                    ullamcorper diam. Integer condimentum vehicula euismod. </p>
                            </div>
                            <!-- Event Picture -->
                            <div class="col-4">
                                <image src="../../images/jazz_music.png">
                            </div>
                        </div>
                        <div class="row justify-content-between mt-5">
                            <!-- Event Rules -->
                            <div class="col-6">
                                <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                                    <h3><u>Event Rules</u></h3>
                                </div>
                            </div>
                            <!-- Participant List -->
                            <div class="col-5">
                                <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                                    <h3><u>Participant List</u></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>