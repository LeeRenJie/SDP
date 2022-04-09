<?php
    // start the session
    session_start();
    //Connection to Database
    include("../../../../backend/conn.php");
    include("../../../../backend/session(judge).php");

    if ($_SESSION['privilege'] != "judge") {
      echo("<script>alert('You do not have access to this page')</script>");
      echo('<script>window.location.href = "../shared/view-event.php";</script>');
    };

    //Query to get team list of the event
    $teamlistsql="SELECT DISTINCT team_name, team_list_id, unique_code FROM team_list AS tl INNER JOIN event AS ev ON tl.event_id = ev.event_id
                  WHERE ev.event_id = '$_SESSION[event_id]'";
    $teamlistsqlresult=mysqli_query($con,$teamlistsql);
    //Create array for team list
    $teamlist = Array();
    //Save all the team name into the array
    while($teamlistresult=mysqli_fetch_array($teamlistsqlresult)){
        $teamlist[] = $teamlistresult["team_name"];
    }

    //Loop through each team name in the team list
    $noteam = 0;
    while($noteam < count($teamlist)){
        //if edit button is clicked
        if (isset($_POST["".$teamlist[$noteam]."editbtn"])){
            //Query to get the score id based on judge id and team name
            $scoreidsql="SELECT DISTINCT tl.team_name, sc.score, sc.score_id FROM judgement_list AS jl
                        INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
                        INNER JOIN score AS sc ON sl.score_id = sc.score_id
                        INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                        INNER JOIN event AS ev ON tl.event_id = ev.event_id
                        WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamlist[$noteam]."'";
            $scoreidresult=mysqli_query($con,$scoreidsql);
            //Create array for score id
            $scoreidlist = Array();
            //Save all the score id into the array
            while($scoreid=mysqli_fetch_array($scoreidresult)){
                $scoreidlist[] = $scoreid["score_id"];
            }

            //Update the score based on score id in score id array
            $no5 = 1;
            while($no5 <= count($scoreidlist)){
                $updatescore="UPDATE score SET score=".$_POST["".$teamlist[$noteam]."score$no5"]." WHERE score_id = ".$scoreidlist[$no5-1]."";
                mysqli_query($con,$updatescore);
                $no5 = $no5 + 1;
            }

            //Query to get the comment id based on judge id and team name
            $commentidsql="SELECT * FROM judgement_list AS jl INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                          INNER JOIN event AS ev ON tl.event_id = ev.event_id
                          WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamlist[$noteam]."'";
            $commentidsqlresult=mysqli_query($con,$commentidsql);
            $commentid=mysqli_fetch_array($commentidsqlresult);

            //Update the comment based on the comment id
            $updatecomment="UPDATE comment SET comment = '".$_POST["".$teamlist[$noteam]."comment"]."' WHERE comment_id = ".$commentid["comment_id"]."";
            mysqli_query($con,$updatecomment);
        }
        $noteam = $noteam + 1;
    }

    //Query to check if the judgement record of judge existed
    $checkrecordsql="SELECT * FROM judgement_list AS jl INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                    INNER JOIN event AS ev ON tl.event_id = ev.event_id WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND ev.event_id = '$_SESSION[event_id]'";
    $record=mysqli_query($con,$checkrecordsql);
    $rownum=$rownum=mysqli_num_rows($record);

    //If the judgement record of judge not existed
    if($rownum==0){
        //Show the alert message
        echo("<script>alert('The overall result is empty. Please fill up the judgement form.')</script>");
        //Redirected to judgement page
        echo("<script>window.location = 'judgement.php'</script>");
    }

    //Query to get the ranking of the participants
    $rankingsql="SELECT team_name, team_list_id , SUM(score) AS total_score
                FROM (SELECT DISTINCT tl.team_name, tl.team_list_id , sc.score_id, sc.score 
                FROM judgement_list AS jl INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
                INNER JOIN score AS sc ON sl.score_id = sc.score_id
                INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                INNER JOIN event AS ev ON tl.event_id = ev.event_id WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND ev.event_id = '$_SESSION[event_id]') AS new_table
                GROUP BY team_list_id
                ORDER BY total_score DESC";
    $ranking=mysqli_query($con,$rankingsql);
    
    //Create arrays for the team name and total score
    $teamname = Array();
    $totalscore = Array();
    //Save the ranking result and total score into the arrays
    while($rankingresult=mysqli_fetch_array($ranking)){
        $teamname[] = $rankingresult["team_name"];
        $totalscore[] = $rankingresult["total_score"];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a96430977f.js" crossorigin="anonymous"></script>
        <link href="../../../src/stylesheets/judge-overall-result.css" rel="stylesheet">
        <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
        <title>Overall Result</title>
    </head>
    <body>
        <?php include '../shared/navbar.php';?>
        <div class="flex flex-row h-screen" style="padding-bottom: 65px;">
            <?php include '../shared/sidebar.php';?>
            <div class="basis-10/12 overflow-auto bg-shadow" style="border-radius:30px;">
                <div class="maincontainer text-center">
                    <h2 class="mt-5 text-decoration-underline">Overall Result</h2>
                    <div class="card shadow-soft bg-primary border-light px-4 mx-5 my-4 rounded overflow-auto">
                        <table class="table result ">
                            <tr>
                                <th class="border-0" scope="col" id="team">Team</th>
                                <th class="border-0" scope="col" id="score&comment">Score & Comment</th>
                                <th class="border-0" scope="col" id="totalscore">Total Score</th>
                                <th class="border-0" scope="col" id="rank">Rank</th>
                                <th class="border-0" scope="col" id="edit"></th>
                            </tr>
                        <?php
                            //Show the result for each team
                            $no = 1;
                            while ($no <= count($teamname)){
                                echo '<tr class="shadow-inset bg-primary border-light p-4 rounded">
                                    <!-- Show the team name -->
                                    <td class="border-0 align-middle font-weight-bold" scope="row">'.$teamname[$no-1].'</td>
                                    <td class="border-0 p-0 align-middle ">

                                        <table class="table mt-3">
                                            <tr>';
                                                //Query to read all the criteria of the event
                                                $criteriasql="SELECT * FROM criteria AS cr INNER JOIN event AS ev ON cr.event_id = ev.event_id
                                                              WHERE ev.event_id = '$_SESSION[event_id]'";
                                                $criteriaresult=mysqli_query($con,$criteriasql);

                                                //Create array for criteria
                                                $criterialist = Array();
                                                //Save all the criteria into the array
                                                while($criteria=mysqli_fetch_array($criteriaresult)){
                                                    $criterialist[] = $criteria["criteria_name"];
                                                }
                                                //Show all the criteria in criteria array
                                                $no2 = 0;
                                                while($no2 < count($criterialist)){
                                                    echo '<th class="border-0" scope="col">'.$criterialist[$no2].'</th>';
                                                    $no2 = $no2 + 1;
                                                }

                                      echo '</tr>
                                            <tr>';
                                                //Query to read all the score in judgement record
                                                $scoresql="SELECT DISTINCT tl.team_name, sc.score, sc.score_id FROM judgement_list AS jl
                                                          INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
                                                          INNER JOIN score AS sc ON sl.score_id = sc.score_id
                                                          INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                                                          INNER JOIN event AS ev ON tl.event_id = ev.event_id
                                                          WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamname[$no-1]."'";
                                                $scoreresult=mysqli_query($con,$scoresql);

                                                //Create array for score
                                                $scorelist = Array();
                                                //Save all the score into the array
                                                while($score=mysqli_fetch_array($scoreresult)){
                                                    $scorelist[] = $score["score"];
                                                }
                                                //Show all the criteria in criteria array
                                                $no3 = 0;
                                                while($no3 < count($scorelist)){
                                                    echo '<td class="border-0" scope="row">'.$scorelist[$no3].'</td>';
                                                    $no3 = $no3 + 1;
                                                }

                                      echo '</tr>
                                            <tr>
                                                <th class="border-0" scope="row">Comment:</th>';
                                                //Query to read the comment in judgement record
                                                $commentsql="SELECT * FROM judgement_list AS jl INNER JOIN comment AS cm ON jl.comment_id = cm.comment_id
                                                            INNER JOIN team_list as tl ON jl.team_list_id = tl.team_list_id
                                                            WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamname[$no-1]."'";
                                                $commentresult=mysqli_query($con,$commentsql);
                                                $comment=mysqli_fetch_array($commentresult);
                                                //Show the comment
                                                echo '<td class="border-0 text-start" scope="row" colspan="3">'.$comment["comment"].'</th>';
                                      echo '</tr>
                                        </table>

                                    </td>
                                    <!-- Show the total score -->
                                    <td class="border-0 align-middle font-weight-bold" scope="row">'.$totalscore[$no-1].'</td>
                                    <!-- Show the rank -->
                                    <td class="border-0 align-middle font-weight-bold" scope="row">'.$no.'</td>
                                    <td class="border-0 align-middle" scope="row"><button type="button" class="normal_button" data-toggle="modal" data-target="#modal-form-edit'.$no.'"><i class="fa-solid fa-pen-to-square fa-2xl"></i></button></td>

                                    <!-- Modal Content for Edit Score & Comment -->
                                    <div class="modal fade" id="modal-form-edit'.$no.'" tabindex="-1" role="dialog" aria-labelledby="modal-form-signup" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card bg-primary shadow-soft border-light p-4">
                                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <div class="card-header text-center pb-0">
                                                            <h2 class="mb-0 h5 font-weight-bold">Edit Score & Comment</h2><br>
                                                            <h3 class="mb-0 h5">'.$teamname[$no-1].'</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form method="post">
                                                                <!-- Form -->
                                                                <h3 class="mb-0 h5 text-decoration-underline">Score</h3>';
                                                                //Show all the scores of the team
                                                                $no4 = 1;
                                                                while($no4 <= count($scorelist)){

                                                                    echo'<div class="form-group text-start">
                                                                            <label for="score'.$no4.'">Score '.$no4.'</label>
                                                                            <div class="input-group mb-4">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><span class="fas fa-clipboard-check"></span></span>
                                                                                </div>
                                                                                <input class="form-control" id="score'.$no4.'" name="'.$teamname[$no-1].'score'.$no4.'" value='.$scorelist[$no4-1].' type="number" aria-label="score'.$no4.'" required>
                                                                            </div>
                                                                        </div>';
                                                                    $no4 = $no4 + 1;
                                                                }


                                                            echo'<h3 class="mb-0 h5 text-decoration-underline">Comment</h3>
                                                                <div class="form-group text-start">
                                                                    <label for="comment">Comment</label>
                                                                    <div class="input-group mb-4">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><span class="fas fa-comment-dots"></span></span>
                                                                        </div>
                                                                        <!-- Show the comment of the team -->
                                                                        <textarea class="form-control" id="comment" name="'.$teamname[$no-1].'comment" aria-label="comment" required>'.$comment["comment"].'</textarea>
                                                                    </div>
                                                                </div>
                                                                <input type="submit" name="'.$teamname[$no-1].'editbtn" class="btn btn-block btn-primary" value="Edit">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End of Modal Content -->

                                </tr>';
                                $no = $no + 1;
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>