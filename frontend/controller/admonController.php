<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/admonModel.php';
	class admon{
		var $data;
		function __construct(){$this->data = new model_admon();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::admon($html.'.html'));
		}
		public function datosMaestros(){
			$datos = $this->data->datosMaestros();
			return jsonResponse($datos);
		}
		public function datosGrupos(){
			global $url_array;
			if ($url_array[2] != 'undefined') {
				$cod = $url_array[2];
			}else{
				$cod = $_SESSION['codigo'];
			}
			$datos = $this->data->datosGrupos($cod);
			return jsonResponse($datos);
		}
		public function datAl(){
			$datos["alumnos"] = $this->data->datosAl();
			$datos["clas"] = $datos["alumnos"][0]["tclas_int_ev"];
			return jsonResponse($datos);
		}
		public function saveCal(){
			$datos = $_GET;
			$this->data->saveCal($datos);
		}
		public function saveFal(){
			$datos = $_GET;
			$this->data->saveFal($datos);
		}
		public function grabarM(){
			$datos = $_GET;
			$this->data->grabar($datos['op']);
		}
		public function pdf_M(){
			global $conf_poli;
			require_once 'assets/complementos/pdf.php';
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
		public function saveFAM(){
			$this->data->saveFAM($_POST);
			return httpResponse("index.php/");
		}
	}
?>