<?php
    //start the session
    session_start();
    //Connection to Database
    include("../../../../backend/conn.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Unique code get from post form
        $uniquecode=mysqli_real_escape_string($con, $_POST['uniquecode']);
        //Check if the unique code is exist
        $sql="SELECT * FROM judge WHERE unique_code='$uniquecode'";
        $result=mysqli_query($con,$sql);
        $rownum=mysqli_num_rows($result);
        
        //If the unique code existed
        if($rownum==1){
            //Store the judge data into session
            while($row=mysqli_fetch_array($result)){
                $judgeid = $row['judge_id'];
                $judgename = $row['judge_name'];
            }
            $_SESSION['judge_id']=$judgeid;
            $_SESSION['username']=$judgename;
            $_SESSION['privilege']="judge";
            
            //Query to get the event data
            $sql="SELECT * FROM event AS ev INNER JOIN judges_list AS jl ON ev.judges_list_id = jl.judges_list_id
            INNER JOIN judge AS jg ON jl.judge_id = jg.judge_id WHERE jg.judge_id = '$_SESSION[judge_id]'";
            //Execute the query
            $result=mysqli_query($con,$sql);
            //Fetch data
            $event=mysqli_fetch_array($result);
            //If the event is still active
            if ($event['active']==1){
                //Show the welcome message
                echo "<script>alert('Welcome, $judgename')</script>";
                //Redirected to event(judge) page
                echo "<script>window.location = 'event(judge).php'</script>";
            }
            else{
                //Show the alert message to indicate judge that the event is ended
                echo "<script>alert('Sorry, the event is already ended.');</script>";
                session_unset();
            }
        }

        //If the unique code does not exist
        else  {
            //Show the error message
            echo "<script>alert('Your unique code is invalid. Please try again');</script>";
        }
        //Close connection of database
        mysqli_close($con);        
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link href="../../../src/stylesheets/judge-enter-event.css" rel="stylesheet">
      <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
      <title>Enter Event</title>
    </head>
    <body>
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
                                            <input type="text" class="form-control" placeholder="Please enter the event's unique code" name="uniquecode">
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