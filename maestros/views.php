<?php
	require_once('main/templates/complementos/fpdf/fpdf.php');
	class vista_M 
	{
		public function principal_view()
		{
			$valores = [
			'Title' => "[title_ci]",
			'container' => dinamic("maestros/static/principal.html")
			];
			$templad = load_page("general/page.html");
			$mostrar = remplas($valores,$templad);
			view_page($mostrar);
		}
		public function intermedia()
		{
			$valores = [
			'Title' => "[title_ci]",
			'container' => dinamic("maestros/static/materias.php")
			];
			$templad = load_page("general/page.html");
			$mostrar = remplas($valores,$templad);
			view_page($mostrar);
		}
		public function alumnos()
		{
			$valores = [
			'Title' => "[title_al]",
			'container' => dinamic("maestros/static/alumnos.php")
			];
			$templad = load_page("general/page.html");
			$mostrar = remplas($valores,$templad);
			view_page($mostrar);
		}
	}
	class PDF extends FPDF
	{	
		var $carrera;
		var $materia;
		function __construct($a,$b)
		{
			parent::__construct();
			$this->carrera = $a;
			$this->materia = $b;
		}
		function Header()
   		{
   			$this->Image('main/templates/complementos/img/escudoudg.jpg' , 2 ,2, 35 , 38,'JPG');
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
			$this->Cell(17,5,'2014 A',0,0,'C');
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
			$this->Cell(120,5,utf8_encode($_SESSION['nombre']),0,0,'C');
			$this->Ln();
			$this->Ln();
   		}
	}
?>