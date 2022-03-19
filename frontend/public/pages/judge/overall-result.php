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
        <div class="flex flex-row h-screen" style="height: 640px">
            <?php include '../shared/sidebar.php';?>
            <div class="basis-10/12 overflow-auto shadow">
                <div class="maincontainer text-center">
                    <h2 class="mt-5 text-decoration-underline">Overall Result</h2>
                    <div class="card shadow-soft bg-primary border-light px-4 mx-5 my-4 rounded">
                        <table class="table result">
                            <tr>
                                <th class="border-0" scope="col" id="team">Team</th>
                                <th class="border-0" scope="col" id="score&comment">Score & Comment</th>
                                <th class="border-0" scope="col" id="totalscore">Total Score</th>
                                <th class="border-0" scope="col" id="rank">Rank</th>
                                <th class="border-0" scope="col" id="edit"></th>
                            </tr>
                            <tr class="shadow-inset bg-primary border-light p-4 rounded">
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="team1">Team 1</td>
                                <td class="border-0 p-0 align-middle" id="score&comment1">
                                    <table class="table">
                                        <tr>
                                            <th class="border-0" scope="col" id="criteria1">Criteria 1</th>
                                            <th class="border-0" scope="col" id="criteria2">Criteria 2</th>
                                            <th class="border-0" scope="col" id="criteria3">Criteria 3</th> 
                                            <th class="border-0" scope="col" id="criteria3">Criteria 4</th>
                                        </tr>
                                        <tr>
                                            <td class="border-0" scope="row" id="score1">25%</th>
                                            <td class="border-0" scope="row" id="score2">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                        </tr>
                                        <tr>
                                            <th class="border-0" scope="row" id="comment1">Comment: </th>
                                            <td class="border-0 text-start" scope="row" colspan="3" id="score2">No comment!</th>
                                        </tr>
                                    </table>
                                </td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="totalscore">100%</td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="rank1">1</td>
                                <td class="border-0 align-middle" scope="row" id="edit1"><a href=""><i class="fa-solid fa-pen-to-square fa-2xl"></i></a></td>
                            </tr>
    
                            <tr class="shadow-inset bg-primary border-light p-4 rounded">
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="team1">Team 2</td>
                                <td class="border-0 p-0 align-middle" id="score&comment1">
                                    <table class="table">
                                        <tr>
                                            <th class="border-0" scope="col" id="criteria1">Criteria 1</th>
                                            <th class="border-0" scope="col" id="criteria2">Criteria 2</th>
                                            <th class="border-0" scope="col" id="criteria3">Criteria 3</th> 
                                            <th class="border-0" scope="col" id="criteria3">Criteria 4</th>
                                        </tr>
                                        <tr>
                                            <td class="border-0" scope="row" id="score1">25%</th>
                                            <td class="border-0" scope="row" id="score2">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                        </tr>
                                        <tr>
                                            <th class="border-0" scope="row" id="comment1">Comment: </th>
                                            <td class="border-0 text-start" scope="row" colspan="3" id="score2">No comment!</th>
                                        </tr>
                                    </table>
                                </td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="totalscore">100%</td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="rank1">1</td>
                                <td class="border-0 align-middle" scope="row" id="edit1"><a href=""><i class="fa-solid fa-pen-to-square fa-2xl"></i></a></td>
                            </tr>  
    
                            <tr class="shadow-inset bg-primary border-light p-4 rounded">
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="team1">Team 3</td>
                                <td class="border-0 p-0 align-middle" id="score&comment1">
                                    <table class="table">
                                        <tr>
                                            <th class="border-0" scope="col" id="criteria1">Criteria 1</th>
                                            <th class="border-0" scope="col" id="criteria2">Criteria 2</th>
                                            <th class="border-0" scope="col" id="criteria3">Criteria 3</th> 
                                            <th class="border-0" scope="col" id="criteria3">Criteria 4</th>
                                        </tr>
                                        <tr>
                                            <td class="border-0" scope="row" id="score1">25%</th>
                                            <td class="border-0" scope="row" id="score2">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                        </tr>
                                        <tr>
                                            <th class="border-0" scope="row" id="comment1">Comment: </th>
                                            <td class="border-0 text-start" scope="row" colspan="3" id="score2">No comment!</th>
                                        </tr>
                                    </table>
                                </td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="totalscore">100%</td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="rank1">1</td>
                                <td class="border-0 align-middle" scope="row" id="edit1"><a href=""><i class="fa-solid fa-pen-to-square fa-2xl"></i></a></td>
                            </tr> 
                            
                            <tr class="shadow-inset bg-primary border-light p-4 rounded">
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="team1">Team 4</td>
                                <td class="border-0 p-0 align-middle" id="score&comment1">
                                    <table class="table">
                                        <tr>
                                            <th class="border-0" scope="col" id="criteria1">Criteria 1</th>
                                            <th class="border-0" scope="col" id="criteria2">Criteria 2</th>
                                            <th class="border-0" scope="col" id="criteria3">Criteria 3</th> 
                                            <th class="border-0" scope="col" id="criteria3">Criteria 4</th>
                                        </tr>
                                        <tr>
                                            <td class="border-0" scope="row" id="score1">25%</th>
                                            <td class="border-0" scope="row" id="score2">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                        </tr>
                                        <tr>
                                            <th class="border-0" scope="row" id="comment1">Comment: </th>
                                            <td class="border-0 text-start" scope="row" colspan="3" id="score2">No comment!</th>
                                        </tr>
                                    </table>
                                </td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="totalscore">100%</td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="rank1">1</td>
                                <td class="border-0 align-middle" scope="row" id="edit1"><a href=""><i class="fa-solid fa-pen-to-square fa-2xl"></i></a></td>
                            </tr> 
                            
                            <tr class="shadow-inset bg-primary border-light p-4 rounded">
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="team1">Team 5</td>
                                <td class="border-0 p-0 align-middle" id="score&comment1">
                                    <table class="table">
                                        <tr>
                                            <th class="border-0" scope="col" id="criteria1">Criteria 1</th>
                                            <th class="border-0" scope="col" id="criteria2">Criteria 2</th>
                                            <th class="border-0" scope="col" id="criteria3">Criteria 3</th> 
                                            <th class="border-0" scope="col" id="criteria3">Criteria 4</th>
                                        </tr>
                                        <tr>
                                            <td class="border-0" scope="row" id="score1">25%</th>
                                            <td class="border-0" scope="row" id="score2">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                            <td class="border-0" scope="row" id="score3">25%</th>
                                        </tr>
                                        <tr>
                                            <th class="border-0" scope="row" id="comment1">Comment: </th>
                                            <td class="border-0 text-start" scope="row" colspan="3" id="score2">No comment!</th>
                                        </tr>
                                    </table>
                                </td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="totalscore">100%</td>
                                <td class="border-0 align-middle font-weight-bold" scope="row" id="rank1">1</td>
                                <td class="border-0 align-middle" scope="row" id="edit1"><a href=""><i class="fa-solid fa-pen-to-square fa-2xl"></i></a></td>
                            </tr>  
                        </table>
                    </div>
                </div>
            </div> 
        </div>           
    </body>
</html>