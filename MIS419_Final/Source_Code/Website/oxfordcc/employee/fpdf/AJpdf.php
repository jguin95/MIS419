<?php

require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('occ.png',55,6,100);
    $this->Ln(30);
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Payment Report',0,1,'C');
    // Line break
    $this->Ln(10);
    
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
//$pdf->SetFont('Arial','I',15);
//$pdf->Cell(0,10, $monthName ,0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',14);
$pdf->Cell(33,6,' ',0);
$pdf->Cell(0,10, 'Report Generated for: '.$_POST['fname'].' '.$_POST['lname'] ,0,1);
$pdf->Ln(5);
$pdf->Cell(35,7,' ',0,0,'C');
$pdf->Cell(60,7,'Week',1,0,'C');
$pdf->Cell(20,7,'Hours',1,0,'C');
$pdf->Cell(40,7,'Pretax Wages',1,0,'C');
$pdf->Ln();

   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/oxfordcc/employee/eurm.php";
   include_once($path);

			try {
				//$month = date("m",strtotime($_POST['month']));
				$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
				//preparing the sql statement
				$STH = $dbc->prepare("SELECT Employeeid, Weeknum, SUM( Approved_hrs ) AS AH, SUM( Wages ) AS SW
							FROM Hours
							GROUP BY Employeeid, Weeknum
							HAVING Employeeid = ?");
				//$STH->bindParam(1, $month);
				$STH->bindParam(1, $_POST['empnum']); 

				//$STH->bindParam(2, $lname); 
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				$STH->execute();

				$rows = 0;
				$year = strftime("%Y");
				//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
				while($emprow = $STH->fetch()) {
					$pdf->Cell(35,6,' ',0);
				        $pdf->Cell(60,6,$emprow['Weeknum'],1,0,'C');
				        $pdf->Cell(20,6,$emprow['AH'],1,0,'C');
				        $pdf->Cell(40,6,$emprow['SW'],1,0,'C');
				        $pdf->Ln();
				        //$pdf->Cell(155,0,'','T');
				        //$pdf->Ln();
				        $total += $emprow['SW'];
				        $thrs += $emprow['AH'];
				        $rows += 1;
				        $name = $emprow['job'];

				}
				}
				catch(PDOException $e)
				{
				echo "Database Operations Failed: " . $e->getMessage();
				}
//$pdf->Cell(155,0,'','T');
$pdf->Ln(1);
$pdf->Cell(35,7,' ',0,0,'C');
$pdf->SetFillColor(238, 244, 66);
$fill = true;
$pdf->Cell(60,7,'Totals',1,0,'C',$fill);
$pdf->Cell(20,7,$thrs,1,0,'C',$fill);
$pdf->Cell(40,7,$total,1,0,'C',$fill);
$pdf->Ln(10);
$pdf->Cell(33,6,' ',0);
IF($rows == 0){
	$pdf->Cell(0,10,'No Data Found',0,1);
 }
 else{
 	$pdf->Cell(0,10,"You've currently made ".$total." dollars this year!" ,0,1);
}
$pdf->Output();
?>