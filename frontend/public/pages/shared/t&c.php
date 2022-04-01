<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/t&c.css" />
  <title>Terms & Conditions</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen" style="padding-bottom: 40px;">
    <?php 
      if(!isset($_SESSION)) {
        session_start();
      }
      if (!isset($_SESSION['privilege'])){
        ?>
        <div class="col overflow-y-auto marg" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="d-flex justify-content-center mt-4 pb-3">
              <div class="card bg-primary border-light shadow-soft card-width">
                <div class="text-center">
                  <h1 class="display-2 mt-4">Terms and Conditions</h1>
                </div>
                <div class="p-4">
                  <p>
                    These terms of service (together with the documents referred to in it and our Privacy Policy) govern your use of the website or any of our other websites including our various top-level domains as well as various sub-domains and aliases of these domains) 
                    (collectively our “Site”) whether as a website visitor (“User”) or as a registered user of our Services (“Customer”) and sets out the agreement that operates between you and us (“Terms”). These Terms set out the rights and obligations of all Users and Customers 
                    (“you, your”) and those of Judgeable (“us, our, we”) in relation to your use of our Website. We may modify these Terms at any time at our sole discretion, and such modifications shall be effective immediately upon posting of the modified Terms. You 
                    agree to review the Terms periodically to be aware of such modifications and your continued access to or use of the Site shall be deemed your conclusive acceptance of the modified Terms. Please read these Terms of Service and our Privacy Policy carefully before 
                    you start to use our Website. By accessing and/or using our Website, you indicate that you accept these Terms of Service and our Privacy Policy and that you agree to abide by them. If you do not agree to these Terms of Service and our Privacy Policy, please refrain 
                    from using our Website. The Site contains information on its service which enables event professionals to seamlessly set up an event online, with our event management applications (the “Service”) and software products, including our proprietary software applications 
                    and codes. The Software and the Service shall be collectively referred thereafter as the “Platform”. The users of the Platform (“User” or “you”) are invited to use the Platform in accordance with these terms and conditions. Judgeable is an online judging system that
                    enables awards organisers and marketers (“User” or “you”) to manage their awards centrally with a suite of applications to support submission of award nomination, accompanying documentation, collection of payments for submission, designing and sending out emails, 
                    design and customize submission forms and scoring the nominees by judges, with a supporting suite of reporting tools. The Platform allows you to upload, post, publish and make available through it, your own copyrightable materials such as literary and/or artistic works 
                    and other proprietary materials (the “User Generated Content”). As long as your User Generated Content is subject to the applicable copyright law, such User Generated Content shall remain at all times, and to the extent permitted by law, your sole and exclusive property. 
                    You understand and agree that you are solely responsible for your User Generated Content and the consequences of posting or publishing such material in any way. When you upload, post, publish or make available User Generated Content on the Site or use such User Generated 
                    Content via the Platform, you grant to us an irrevocable, perpetual, non-exclusive, royalty-free, transferable, assignable, sub-licensable and worldwide license, to use, reproduce, distribute, transmit, prepare derivative works of, display, make available to the public by 
                    use of databases, such as User Suggestions Databases, and perform that User Generated Content in connection with the Site and/or Platform, whether through the Internet, any mobile device or otherwise, in any media formats and through any media channels known today and 
                    developed in the future. In addition, you agree that Judgeable may use your name and logo (whether or not you have made it available through the Site) for the purpose of identifying you as an existing or past customer of Judgeable both on the Site and in marketing and promotional materials.
                  </p>      
                  </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      else{
        include '../shared/sidebar.php';
        ?>
        <div class="basis-10/12 bg-shadow overflow-y-auto" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="d-flex justify-content-center mt-4 pb-3">
              <div class="card bg-primary border-light shadow-soft card-width">
                <div class="text-center">
                  <h1 class="display-2 mt-4">Terms and Conditions</h1>
                </div>
                <div class="p-4">
                    <p>
                      These terms of service (together with the documents referred to in it and our Privacy Policy) govern your use of the website or any of our other websites including our various top-level domains as well as various sub-domains and aliases of these domains) 
                      (collectively our “Site”) whether as a website visitor (“User”) or as a registered user of our Services (“Customer”) and sets out the agreement that operates between you and us (“Terms”). These Terms set out the rights and obligations of all Users and Customers 
                      (“you, your”) and those of Judgeable (“us, our, we”) in relation to your use of our Website. We may modify these Terms at any time at our sole discretion, and such modifications shall be effective immediately upon posting of the modified Terms. You 
                      agree to review the Terms periodically to be aware of such modifications and your continued access to or use of the Site shall be deemed your conclusive acceptance of the modified Terms. Please read these Terms of Service and our Privacy Policy carefully before 
                      you start to use our Website. By accessing and/or using our Website, you indicate that you accept these Terms of Service and our Privacy Policy and that you agree to abide by them. If you do not agree to these Terms of Service and our Privacy Policy, please refrain 
                      from using our Website. The Site contains information on its service which enables event professionals to seamlessly set up an event online, with our event management applications (the “Service”) and software products, including our proprietary software applications 
                      and codes. The Software and the Service shall be collectively referred thereafter as the “Platform”. The users of the Platform (“User” or “you”) are invited to use the Platform in accordance with these terms and conditions. Judgeable is an online judging system that
                      enables awards organisers and marketers (“User” or “you”) to manage their awards centrally with a suite of applications to support submission of award nomination, accompanying documentation, collection of payments for submission, designing and sending out emails, 
                      design and customize submission forms and scoring the nominees by judges, with a supporting suite of reporting tools. The Platform allows you to upload, post, publish and make available through it, your own copyrightable materials such as literary and/or artistic works 
                      and other proprietary materials (the “User Generated Content”). As long as your User Generated Content is subject to the applicable copyright law, such User Generated Content shall remain at all times, and to the extent permitted by law, your sole and exclusive property. 
                      You understand and agree that you are solely responsible for your User Generated Content and the consequences of posting or publishing such material in any way. When you upload, post, publish or make available User Generated Content on the Site or use such User Generated 
                      Content via the Platform, you grant to us an irrevocable, perpetual, non-exclusive, royalty-free, transferable, assignable, sub-licensable and worldwide license, to use, reproduce, distribute, transmit, prepare derivative works of, display, make available to the public by 
                      use of databases, such as User Suggestions Databases, and perform that User Generated Content in connection with the Site and/or Platform, whether through the Internet, any mobile device or otherwise, in any media formats and through any media channels known today and 
                      developed in the future. In addition, you agree that Judgeable may use your name and logo (whether or not you have made it available through the Site) for the purpose of identifying you as an existing or past customer of Judgeable both on the Site and in marketing and promotional materials.
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
  </div>
</body>
</html>