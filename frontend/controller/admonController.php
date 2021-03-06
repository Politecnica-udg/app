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
			$datos["clas"] = $this->data->classTotal();
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
		public function saveAsis(){
			$datos = $_GET;
			$this->data->saveAsis($datos);
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
			$pdf->SetMargins(-1,5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,5,'Total de clases: ' . $_GET['tcl'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(10);
			$pdf->Cell(17,7,'PROG',1,0,'C');
			$pdf->Cell(90,7,'NOMBRE DEL ALUMNO',1,0,'C');
			$pdf->Cell(25,7,'CODIGO',1,0,'C');
			$pdf->Cell(25,7,'ASISTENCIAS',1,0,'C');
			$pdf->Cell(15,7,'FALTAS',1,0,'C');
			$pdf->Cell(20,7,'CALIF.',1,0,'C');
			$pdf->SetFont('Arial','',10);
			foreach ($dato as $key => $value) {
				$pdf->Ln();
				$pdf->Cell(10);
				$pdf->Cell(17,5,$key+1,1,0,'C');
				$pdf->Cell(90,5,utf8_encode($value['nom_ubi']),1,0);
				$pdf->Cell(25,5,$value['cod_ev'],1,0,'C');
				$pdf->Cell(25,5,$value['tasis_int_ev'],1,0,'C');
				$pdf->Cell(15,5,$value['tfal_int_ev'],1,0,'C');
				$pdf->Cell(20,5,$value['cal_int_ev'],1,0,'C');
			}
			$pdf->Output();
		}
		public function saveFAM(){
			$this->data->saveFAM($_POST);
			return httpResponse("index.php/");
		}
		public function autEMV(){
			if($this->data->autEMV($_SESSION['codigo'])){
				return httpResponse("index.php/autEMM");
			}else{
				return httpResponse("index.php/autEM");
			}
		}
		public function empInfo(){
			return jsonResponse($this->data->empInfo());
		}
		public function eSaveEm(){
			$dat = jsonPOST();
			return jsonResponse($this->data->eSaveEm($dat));
		}
		public function soliIn(){
			global $url_array;
			$dat = $this->data->soliIn($url_array[2]);
			foreach ($dat as $key => $value) {
				switch ($value['sexo_em']) {
					case '0':
						$dat[$key]['sexo_na'] = "Indefinido";
					break;
					case '1':
						$dat[$key]['sexo_na'] = "Hombre";
						break;
					case '2':
						$dat[$key]['sexo_na'] = "Mujer";
						break;
				}
			}
			return jsonResponse($dat);
		}
		public function eSaveSo(){
			$dat = jsonPOST();
			return jsonResponse($this->data->eSaveSo($dat));
		}
		public function quitAl(){
			global $url_array;
			return jsonResponse($this->data->quitAl($url_array[2]));
		}
		public function deleteEm(){
			global $url_array;
			return jsonResponse($this->data->deleteEm($url_array[2]));
		}
		public function EmSave(){
			$dat = jsonPOST();
			return jsonResponse($this->data->EmSave($dat));
		}
		public function SaveSo(){
			$dat = jsonPOST();
			return jsonResponse($this->data->SaveSo($dat));
		}
		public function delePl(){
			global $url_array;
			return jsonResponse($this->data->delePl($url_array[2]));
		}
	}
?>
