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
    <div class="basis-10/12 overflow-auto back-shadow">
      <br>
      <div class="main-container">
        <h2>Check Result</h2>
        <!-- Search Container -->
        <form method="post">
          <div class="search-con">
            <div class="search-box">
              <input type="text" class="form-control search-field" placeholder="UNIQUE CODE">
              <button class="btn search-btn" name="searchBtn" type="submit"><span class="fas fa-search"></span></button>
            </div>
          </div>
        </form>
        <!-- details -->
        <div class="row">
          <!-- Result Container -->
          <div class="col item-con">
            <h2 style="color: #0fa046;">Result</h2>
            <div class="result-details">
              <div class="row">
                <label for="team-name" class="col-sm-6 col-form-label">
                  Team Name 
                </label>
                  <p class="col-sm-6 col-form-label" id="team-name" name="team-name">Team helo</p> <!--php code get team name-->
              </div>
              <div class="row"> <!--display only-->
                  <label class="col-sm-6 col-form-label">
                    Overall Score
                  </label>
              </div>
              <div class="row">
                <label for="criteria" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Criteria 1
                </label>
                  <p class="col-sm-6 col-form-label" id="criteria" name="criteria">30</p>
              </div>
              <div class="row">
                <label for="criteria" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Criteria 2
                </label>
                  <p class="col-sm-6 col-form-label" id="criteria" name="criteria">30</p>
              </div>
              <div class="row">
                <label for="criteria" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Criteria 3
                </label>
                  <p class="col-sm-6 col-form-label" id="criteria" name="criteria">100</p>
              </div>
              <div class="row">
                <label for="total-score" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Total Score
                </label>
                  <p class="col-sm-6 col-form-label" id="total-score" name="total-score">160</p>
              </div>
              <div class="row">
                <label for="rank" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Rank
                </label>
                  <p class="col-sm-6 col-form-label" id="rank" name="rank">1</p>
              </div>
              <div class="row">
                <label for="prize" class="col-sm-6 col-form-label"> <!--maybe getting criteria name-->
                  Prize
                </label>
                  <p class="col-sm-6 col-form-label" id="prize" name="prize">1000$</p>
              </div>
            </div>
          </div>

          <!-- Comment Container -->
          <div class="col item-con">
            <h2 style="color: #c51f2f;">Comments</h2>
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
      </div> <!--main con-->
    </div>
  </div>
</body>
</html>