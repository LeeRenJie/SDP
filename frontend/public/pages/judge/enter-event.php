<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--BootStrap/css stylesheets-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link href="../../../src/stylesheets/enter-event.css" rel="stylesheet">
      <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
      <title>Enter Event</title>
    </head>
    <body>
        <!-- Nav Bar -->
        <?php include '../shared/navbar.php';?>
        <div class="container-fluid text-black text-center fs-1">
            <h1>Welcome to JUDGEABLE!</h1>
            <div class="row mt-2 justify-content-center align-items-center">
                <div class="col-8" >
                    <div class="text-white text-center fs-5 py-1 mb-2" id="cont0">Judge</div>
                </div>
                <div class="col-8">
                    <div class="card bg-primary border-light shadow-soft" id="cont1">
                        <h1 class="text-center pt-5">Enter An Event</h1>
                        <h4 class="text-start mx-5 my-5">Unique Code: </h4>
                        <form method="post">
                            <div class="form-group">
                                <div class="row px-5 justify-content-center">
                                    <div class="col-11">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Please enter the event's unique code" name="uniquecode" autofocus="none">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark enter-btn">Enter</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>