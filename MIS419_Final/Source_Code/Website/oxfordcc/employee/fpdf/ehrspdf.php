<?php
start_session();
$jobnum = $_GET['empnum'];

require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('occ.png',55,6,100);
    $this->Ln(30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Job Statement: '.date("Y/m/d"),0,1,'C');
    // Line break
    $this->Ln(5);
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','I',15);
//$pdf->Cell(0,10, $monthName ,0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',14);
$pdf->Cell(0,10, 'Report Generated for: '.$_SESSION['fname'].' '.$_SESSION['lname'] ,0,1);
$pdf->Cell(60,7,'Job',1,0,'C');
$pdf->Cell(20,7,'Hours',1,0,'C');
$pdf->Cell(40,7,'Wage Cost',1,0,'C');
$pdf->Cell(40,7,'Mat Cost',1,0,'C');
$pdf->Cell(30,7,'Total Cost',1,0,'C');
$pdf->Ln();


   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/oxfordcc/employee/eurm.php";
   include_once($path);

			try {
				$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
				//preparing the sql statement
				$STH = $dbc->prepare("SELECT Jobs.JobName AS job, DV.AH AS hours, DV.SW AS SUM_WAGE, MNUMS.SM AS SUM_MAT, (
							DV.SW + MNUMS.SM
							) AS TOTAL_COST
							FROM Jobs, (
							
							SELECT JobID, SUM( Wages ) AS SW, SUM( Approved_hrs ) AS AH
							FROM Hours
							GROUP BY JobID
							)DV
							LEFT OUTER JOIN (
							
							SELECT JobNum, SUM( MCost ) AS SM
							FROM Materials
							GROUP BY Jobnum
							)MNUMS ON DV.JobID = MNUMS.JobNum
							WHERE Jobs.JobID =?
							AND Jobs.JobID = DV.JobID");
				if (isset($_POST['jobnum'])){
				$STH->bindParam(1, $_POST['jobnum']);
				}
				else{
				 $STH->bindParam(1, $jobnum);
				 }
				//$STH->bindParam(2, $lname); 
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				$STH->execute();

				$rows = 0;
				//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
				while($emprow = $STH->fetch()) {
				        $pdf->Cell(60,6,$emprow['job'],'LR',0,'C');
				        $pdf->Cell(20,6,$emprow['hours'],'LR',0,'C');
				        $pdf->Cell(40,6,$emprow['SUM_WAGE'],'LR',0,'C');
				        $pdf->Cell(40,6,$emprow['SUM_MAT'],'LR',0,'C');
				        $sumstuff = ($emprow['SUM_WAGE'] + $emprow['SUM_MAT']);
				        //$pdf->Cell(30,6,$emprow['TOTAL_COST'],'LR',0,'C');
				        $pdf->Cell(30,6,$sumstuff,'LR',0,'C');
				        $pdf->Ln();
				        $pdf->Cell(180,0,'','T');
				        $pdf->Ln();
				        $total += $sumstuff;
				        $rows += 1;
				        $name = $emprow['job'];

				}
				}
				catch(PDOException $e)
				{
				echo "Database Operations Failed: " . $e->getMessage();
				}
$pdf->Cell(190,0,'','T');
$pdf->Ln(5);
IF($rows == 0){
	$pdf->Cell(0,10,'No Data Found',0,1);
 }
 else{
 	$pdf->Cell(0,10,'Current Expenses for '.$name.' are '.$total.' dollars.' ,0,1);
}
$pdf->Output();
?>