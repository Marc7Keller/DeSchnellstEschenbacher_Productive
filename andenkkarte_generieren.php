<?php


include("php/config.php");
include("includes/sessions.php");
include("fpdf/fpdf.php"); 


class PDF extends FPDF {
    // Kopfzeile
    function Header(){

        
    } 

    // Fusszeile
    function Footer(){



    }
}

$pdf=new PDF(); 



//foreach ($_POST['kategorie'] as &$value) {
//    $sql= "SELECT * FROM category where fs_event = ".$_SESSION['event']." AND category_id = ".$value.";";
//    $res = mysqli_query($db,$sql);
//    if(mysqli_num_rows($res) >= 1){
//        $row = mysqli_fetch_array($res);
//        $category_name = $row['category_name'];
//        
//        $pdf->AddPage(); 
//        
//        $pdf->Cell(80);
//        $pdf->SetFont('Arial','B',14);
//        $pdf->Cell(30,10,"Kategorie: ".$row['category_name']." Distanz: ".$row['track_length'],0,0,'C');
//        $pdf->Ln(9);


   $sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event'].";";
        //$sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
        $res = mysqli_query($db,$sql);
       
        $rang = 1;
        while($row = mysqli_fetch_array($res)){
            $pdf->AddPage('L','A5'); 
             $pdf->SetFont('Arial','B',30);
            $pdf->Ln(70);
            $pdf->Cell(30,10,'',0,0,'C');
            $pdf->Cell(60,10,$row['name']." ".$row['firstname'],0,0,'A');
            $pdf->Ln(9);
            $pdf->SetFont('Arial','',24);
            $pdf->Cell(30,10,'',0,0,'C');
            $pdf->Cell(15,10,'Zeit: '.$row['first_lap']. ' Sekunden',0,0,'A');
            if($row['second_lap'] != NULL){
                $pdf->Ln(9);
                $pdf->Cell(30,10,'',0,0,'C');
                $pdf->Cell(40,10,'Finallauf: '.$row['second_lap']. ' Sekunden',0,0,'A');
            }
            
            $pdf->Image('_img/deschnellsteschenbacher_logo.png',100,20,70);
            
            //$pdf->Cell(30,10,$row['first_lap'],0,0,'A');
            //$pdf->Cell(30,10,$row['second_lap'],0,0,'A');
            $pdf->Ln(7);
            $rang++;
        }

    //}
//}



$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>