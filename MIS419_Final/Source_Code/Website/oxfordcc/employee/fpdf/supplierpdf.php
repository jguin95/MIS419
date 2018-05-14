<?php
$monthNum = $_POST['month'];
$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
require('fpdf.php');

class PDF extends FPDF
{
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
    $this->Cell(30,10,'Monthly Expense Report:',0,1,'C');
    // Line break
    //$this->Ln(5);   
}
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

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','I',15);
$pdf->Cell(0,10, $monthName ,0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',14);
$pdf->Cell(33,6,' ',0);
$pdf->Cell(0,10, 'Report Generated for: '.$_POST['fname'].' '.$_POST['lname'] ,0,1);
$pdf->Ln(5);
$pdf->Cell(35,7,' ',0,0,'C');
$pdf->Cell(50,7,'Supplier Name',1,0,'C');
$pdf->Cell(50,7,'Amount Owed',1,0,'C');
//$pdf->Cell(40,7,'Wage Cost',1,0,'C');
//$pdf->Cell(40,7,'Mat Cost',1,0,'C');
//$pdf->Cell(40,7,'Total Cost',1,0,'C');
$pdf->Ln();
//start test
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/oxfordcc/employee/eurm.php";
   include_once($path);

			try {
				$dbc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
				//preparing the sql statement
				$STH = $dbc->prepare("SELECT Vendor, SUM( MCost ) AS MC , MONTH( MPDate ) AS MPD
										FROM Materials
										GROUP BY Vendor
										HAVING MPD = :month");
				
				$STH->bindParam(':month', $_POST['month']);
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				$STH->execute();
				$rows = 0;
				//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
				while($emprow = $STH->fetch()) {
					$pdf->Cell(35,6,' ',0);
				        $pdf->Cell(50,6,$emprow['Vendor'],1,0,'C');
				        $pdf->Cell(50,6,$emprow['MC'],1,0,'C');
				        //$pdf->Cell(40,6,$emprow['SUM_WAGE'],'LR',0,'C');
				        //$pdf->Cell(40,6,$emprow['SUM_MAT'],'LR',0,'C');
				        //$tcost = $emprow['SUM_WAGE'] + $emprow['SUM_MAT']);
				       // $pdf->Cell(40,6,$emprow['TOTAL_COST'],'LR',0,'C');
				        //$pdf->Cell(40,6,$tcost,'LR',0,'C');
				        //$pdf->Ln();
				        //$pdf->Cell(100,0,'','T');
				        $pdf->Ln();
					//$thrs += $emprow['hours'];
					//$twages += $emprow['SUM_WAGE'];
					$tmat += $emprow['MC'];
				        //$total += $tcost;
				        $rows += 1;

				}
				}
				catch(PDOException $e)
				{
				echo "Database Operations Failed: " . $e->getMessage();
				}
//$pdf->Cell(100,0,'','T');
$pdf->Ln(1);
$pdf->Cell(35,6,' ',0);
$pdf->SetFillColor(238, 244, 66);
$fill = true;
$pdf->Cell(50,7,'Totals',1,0,'C',$fill);
//$pdf->Cell(20,7,$thrs,1,0,'C',$fill);
//$pdf->Cell(40,7,$twages,1,0,'C',$fill);
$pdf->Cell(50,7,$tmat,1,0,'C',$fill);
//$pdf->Cell(40,7,$total,1,0,'C',$fill);
$pdf->Ln(10);
IF($rows == 0){
	$pdf->Cell(0,10,'No Data Found',0,1);
 }
 else{
 	$pdf->Cell(33,6,' ',0);
 	$pdf->Cell(0,10,'Total amount owed to suppliers for '.$monthName.' is '.$tmat.' dollars.' ,0,1);
}
$pdf->Output();
?>