<?php
    // start the session
    session_start();
    //Connection to Database
    include("../../../../backend/conn.php");

    $sql="SELECT * FROM team_list WHERE event_id = '$_SESSION[event_id]'";

    $result=mysqli_query($con,$sql);

    $teamlist = Array();
    while($team=mysqli_fetch_array($result)){
        $teamlist[] = $team["team_name"];
    }

    $sql2="SELECT * FROM criteria WHERE event_id = '$_SESSION[event_id]'";

    $result2=mysqli_query($con,$sql2);

    $criteriaidlist = Array();
    $criterialist = Array();
    while($criteria=mysqli_fetch_array($result2)){
        $criteriaidlist[] = $criteria["criteria_id"];
        $criterialist[] = $criteria["criteria_name"];
    }
    
    $noteam = 0;
    while ($noteam < count($teamlist)){

        if (isset($_POST["".$teamlist[$noteam]."submitbtn"])){
            $no4 = 1;
            $scoreidlist = Array();
            while($no4 <= count($criteriaidlist)){
                $scoresql="INSERT INTO score (criteria_id, score) VALUES (".$criteriaidlist[$no4-1].", ".$_POST["".$teamlist[$noteam]."score$no4"].")";
                mysqli_query($con,$scoresql);
                $scoreidsql="SELECT score_id FROM score ORDER BY score_id DESC LIMIT 1";
                $scoreid = mysqli_fetch_array(mysqli_query($con,$scoreidsql));
                $scoreidlist[] = $scoreid["score_id"];
                $no4 = $no4 + 1;   
            }   
            
            if ($_POST["".$teamlist[$noteam]."comment"]==""){
                $commentsql="INSERT INTO comment (comment) VALUES ('No comment.')";
                mysqli_query($con,$commentsql);
            }
            else{
                $commentsql="INSERT INTO comment (comment) VALUES ('".$_POST["".$teamlist[$noteam]."comment"]."')";
                mysqli_query($con,$commentsql);
            }
            
            $readcommentid="SELECT comment_id FROM comment ORDER BY comment_id DESC LIMIT 1";
            $commentid = mysqli_fetch_array(mysqli_query($con,$readcommentid));
            

            $no5 = 1;
            while ($no5 <= count($scoreidlist)){
                if($no5==1){
                    $scorelistsql="INSERT INTO score_list (score_id) VALUES (".$scoreidlist[$no5-1].")";
                    mysqli_query($con,$scorelistsql);
                }
                else{
                    $scorelistidsql="SELECT * FROM score_list WHERE score_id = ".$scoreidlist[0]."";
                    $sqlresult = mysqli_fetch_array(mysqli_query($con,$scorelistidsql));
                    $scorelistid = $sqlresult["score_list_id"];
                    $scorelistsql="INSERT INTO score_list (score_list_id, score_id) VALUES (".$scorelistid.", ".$scoreidlist[$no5-1].")";
                    mysqli_query($con,$scorelistsql);
                }
                
                $no5 = $no5 + 1;
            }
            
            $readteam_list_id="SELECT team_list_id FROM team_list WHERE team_name = '".$teamlist[$noteam]."'";
            $team_list_id = mysqli_fetch_array(mysqli_query($con,$readteam_list_id));
            
            $judgementlist="INSERT INTO judgement_list (score_list_id, comment_id, judge_id, team_list_id) VALUES (".$scorelistid.", ".$commentid['comment_id'].", ".$_SESSION['judge_id'].", ".$team_list_id['team_list_id'].")";
            mysqli_query($con,$judgementlist);
        }
        $noteam = $noteam + 1;
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
        <link href="../../../src/stylesheets/judge-judgement.css" rel="stylesheet"> 
        <link href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
        <title>Judgement</title>    
    </head>
    <body>
        <?php include '../shared/navbar.php';?>
        <div class="flex flex-row h-screen" style="padding-bottom: 65px;">
            <?php include '../shared/sidebar.php';?>
            <div class="basis-10/12 overflow-auto shadow">
                <div class="maincontainer text-center mx-5" style="width: auto; justify-content: center;">
                    <h1>Judgement Form</h1>
                    

                            <!-- Tab Nav -->
                            <div class="nav-wrapper position-relative mb-4 mt-3 text-center">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                                    
                                <?php
                                    $no = 1;
                                    while($no <= count($teamlist)){
                                        echo '<li class="nav-item mr-sm-3 mr-md-0 p-2 noHover">
                                                <a class="nav-link mb-sm-3 mb-md-0 mt-3 ';
                                                
                                                if($no==1){
                                                    echo "active";
                                                }

                                                echo '" id="tabs-text-'.$no.'-tab" data-toggle="tab" href="#tabs-text-'.$no.'" role="tab" aria-controls="tabs-text-'.$no.'" aria-selected="true">'.$teamlist[$no-1].'</a>
                                              </li>';
                                        $no = $no + 1;
                                    }
                                ?>
                                </ul>
                            </div>
                            <!-- End of Tab Nav -->
                            <!-- Tab Content -->
                            <div class="card shadow-soft bg-primary border-light p-4 rounded">
                                <div class="card-body p-0">
                                    <div class="tab-content" id="tabcontent1">
                                        <?php
                                        $no1 = 1;
                                        while ($no1<$no){
                                            $teamname=$teamlist[$no1-1];
                                                                        
                                            echo '<div class="tab-pane fade show ';
                                                if($no1==1){
                                                    echo "active";
                                                }

                                                echo'" id="tabs-text-'.$no1.'" role="tabpanel" aria-labelledby="tabs-text-'.$no1.'-tab">
                                                <p class="h4 text-decoration-underline">'.$teamname.'</p>
                                                <p class="fs-6">Total Point: 100%</p>
                                                <form method="post">
                                                    <div class="overflow-auto p-0">
                                                    <table class="table shadow-soft rounded mx-2 text-center">
                                                        <tr>';

                                                                $no2 = 1;
                                                                while($no2 <= count($criterialist)){
                                                                    echo '<th class="border-0" scope="col" id="criteria'.$no2.'">'.$criterialist[$no2-1].'</th>';
                                                                    $no2 = $no2 + 1;
                                                                }    
                                                            
                                                    echo '</tr>

                                                        <div class="form-group">
                                                            <tr>';

                                                                    $no3 = 1;
                                                                    while($no3 < $no2){
                                                                        echo '<td headers="criteria'.$no3.'"><input type="number" class="form-control" ';
                                                        
                                                    
                                                                        $sql3 = "SELECT * FROM judgement_list AS jl INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                                                                                WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamname."'";
                                                                       
                                                                        $check=mysqli_query($con,$sql3);
                                                                        $rownum=mysqli_num_rows($check);

                                                                        if($rownum==1){
                                                                            echo 'readonly="readonly" ';
                                                                        }
                                                                        else{
                                                                            echo '';
                                                                        }
                                                                        echo 'name="'.$teamname.'score'.$no3.'" required></td>';
                                                                        $no3 = $no3 + 1;
                                                                    }
                                                                
                                                        echo '</tr>  
                                                        </div>
                                                    </table>
                                                    </div>
                                                    <div class="form-group text-start mt-5">
                                                        <label class="h6 ms-2" for="comment">Comment: </label>
                                                        <textarea class="form-control" id="comment" name="'.$teamname.'comment" ';
                                                        $sql4 = "SELECT * FROM judgement_list AS jl INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
                                                                WHERE jl.judge_id = ".$_SESSION["judge_id"]." AND tl.team_name = '".$teamname."'";
                                                        $check=mysqli_query($con,$sql4);
                                                        $rownum=mysqli_num_rows($check);
                                                        if($rownum==1){
                                                            echo 'readonly="readonly" ';
                                                        }
                                                        else{
                                                            echo '';
                                                        }
                                                        echo 'rows="3"></textarea>
                                                    </div>
                                                    <div class="text-end mt-4">
                                                        <input type="submit" name="'.$teamname.'submitbtn" class="btn submitbtn" ';
                                                        if($rownum==1){
                                                            echo "disabled='disabled'";
                                                        }
                                                        else{
                                                            echo "";
                                                        }
                                                        echo '></input>
                                                    </div> 
                                                </form>  
                                            </div>';
                                            $no1 = $no1 + 1;
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End of Tab Content -->
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>
    </body>
</html>