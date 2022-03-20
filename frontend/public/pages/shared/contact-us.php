<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/contact-us.css" />
  <title>Contact Us</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 bg-shadow overflow-auto" style="border-radius:30px;">
      <div class="overflow-y-auto">
        <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
          <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
        </div>
        <div class="d-flex justify-content-center mt-4">
          <div class="card bg-primary border-light shadow-soft w-60 card-height">
            <div class="text-center">
              <h1 class="display-2 mt-4">Contact Us</h1>
            </div>
            <form action="#">
              <div class="form-group mb-3 px-5 pt-4">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group px-5 pt-3">
                <label for="exampleFormControlTextarea2">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
              </div>
              <button type="submit" class="ml-5 mt-3 btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>