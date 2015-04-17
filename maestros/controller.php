<?php
	class maestros{
		var $data;
		function __construct(){$this->data = new general_M();}
		public function eval_grup(){
			if ($_POST) {
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
				if ($_POST['p']) {
					$this->data->bloquear();
				} else {
					$this->data->marcar();
				}
				return HttpResponse('index.php/');
			} elseif ($_GET) {
				$grup = $this->data->datos();
				return render_to_response(vista_M::page('alumnos.html',$grup));
			} else {
				$mat = $this->data->materias();
				return render_to_response(vista_M::page('materias.html',$mat));
			}			
		}
		public function pdf_M(){
			global $conf_poli;
			require_once 'main/templates/complementos/pdf.php';
			$carr=$this->data->carrera($_GET['c']);
			$mat=$this->data->mat($_GET['m']);
			$dato=$this->data->grupo();
			$pdf = new PDF($carr,$mat,$conf_poli['cal_prof']);
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
				$pdf->Cell(90,5,utf8_encode($value['nom_ubi']),1,0);
				$pdf->Cell(25,5,$value['cod_ev'],1,0,'C');
				$pdf->Cell(15,5,$value['tfal_int_ev'],1,0,'C');
				$pdf->Cell(30,5,$value['cal_int_ev'],1,0,'C');
			}
			$pdf->Output();
		}
	}
?>