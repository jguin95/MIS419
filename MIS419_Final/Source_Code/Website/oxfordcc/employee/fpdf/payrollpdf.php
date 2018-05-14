<?php
$ddate = $_POST['week'];
$date = new DateTime($ddate);
$week = $date->format("W");
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
    $this->Cell(30,10,'Payroll Report:',0,1,'C');
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
$pdf->Cell(0,10, $ddate ,0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',14);
$pdf->Cell(33,7,' ',0,0,'C');
$pdf->Cell(0,10, 'Report Generated for: '.$_POST['fname'].' '.$_POST['lname'] ,0,1);
$pdf->Ln(1);
$pdf->Cell(35,7,' ',0,0,'C');
$pdf->Cell(50,7,'Employee Name',1,0,'C');
$pdf->Cell(20,7,'Hours',1,0,'C');
$pdf->Cell(40,7,'Wages',1,0,'C');
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
				$STH = $dbc->prepare("SELECT EFname, ELname, SS.Weeknum AS WN, SS.AH AS APP, SS.SW AS SMW
										FROM employees, (

										SELECT Employeeid, Weeknum, SUM( Approved_hrs ) AS AH, SUM( Wages ) AS SW
										FROM Hours
										GROUP BY Employeeid, Weeknum
										)SS
										WHERE employees.EmpID = SS.Employeeid
										AND SS.Weeknum = :week");
				
				$STH->bindParam(':week', $week);
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				$STH->execute();
				$rows = 0;
				//Puts each fetched element in the associative array into the table and puts links to edit or delete each record
				while($emprow = $STH->fetch()) {
					$pdf->Cell(35,7,' ',0,0,'C');
				        $pdf->Cell(50,6,$emprow['EFname'].' '.$emprow['ELname'],'LR');
				        $pdf->Cell(20,6,$emprow['APP'],'LR',0,'C');
				        $pdf->Cell(40,6,$emprow['SMW'],'LR',0,'C');
				        //$pdf->Cell(40,6,$emprow['SUM_MAT'],'LR',0,'C');
				        //$tcost = $emprow['SUM_WAGE'] + $emprow['SUM_MAT']);
				       // $pdf->Cell(40,6,$emprow['TOTAL_COST'],'LR',0,'C');
				        //$pdf->Cell(40,6,$tcost,'LR',0,'C');
				        $pdf->Ln();
				        //$pdf->Cell(190,0,'','T');
				        //$pdf->Ln();
					$thrs += $emprow['APP'];
					$twages += $emprow['SMW'];
					//$tmat += $emprow['SMW'];
				        //$total += $tcost;
				        $rows += 1;

				}
				}
				catch(PDOException $e)
				{
				echo "Database Operations Failed: " . $e->getMessage();
				}
//$pdf->Cell(190,0,'','T');
$pdf->Ln(1);
$pdf->SetFillColor(238, 244, 66);
$pdf->Cell(35,7,' ',0,0,'C');
$fill = true;
$pdf->Cell(50,7,'Totals (Before Taxes)',1,0,'C',$fill);
$pdf->Cell(20,7,$thrs,1,0,'C',$fill);
$pdf->Cell(40,7,$twages,1,0,'C',$fill);
//$pdf->Cell(40,7,$tmat,1,0,'C',$fill);
//$pdf->Cell(40,7,$total,1,0,'C',$fill);
$pdf->Ln(10);
IF($rows == 0){
	$pdf->Cell(0,10,'No Data Found',0,1);
 }
 else{
 	//$pdf->Cell(33,7,' ',0,0,'C');
 	$pdf->Cell(0,10,'Total amount owed to employees in week '.$week.' ('.$ddate.') is '.$twages.' dollars.' ,0,1);
 	//$pdf->Cell(35,7,' ',0,0,'C');
	//$pdf->Cell(0,10,'(Before Taxes)' ,0,1);
}
$pdf->Output();
?>