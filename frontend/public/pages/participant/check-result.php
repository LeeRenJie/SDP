<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }
  //get user id from url
  $userid = $_SESSION['user_id'];

  //Query to get all data
  $user_query = "SELECT * FROM team_list
  INNER JOIN event ON event.event_id = team_list.event_id
  INNER JOIN criteria ON criteria.event_id = event.event_id
  INNER JOIN score ON score.criteria_id = criteria.criteria_id
  INNER JOIN score_list ON score_list.score_id = score.score_id
  INNER JOIN judgement_list ON judgement_list.score_list_id = score_list.score_list_id
  INNER JOIN comment ON judgement_list.comment_id = comment.comment_id
  INNER JOIN result ON result.judgement_list_id = judgement_list.judgement_list_id
  WHERE team_list.participant_id = 1
  AND team_list.event_id = 1";
  // Execute the query
  $user_query_run = mysqli_query($con, $user_query);
  // Fetch data
  $userdata = mysqli_fetch_assoc($user_query_run);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-check-result.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Check Result</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <br>
      <div class="main-container">
        <div class ="btn-row">
          <div class="infront">
            <a onclick="history.back()">
              <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
            </a>
          </div>
        </div>
        <h2>Check Result</h2>
        <!-- Search Container -->
        <form method="post">
          <div class="search-con">
            <div class="search-box">
              <input type="text" class="form-control search-field" placeholder="UNIQUE CODE" name="search_text">
              <button class="btn search-btn" name="searchBtn" type="submit"><span class="fas fa-search"></span></button>
            </div>
          </div>
        </form>
        <!-- details -->
        <?php
        if (isset($_POST['searchBtn'])){
          // get the value of the search key
          $search_key = "";
          $search_key = $_POST['search_text'];

          //get team info
          $query_team_info = "SELECT * FROM team_list
                        WHERE unique_code = 'kjh024'"; //'$search_key'
          $run_team_info = mysqli_query($con, $query_team_info);
          $team_info = mysqli_fetch_assoc($run_team_info);

          //get all criteria
          $query_cri_info = "SELECT * FROM criteria
          INNER JOIN event ON criteria.event_id = event.event_id
          INNER JOIN team_list ON team_list.event_id = event.event_id
          WHERE team_list.unique_code = 'kjh024'"; //change to '$search_key'"
          $run_cri_info = mysqli_query($con, $query_cri_info);

          //number of criteria
          $num_cri_info = mysqli_num_rows($run_cri_info);

          //get overall criteria score
          $get_ovr_scr = 
          "SELECT score.score, criteria.criteria_id FROM `result`
          INNER JOIN judgement_list ON judgement_list.judgement_list_id = result.judgement_list_id
          INNER JOIN score_list ON score_list.score_list_id = judgement_list.score_list_id
          INNER JOIN score ON score_list.score_id = score.score_id
          INNER JOIN criteria ON criteria.criteria_id = score.criteria_id
          INNER JOIN team_list ON team_list.team_list_id = judgement_list.team_list_id
          WHERE team_list.unique_code = 'kjh024'
          ORDER BY criteria.criteria_id ASC";
          $run_ovr_scr = mysqli_query($con, $get_ovr_scr);
          $ovr_scr = mysqli_fetch_array($run_ovr_scr);
          //create array
          $overall_cri_score=Array();
          //for each row, store inside array
          foreach($run_ovr_scr as $score) {
            $overall_cri_score[] = $score['score'];
          }
          $total_scr = COUNT($overall_cri_score); //get actual number of array
          $count_score = 0;
          $x = 0;
          while($x < $total_scr){
            $count_score = $count_score + $overall_cri_score[$x]; //in final this will get total score
            $x = $x + 1;
          }
        ?>
          <div class="row">
            <!-- Result Container -->
            <div class="col item-con">
              <h2>Result</h2>
              <div class="result-details">
                <div class="row">
                  <label for="team-name" class="col-sm-6 col-form-label">
                    Team Name
                  </label>
                    <p class="col-sm-6 col-form-label" id="team-name" name="team-name"> <!--team name-->
                      <?php echo ($team_info['team_name']) ?>
                    </p>
                </div>
                <div class="row"> <!--display only-->
                  <label class="col-sm-6 col-form-label">
                    Overall Score
                  </label>
                </div>
                <?php
                $y = 1;
                $z = 0;
                while ($y <= $num_cri_info) {
                  $sum_cri_score = "SELECT score.score, criteria.criteria_id FROM `result`
                  INNER JOIN judgement_list ON judgement_list.judgement_list_id = result.judgement_list_id
                  INNER JOIN score_list ON score_list.score_list_id = judgement_list.score_list_id
                  INNER JOIN score ON score_list.score_id = score.score_id
                  INNER JOIN criteria ON criteria.criteria_id = score.criteria_id
                  INNER JOIN team_list ON team_list.team_list_id = judgement_list.team_list_id
                  WHERE team_list.unique_code = 'kjh024'
                  AND criteria.criteria_id = $y
                  ORDER BY criteria.criteria_id ASC";
                  $run_sum_cri_score = mysqli_query($con, $sum_cri_score);
                  // $sum_cri_result = mysqli_fetch_assoc($run_sum_cri_score);
                  // $num_cri_score = mysqli_num_rows($run_sum_cri_score);
                  $sum_crit = 0;
                  foreach($run_sum_cri_score as $sum){
                    $sum_crit = $sum_crit + intval($sum['score']);
                  }
                  //create array
                  $criteria_name = Array();
                  //for each row, store inside array
                  foreach($run_cri_info as $cri) {
                    $criteria_name[] = $cri['criteria_name'];
                  }
                  echo "<div class='row'>";
                    echo "<label for='criteria' class='col-sm-6 col-form-label'> <!--criteria name-->";
                        echo $criteria_name[$z]; //criteria name
                    echo "</label>";
                    echo "<p class='col-sm-6 col-form-label' id='criteria' name='criteria'> <!--overall criteria name-->";
                      echo $sum_crit;
                    echo "</p>";
                  echo " </div>";
                  
                  $y = $y + 1;
                  $z = $z + 1;
                }
                ?>
                <div class="row">
                  <label for="total-score" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                    Total Score
                  </label>
                    <p class="col-sm-6 col-form-label" id="total-score" name="total-score">
                      <?php echo $count_score?>
                    </p>
                </div>
                <?php
                //get overall criteria score
                $get_all_event_score = 
                "SELECT score.score, criteria.criteria_id, team_list.unique_code FROM `result`
                INNER JOIN judgement_list ON judgement_list.judgement_list_id = result.judgement_list_id
                INNER JOIN score_list ON score_list.score_list_id = judgement_list.score_list_id
                INNER JOIN score ON score_list.score_id = score.score_id
                INNER JOIN criteria ON criteria.criteria_id = score.criteria_id
                INNER JOIN team_list ON team_list.team_list_id = judgement_list.team_list_id
                WHERE team_list.event_id = $team_info[event_id]
                ORDER BY team_list.unique_code ASC";
                $run_all_score = mysqli_query($con, $get_all_event_score);
                $all_score = mysqli_fetch_array($run_all_score);
                //create array
                $all_event_score = Array();
                //for each row, store inside array
                foreach($run_all_score as $score_all) {
                  $all_event_score[] = $score_all['score'];
                }
                $total_scr = COUNT($overall_cri_score); //get actual number of array
                $count_score = 0;
                $x = 0;
                while($x < $total_scr){
                  $count_score = $count_score + $overall_cri_score[$x]; //in final this will get total score
                  $x = $x + 1;
                }
                ?>
                <div class="row">
                  <label for="rank" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                    Rank
                  </label>
                    <p class="col-sm-6 col-form-label" id="rank" name="rank">
                      1
                    </p>
                </div>
                <div class="row">
                  <label for="prize" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                    Prize
                  </label>
                    <p class="col-sm-6 col-form-label" id="prize" name="prize">
                      1000$
                    </p>
                </div>
              </div>
            </div>

            <!-- Comment Container -->
            <div class="col item-con">
              <h2>Comments</h2>
              <div class="comment-details">
                <div class="row">
                  <label class="col-1 col-form-label">
                    1.
                  </label>
                  <p class=" col-11 col-form-label">xxxxxxxxxxxxx xxxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxx xxxxx xxxxxxxxxx xxxxxxxxxxxx x x x x xx x x x</p>
                </div>
                <div class="row">
                  <label class="col-1 col-form-label">
                    2.
                  </label>
                  <p class=" col-11 col-form-label">xxxxxxxxxxxxx xxxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxx xxxxx xxxxxxxxxx xxxxxxxxxxxx x x x x xx x x x</p>
                </div>
                <div class="row">
                  <label class="col-1 col-form-label">
                    3.
                  </label>
                  <p class=" col-11 col-form-label">xxxxxxxxxxxxx xxxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxx xxxxx xxxxxxxxxx xxxxxxxxxxxx x x x x xx x x x</p>
                </div>
                <div class="row">
                  <label class="col-1 col-form-label">
                    4.
                  </label>
                  <p class=" col-11 col-form-label">xxxxxxxxxxxxx xxxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxx xxxxx xxxxxxxxxx xxxxxxxxxxxx x x x x xx x x x</p>
                </div>
              </div>
            </div>
          </div> <!--row-->
        <?php
        }
        ?>

      </div> <!--main con-->
    </div>
  </div>
</body>
</html>