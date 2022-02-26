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
        <div class="maincontainer">
            <div class="card bg-primary border-light shadow-soft p-4" >
                <div class="row">
                    <!-- Event Description -->
                    <div class="col-8">
                        <h2>Event Name</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate, enim quis facilisis tincidunt, felis 
                            leo sagittis velit, et iaculis libero ex id magna. Vestibulum eget risus ex. Nunc at venenatis risus. Duis hendrerit 
                            ullamcorper diam. Integer condimentum vehicula euismod. </p>
                    </div>
                    <!-- Event Picture -->
                    <div class="col-4">
                        <image src="../../images/jazz_music.png">
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mt-5">
                <!-- Event Rules -->
                <div class="col-6">
                    <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                        <h3>Event Rules</h3>
                    </div>
                </div>
                <!-- Participant List -->
                <div class="col-5">
                    <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                        <h3>Participant List</h3>
                    </div>
                </div>
            </div>
        </div>               
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>