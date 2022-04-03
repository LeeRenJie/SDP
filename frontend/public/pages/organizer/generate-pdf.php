<?php
require('../../../../backend/fpdf/fpdf.php');
$con=mysqli_connect("localhost","root","","judgeable");
$event_id = intval($_SERVER['QUERY_STRING']);
$event_sql = ("SELECT * FROM event WHERE event_id = '$event_id'");
$event_result = mysqli_query($con, $event_sql);
$event_row=mysqli_fetch_array($event_result);
$event_name = $event_row['event_name'];
$type = $event_row['participant_type'];

class PDF extends FPDF {
	function Header(){
		$this ->SetFont('Arial','B',14);
		$this ->Cell(12);
		$con=mysqli_connect("localhost","root","","judgeable");
		$event_id = intval($_SERVER['QUERY_STRING']);
		$event_sql = ("SELECT * FROM event WHERE event_id = '$event_id'");
		$event_result = mysqli_query($con, $event_sql);
		$event_row=mysqli_fetch_array($event_result);
		$event_name = $event_row['event_name'];
		$type = $event_row['participant_type'];

		$title = "Event Result for $event_name";
		$this->Cell(100,10,$title,0,1);
		$this->Ln(5);
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(25,5,'Rank',1,0,'',true);
		if ($type == "team") {
			$this->Cell(40,5,'Team Name',1,0,'',true);
			$this->Cell(65,5,'Team Members',1,0,'',true);
		}
		else{
			$this->Cell(40,5,'Participant Name',1,0,'',true);
		}
		$this->Cell(60,5,'Total Score',1,1,'',true);

	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);

		//Go to 1.5 cm from bottom
		$this->SetY(-15);

		$this->SetFont('Arial','',8);

		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

$team_rank_sql = (
	"SELECT tl.team_name, GROUP_CONCAT(DISTINCT u.name) AS team_members, SUM(sc.score) AS total_score
	FROM judgement_list AS jl INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
	INNER JOIN score AS sc ON sl.score_id = sc.score_id
	INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
	JOIN participant AS p ON tl.participant_id = p.participant_id
	JOIN user AS u ON p.user_id = u.user_id
	INNER JOIN event AS ev ON tl.event_id = ev.event_id
	WHERE ev.event_id = '$event_id'
	GROUP BY tl.team_list_id
	ORDER BY total_score DESC;"
);

$participant_sql = (
	"SELECT u.name, SUM(sc.score) AS total_score
	FROM judgement_list AS jl INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
	INNER JOIN score AS sc ON sl.score_id = sc.score_id
	INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
	JOIN participant AS p ON tl.participant_id = p.participant_id
	JOIN user AS u ON p.user_id = u.user_id
	INNER JOIN event AS ev ON tl.event_id = ev.event_id
	WHERE ev.event_id = '$event_id'
	GROUP BY tl.team_list_id
	ORDER BY total_score DESC;"
);

$query=mysqli_query($con, $team_rank_sql);
$i = 1;
if ($type=="team"){
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(25,5,$i,'LR',0);
		$pdf->Cell(40,5,$data['team_name'],'LR',0);
		$pdf->Cell(65,5,$data['team_members'],'LR',0);
		$pdf->Cell(60,5,$data['total_score'],'LR',1);
		$i++;
	}
}
else{
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(25,5,$i,'LR',0);
		$pdf->Cell(40,5,$data['name'],'LR',0);
		$pdf->Cell(60,5,$data['total_score'],'LR',1);
		$i++;
	}
};

$pdf->Output();
?>