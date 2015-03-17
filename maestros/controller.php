<?php
	class maestros
	{
		var $view;
		var $data;
		function __construct()
		{
			$this->data = new general_M();
			$this->view = new vista_M();
		}
		public function principal()
		{
			$this->view->principal_view();
		}
		public function lista()
		{
			$GLOBALS = $this->data->materias();
			$this->view->intermedia();
		}
		public function evaluar()
		{
			$GLOBALS = $this->data->datos();
			$this->view->alumnos();
		}
		public function grabar()
		{
			header("Location: index.php?tipo=maestro");
			for ($i=0; $i < $_POST['cantidad']; $i++) {
				$var = ['cod' => $_POST['cod'.$i],
					'cal' => $_POST['cal'.$i],
					'fal' => $_POST['fal'.$i],
					'car'=> $_GET['c'],
					'mat' => $_GET['m'],
					'class' => $_POST['asistencias']
				];
				$this->data->guardar($var);
			}
			$this->data->marcar();
		}
		public function cerrar()
		{
			header("Location: index.php?tipo=maestro");
			for ($i=0; $i < $_POST['cantidad']; $i++) {
				$var = ['cod' => $_POST['cod'.$i],
					'cal' => $_POST['cal'.$i],
					'fal' => $_POST['fal'.$i],
					'car'=> $_GET['c'],
					'mat' => $_GET['m']
				];
				$this->data->guardar($var);
			}
			$this->data->bloquear();
		}
		public function pdf_repin()
		{
			$carr=$this->data->carrera($_GET['c']);
			$mat=$this->data->mat($_GET['m']);
			$dato=$this->data->grupo();
			$pdf = new PDF($carr,$mat);
			$pdf->AddPage();
			$pdf->SetMargins(5,5);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(10);
			$pdf->Cell(17,7,'PROG',1,0,'C');
			$pdf->Cell(90,7,'NOMBRE DEL ALUMNO',1,0,'C');
			$pdf->Cell(25,7,'CODIGO',1,0,'C');
			$pdf->Cell(15,7,'FALTAS',1,0,'C');
			$pdf->Cell(30,7,'CALIFICACION',1,0,'C');
			$pdf->SetFont('Arial','',10);
			foreach ($dato as $key => $value) {
				$pdf->Ln();
				$pdf->Cell(10);
				$pdf->Cell(17,5,$key+1,1,0,'C');
				$pdf->Cell(90,5,utf8_encode($value['nom_ubi']),1,0,'C');
				$pdf->Cell(25,5,$value['cod_ev'],1,0,'C');
				$pdf->Cell(15,5,$value['tfal_int_ev'],1,0,'C');
				$pdf->Cell(30,5,$value['cal_int_ev'],1,0,'C');
			}
			$pdf->Output();
		}
	}
?>