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
        <div class="flex flex-row h-screen" style="height: 640px">
            <?php include '../shared/sidebar.php';?>
            <div class="basis-10/12 overflow-auto shadow">
                <div class="maincontainer text-center">
                    <h1>Judging Form</h1>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- Tab Nav -->
                            <div class="nav-wrapper position-relative mb-4 mt-3 text-center">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                                    <li class="nav-item mr-sm-3 mr-md-0 noHover">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Team 1</a>
                                    </li>
                                    <li class="nav-item mr-sm-3 mr-md-0 noHover">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Team 2</a>
                                    </li>
                                    <li class="nav-item mr-sm-3 mr-md-0 noHover">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">Team 3</a>
                                    </li>
                                    <li class="nav-item mr-sm-3 mr-md-0 noHover">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-4-tab" data-toggle="tab" href="#tabs-text-4" role="tab" aria-controls="tabs-text-4" aria-selected="true">Team 4</a>
                                    </li>
                                    <li class="nav-item mr-sm-3 mr-md-0 noHover">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-4-tab" data-toggle="tab" href="#tabs-text-5" role="tab" aria-controls="tabs-text-5" aria-selected="true">Team 5</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End of Tab Nav -->
                            <!-- Tab Content -->
                            <div class="card shadow-soft bg-primary border-light p-4 rounded">
                                <div class="card-body p-0">
                                    <div class="tab-content" id="tabcontent1">
                                        <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-text-1-tab">
                                            <p class="h4 text-decoration-underline">Team 1</p>
                                            <p class="fs-6">Total Point: 100%</p>
                                            <form method="post" action="#">
                                                <table class="table shadow-soft rounded mt-4">
                                                    <tr>
                                                        <th class="border-0" scope="col" id="criteria1">Criteria 1 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria2">Criteria 2 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria3">Criteria 3 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria4">Criteria 4 (25%)</th>
                                                    </tr>

                                                    <div class="form-group">
                                                        <tr>
                                                            <td headers="criteria1"><input type="number" class="form-control" name="score1"></td>
                                                            <td headers="criteria2"><input type="number" class="form-control" name="score2"></td>
                                                            <td headers="criteria3"><input type="number" class="form-control" name="score3"></td>
                                                            <td headers="criteria4"><input type="number" class="form-control" name="score4"></td>
                                                        </tr>  
                                                    </div>
                                                </table>
                                                <div class="form-group text-start mt-5">
                                                    <label class="h6 ms-2" for="comment">Comment: </label>
                                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                                                </div> 
                                            </form>  
                                        </div>
                                        <div class="tab-pane fade" id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-text-2-tab">
                                            <p class="h4 text-decoration-underline">Team 2</p>
                                            <p class="fs-6">Total Point: 100%</p>
                                            <form method="post" action="#">
                                                <table class="table shadow-soft rounded mt-4">
                                                    <tr>
                                                        <th class="border-0" scope="col" id="criteria1">Criteria 1 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria2">Criteria 2 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria3">Criteria 3 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria4">Criteria 4 (25%)</th>
                                                    </tr>
                                                    <div class="form-group">
                                                        <tr>
                                                            <td headers="criteria1"><input type="number" class="form-control" name="score1"></td>
                                                            <td headers="criteria2"><input type="number" class="form-control" name="score2"></td>
                                                            <td headers="criteria3"><input type="number" class="form-control" name="score3"></td>
                                                            <td headers="criteria4"><input type="number" class="form-control" name="score4"></td>
                                                        </tr>  
                                                    </div>
                                                </table>
                                                <div class="form-group text-start mt-5">
                                                    <label class="h6 ms-2" for="comment">Comment: </label>
                                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                                                </div>
                                            </form>    
                                        </div>
                                        <div class="tab-pane fade" id="tabs-text-3" role="tabpanel" aria-labelledby="tabs-text-3-tab">
                                            <p class="h4 text-decoration-underline">Team 3</p>
                                            <p class="fs-6">Total Point: 100%</p>
                                            <form method="post" action="#">
                                                <table class="table shadow-soft rounded mt-4">
                                                    <tr>
                                                        <th class="border-0" scope="col" id="criteria1">Criteria 1 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria2">Criteria 2 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria3">Criteria 3 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria4">Criteria 4 (25%)</th>
                                                    </tr>
                                                    <div class="form-group">
                                                        <tr>
                                                            <td headers="criteria1"><input type="number" class="form-control" name="score1"></td>
                                                            <td headers="criteria2"><input type="number" class="form-control" name="score2"></td>
                                                            <td headers="criteria3"><input type="number" class="form-control" name="score3"></td>
                                                            <td headers="criteria4"><input type="number" class="form-control" name="score4"></td>
                                                        </tr>  
                                                    </div>
                                                </table>
                                                <div class="form-group text-start mt-5">
                                                    <label class="h6 ms-2" for="comment">Comment: </label>
                                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                                                </div> 
                                            </form>   
                                        </div>
                                        <div class="tab-pane fade" id="tabs-text-4" role="tabpanel" aria-labelledby="tabs-text-4-tab">
                                            <p class="h4 text-decoration-underline">Team 4</p>
                                            <p class="fs-6">Total Point: 100%</p>
                                            <form method="post" action="#">
                                                <table class="table shadow-soft rounded mt-4">
                                                    <tr>
                                                        <th class="border-0" scope="col" id="criteria1">Criteria 1 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria2">Criteria 2 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria3">Criteria 3 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria4">Criteria 4 (25%)</th>
                                                    </tr>
                                                    <div class="form-group">
                                                        <tr>
                                                            <td headers="criteria1"><input type="number" class="form-control" name="score1"></td>
                                                            <td headers="criteria2"><input type="number" class="form-control" name="score2"></td>
                                                            <td headers="criteria3"><input type="number" class="form-control" name="score3"></td>
                                                            <td headers="criteria4"><input type="number" class="form-control" name="score4"></td>
                                                        </tr>  
                                                    </div>
                                                </table>
                                                <div class="form-group text-start mt-5">
                                                    <label class="h6 ms-2" for="comment">Comment: </label>
                                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                                                </div> 
                                            </form>  
                                        </div>
                                        <div class="tab-pane fade" id="tabs-text-5" role="tabpanel" aria-labelledby="tabs-text-5-tab">
                                            <p class="h4 text-decoration-underline">Team 5</p>
                                            <p class="fs-6">Total Point: 100%</p>
                                            <form method="post" action="#">
                                                <table class="table shadow-soft rounded mt-4">
                                                    <tr>
                                                        <th class="border-0" scope="col" id="criteria1">Criteria 1 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria2">Criteria 2 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria3">Criteria 3 (25%)</th>
                                                        <th class="border-0" scope="col" id="criteria4">Criteria 4 (25%)</th>
                                                    </tr>
                                                    <div class="form-group">
                                                        <tr>
                                                            <td headers="criteria1"><input type="number" class="form-control" name="score1"></td>
                                                            <td headers="criteria2"><input type="number" class="form-control" name="score2"></td>
                                                            <td headers="criteria3"><input type="number" class="form-control" name="score3"></td>
                                                            <td headers="criteria4"><input type="number" class="form-control" name="score4"></td>
                                                        </tr>  
                                                    </div>
                                                </table>
                                                <div class="form-group text-start mt-5">
                                                    <label class="h6 ms-2" for="comment">Comment: </label>
                                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" name="submitbtn" class="btn">Submit</button>
                                                </div>
                                            </form>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Tab Content -->
                        </div>
                    </div>                    
                    
                </div>               
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>