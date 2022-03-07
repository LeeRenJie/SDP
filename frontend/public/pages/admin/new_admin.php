<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/28d45fc291.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
  <link rel="stylesheet" href="../../../src/stylesheets/admin-new_admin.css">
  <title>Document</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow">
      <div style="height:100% ; width: 100%;">
        <div class="row" style="height: 100%; margin-top:3%">
          <div class="col">
            <!--Grey Container position at the middle for content-->
            <div class="row general_container mx-auto" style="width:500px;">
              <!-- Entry fields below-->
              <div class="form-group" style="margin-left:8.7%; margin-top:8%;">
                <label for="validationServer01">Username</label>
                <!--Take note, is-valid class is the class that ticks or cross the input box, use js script to hide and show-->
                <input type="text" class="form-control is-valid" id="validationServer01" style="width: 390px;" required>
                <!--Need to add js script later to hide the feedback by default and show when username is valid and not repeated in database-->
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="form-group mb-4" style="margin-left:8.7%; margin-top:3%;">
                <label for="validationServerUsername">Name</label>
                <input type="text" class="form-control is-invalid" id="validationServerUsername" style="width: 390px;" required>
                <!--Need to add js script later to hide the classes invalid-feedback and is-invalid by default and show when invalid-->
                <div class="invalid-feedback">
                  Please enter your name.
                </div>
              </div>
              <!--Disabled Input for Privilege-->
              <div class="form-group mb-4 privilege_div">
                <label for="validationServerUsername">Privilege</label>
                <input type="text" class="form-control is-valid" id="validationServerUsername" style="width: 390px;" value="Admin" disabled>
              </div>
              <!--Password Input (password length validation)-->
              <div class="form-group pass_div">
                <label for="validationServerUsername">Password</label>
                <input type="text" class="form-control is-invalid" id="validationServerUsername" style="width: 390px;" required>
                <!--Need to add js script later to hide the feedback by default and show when invalid-->
                <div class="invalid-feedback">
                  Please use a password that has at least 5 characters.
                </div>
              </div>
              <div class="row" style="margin-bottom: 6%;">
                <div class="col">
                  <button class="btn btn-primary btn-pill text-success animate-up-2 create_button" type="button">Create</button>
                </div>
                <div class="col">
                  <button class="btn btn-primary btn-pill text-danger animate-up-2 cancel_button" type="button">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>