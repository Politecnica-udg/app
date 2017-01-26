<?php
	require 'assets/complementos/fpdf/fpdf.php';
	class pdf extends FPDF {
		var $carrera;
		var $materia;
		var $ciclo;
		function __construct($a,$b,$c){
			parent::__construct();
			$this->carrera = $a;
			$this->materia = $b;
			$this->ciclo = $c;
		}
		public function Header(){
   			$this->Image('assets/complementos/img/escudoudg.jpg' , 2 ,2, 35 , 38,'JPG');
			$this->SetFont('Arial','B',12);
			$this->Cell(30);
			$this->Cell(22,3,'CICLO');
			$this->Cell(70,3,'DEPENDENCIA',0,0,'C');
			$this->Cell(20,3,'GDO');
			$this->Cell(20,3,'GPO');
			$this->Cell(20,3,'TURNO');
			$this->Ln();
			$this->SetFont('Arial','',10);
			$this->Cell(30);
			$this->Cell(17,5,$this->ciclo,0,0,'C');
			$this->Cell(70,5,'ESCUELA POLITECNICA GUADALAJARA',0,0,'C');
			$this->Cell(20,5,$_GET['g'],0,0,'C');
			$this->Cell(20,5,$_GET['gr'],0,0,'C');
			$this->Cell(20,5,$_GET['t'],0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','B',12);
			$this->Cell(30);
			$this->Cell(125,5,'CARRERA',0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','',10);
			$this->Cell(30);
			$this->Cell(125,5,$this->carrera['nom_car'],0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','',12);
			$this->Cell(30);
			$this->Cell(120,10,$this->materia['nom_pes'],0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','',10);
			$this->Cell(30);
			$this->Cell(20,5,$_SESSION['codigo'],0,0,'C');
			$this->Cell(120,5,$_SESSION['nombre'],0,0,'C');
			$this->Ln();
			$this->Ln();
   		}
	}
	class vinculacion extends FPDF {
		function __construct(){
			parent::__construct();
		}
		public function Header(){
			$this->Image('assets/complementos/img/cabecera.jpg', 1, 1, 215, 35,'JPG');
			$this->SetFont('Arial','I',12);
			$this->Cell(27,10,"",0,2);
			$this->Cell(27,5,"",0);
			$this->Cell(50,5,'ESCUELA POLIT'.utf8_decode("É").'CNICA',0,2);
			$this->Cell(55,5,"COORDINACION DE CARRERA",0,2);
			$this->Cell(55,5,"VINCULACION",0,2);
		}
		public function Footer(){
			$this->SetFont('Arial','I',7);
			$this->Cell(0,3,utf8_decode("Av. Revolución No. 1500, Sector Reforma, C.P. 44420"),0,2,'C');
			$this->Cell(0,3,utf8_decode("Guadalajara, Jalisco, México. Tel. fax. (33) 36199814/36198315 Ext. 120"),0,2,"C");
			$this->SetFont('Arial','B',7);
			$this->Cell(0,3,utf8_decode("http://politécnica.sems.udg.mx"),0,2,"C");
		}
	}
?>