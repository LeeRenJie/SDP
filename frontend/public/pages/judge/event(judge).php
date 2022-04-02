<?php
    //Start the session
    session_start();
    //Connection to Database
    include("../../../../backend/conn.php");

    //Query to get the event data
    $sql="SELECT * FROM event AS ev INNER JOIN judges_list AS jl ON ev.judges_list_id = jl.judges_list_id
    INNER JOIN judge AS jg ON jl.judge_id = jg.judge_id WHERE jg.judge_id = '$_SESSION[judge_id]'";
    //Execute the query
    $result=mysqli_query($con,$sql);
    //Fetch data
    $event=mysqli_fetch_array($result);
    $eventid = $event['event_id'];
    $eventname = $event['event_name'];
    $starttime = $event['start_time'];
    $endtime = $event['end_time'];
    $eventdescription = $event['event_description'];
    $eventdate = $event['event_date'];
    $eventpicture=$event['event_picture'];
    //Store event id to session
    $_SESSION["event_id"] = $eventid;

    //Query to get the prizes data
    $sql2="SELECT * FROM event AS ev INNER JOIN prizes_list AS pl ON ev.prizes_list_id = pl.prizes_list_id
    INNER JOIN prize AS pr ON pl.prize_id = pr.prize_id
    WHERE ev.event_id = $eventid ORDER BY pr.prize_id";
    //Execute the query
    $result2=mysqli_query($con,$sql2);

    //Query to get the rules data
    $sql3="SELECT * FROM event AS ev INNER JOIN rules_list AS rl ON ev.rules_list_id = rl.rules_list_id
    INNER JOIN rule AS ru ON rl.rule_id = ru.rule_id
    WHERE ev.event_id = $eventid";
    //Execute the query
    $result3=mysqli_query($con,$sql3);

    //Query to get the teams data
    $sql4="SELECT * FROM team_list WHERE event_id = $eventid";
    //Execute the query
    $result4=mysqli_query($con,$sql4);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a96430977f.js" crossorigin="anonymous"></script>
        <link href="../../../src/stylesheets/judge-view-event.css" rel="stylesheet"> 
        <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
        <title>Judge Event Page</title>    
    </head>
    <body>
        <?php include '../shared/navbar.php';?>
        <div class="flex flex-row h-screen" style="padding-bottom: 65px;">
            <?php include '../shared/sidebar.php';?>
            <div class="basis-10/12 overflow-auto shadow">
                <div class="maincontainer">
                    <div class="card bg-primary border-light shadow-soft p-4" >
                        <div class="row">
                            <!-- Event Description -->
                            <div class="col-8">
                                <h2><?php echo $eventname; ?></h2>
                                <p><?php echo $eventdescription; ?></p>
                                <div class="row">
                                    <!-- Event Time -->
                                    <div class="col-6">    
                                        <button class="normal_button mt-3" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapseExample">
                                            Event Time
                                        </button>
                                    </div>
                                    <!-- Event Prizes -->
                                    <div class="col-6">
                                        <button class="normal_button mt-3" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Prizes
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="collapse mt-3" id="collapse1">
                                            <div class="card2 bg-primary p-4">
                                                <div class="row">
                                                    <!-- Event Date -->
                                                    <div class="col-6">
                                                        <div class="mx-3">
                                                            <span class="fs-6">
                                                                <i class="fa-solid fa-calendar-day"></i>
                                                                Date
                                                            </span>
                                                            <p class="pt-3"><?php echo $eventdate; ?></p>
                                                        </div>
                                                    </div>
                                                    <!-- Event Time -->
                                                    <div class="col-6">
                                                        <div class="mx-3">
                                                            <span class="fs-6">
                                                                <i class="fa-solid fa-clock"></i>
                                                                Time
                                                            </span>
                                                            <p class="pt-3"><?php echo $starttime; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="collapse mt-3" id="collapse2">
                                            <div class="card2 bg-primary p-4">
                                                <div class="text-center">
                                                    <span class="fs-6">
                                                        <i class="fa-solid fa-trophy"></i>
                                                        Prizes
                                                    </span>
                                                    <div class="text-center">
                                                        <div class="pt-3">
                                                            <?php
                                                            //Create array
                                                            $p1=Array(); 
                                                            //Fetch data
                                                            while($prize=mysqli_fetch_array($result2)){
                                                                //Store data into array
                                                                $pl[] = $prize['prize'];
                                                            }
                                                            //Display array data
                                                            echo "<p>1st prize: RM $pl[0]</p>
                                                                  <p>2nd prize: RM $pl[1]</p>
                                                                  <p>3rd prize: RM $pl[2]</p>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Event Picture -->
                            <div class="col-4">
                                <?php echo '<image src="data:image;base64, '.base64_encode($eventpicture).'">'?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between mt-5">
                        <!-- Event Rules -->
                        <div class="col-6">
                            <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                                <span class="h3">
                                    <i class="fa-solid fa-scroll"></i>
                                    Event Rules
                                </span>
                                <?php
                                    //Fetch and display data
                                    $nor=0;
                                    while($rule=mysqli_fetch_array($result3)){
                                        $nor=$nor+1;
                                        echo "<p class='fs-5 mt-2'> $nor. $rule[rule]</p>";  
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- Participant List -->
                        <div class="col-5">
                            <div class="card bg-primary border-light shadow-soft text-center p-4" id="card1">
                                <span class="h3">
                                    <i class="fa-solid fa-user-group"></i>
                                    Participant List
                                </span>
                                <?php
                                    //Fetch and display data
                                    $nop=0; 
                                    while($participant=mysqli_fetch_array($result4)){
                                        $nop=$nop+1;
                                        echo "<p class='fs-5 mt-2'> $nop. $participant[team_name]</p>";  
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>