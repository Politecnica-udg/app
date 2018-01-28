<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/studenModel.php';
	class studen{
		var $data;
		function __construct(){$this->data = new model_studen();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::studen($html.'.html'));
		}
		public function materias_Al(){
			global $conf_poli;
			$mat = $this->data->clases($conf_poli['cal_prof']);
			return jsonResponse($mat);
		}
		public function preguntasSave(){
			$data = $this->data->info($_POST['materia']);
				$array[0] += $_POST['1-1'];
				$array[0] += $_POST['1-2'];
				$array[0] += $_POST['1-3'];
				$array[0] += $_POST['1-4'];
				$array[0] += $_POST['1-5'];
				$array[0] /=5;
				$array[1] += $_POST['2-1'];
				$array[1] += $_POST['2-2'];
				$array[1] += $_POST['2-3'];
				$array[1] += $_POST['2-4'];
				$array[1] /=4;
				$array[2] += $_POST['3-1'];
				$array[2] += $_POST['3-2'];
				$array[2] += $_POST['3-3'];
				$array[2] += $_POST['3-4'];
				$array[2] /=4;
				$array[3] += $_POST['4-1'];
				$array[3] += $_POST['4-2'];
				$array[3] += $_POST['4-3'];
				$array[3] /=3;
				$array[4] += $_POST['5-1'];
				$array[4] += $_POST['5-2'];
				$array[4] /=2;
				$array[5] += $_POST['6-1'];
				$array[5] += $_POST['6-2'];
				$array[5] /=2;
				$array[6] = $_POST['com'];
				$data = $this->data->grabar($data,$array);
				return HttpResponse('index.php/alum_e/');
		}
		public function el_emp(){
			$dat = $this->data->inf_Al($_SESSION['codigo']);
			if ($dat['datos_c'] != 0) {
				$d = $this->data->inf_soli($_SESSION['codigo']);
				if ($d) {
					return HttpResponse('index.php/cita');
				}else{
					return HttpResponse('index.php/catalogo');
				}
			}else{
				return HttpResponse("index.php/info_em");
			}
		}
		public function saveInfo(){
			if ($this->data->saveInfo($_POST)) {
				return HttpResponse("index.php/el_emp");
			}
		}
		public function catalogo(){
			$info_al = $this->data->info_al($_SESSION['codigo']);
			$dat = $this->data->catalogo($info_al['abr_car']);
			$_SESSION['carr'] = $info_al['abr_car'];
			return renderResponse(viewTemplad::studen('catalogo.html',$dat));
		}
		public function ele_em(){
			global $url_array;
			global $conf_poli;
			$inf_e 		= $this->data->inf_em($url_array[2]);
			$promedio 	= $this->data->cali_al();
			$sex		= $this->data->sexo();
			if ($sex['sexo'] == 'mujer') {
				$inf_e['soli'] = $this->data->solici_lista($url_array[2],1);
			}else{
				$inf_e['soli'] = $this->data->solici_lista($url_array[2],2);
			}
					$fecha = date("Y/m/d/H/i/s");
					if ($fecha >= $conf_poli['elecion']."/08/00/01" && $promedio[0] >= 98) {
						$_SESSION['elegir'] = TRUE;  
					}elseif ($fecha >= $conf_poli['elecion']."/08/30/01" && $promedio[0] >= 95) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/09/00/01" && $promedio[0] >= 92) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/09/30/01" && $promedio[0] >= 89) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/10/00/01" && $promedio[0] >= 86) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/10/30/01" && $promedio[0] >= 83) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/11/00/01" && $promedio[0] >= 80) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/11/30/01" && $promedio[0] >= 77) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/12/00/01" && $promedio[0] >= 74) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/12/30/01" && $promedio[0] >= 71) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/13/00/01" && $promedio[0] >= 68) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/13/30/01" && $promedio[0] >= 65) {
						$_SESSION['elegir'] = TRUE;
					}elseif ($fecha >= $conf_poli['elecion']."/14/00/01" && $promedio[0] >= 60) {
						$_SESSION['elegir'] = TRUE;
					}else{
						$_SESSION['elegir'] = FALSE;
					}
			return renderResponse(viewTemplad::studen('info_e.html',$inf_e));
		}
		public function save_inf(){
			global $url_array;
			$this->data->save_inf($url_array[2]);
			return HttpResponse("index.php/el_emp");
		}
		public function cita(){
			return renderResponse(viewTemplad::studen('info_cita.html',$dat));
		}
		public function listaCartas(){
			$d = $this->data->listaCartas();
			require_once 'assets/complementos/pdf.php';
			$pdf = new vinculacion();
			foreach ($d as $key => $value) {
				$dat = $this->data->infoRepo($value['codigo_a']);
				if ($dat != null) {
					$pdf->AddPage();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,4,".",0,2);
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Cell(20,4,'Empresa: '.$dat['name_e'],0,2);
					$pdf->Cell(32,4,'Representante: '.$dat['name_en'],0,2);
					$pdf->Cell(15,4,'Cargo: '.$dat['cargo'],0,2);
					$pdf->Ln();
					$pdf->SetFont('Arial','',10);
					$pdf->MultiCell(160,4, utf8_decode("Agradecemos la oportunidad brindada por su empresa al concedernos plazas para los alumnos de la Escuela Politécnica Guadalajara, estamos seguros que los educandos al tener la oportunidad de estar en contacto con el campo en el ejercicio profesional afín a su carrera, lograrán la retroalimentación del conocimiento que los llevará al aprendizaje significativo."),0,'J');
					$pdf->Ln();
					$pdf->MultiCell(160,4, utf8_decode("Aprovechamos el comunicado para informarles que en el mes de marzo o abril, se aplica la Prueba Planea, en las instalaciones de la Escuela Politécnica Guadalajara, la cual es OBLIGATORIA para todos los alumnos de octavo semestre. Por lo que solicitamos se les permita ausentarse de sus labores durante los días que se aplique dicha prueba."),0,'J');
					$pdf->Ln();
					$pdf->MultiCell(160,4, utf8_decode("El C.".utf8_decode($dat['name']).", es el estudiante asignado a su empresa para la realización de las Prácticas Profesionales, las cuales inician el 23 de febrero al ".$dat['dia_fin']." de mayo de 2017 con una carga de ".$dat['horas']."hrs. totales, asistiendo de lunes a viernes cuatro horas diarias; la asignación de horario será determinado por la empresa en acuerdo con el alumno."),0,'J');
					$pdf->Ln();
					$pdf->SetFillColor(192, 192, 192);
					$pdf->Cell(160,5,utf8_decode("DATOS ESCOLARES"),1,2,'C',true);
					$pdf->Cell(20,5,utf8_decode("Código"),1,0,'R',true);
					$pdf->Cell(140,5,utf8_decode($dat['codigo_a']),1,1,'C');
					$pdf->Cell(20,5,utf8_decode("Nombre"),1,0,'R',true);
					$pdf->Cell(140,5,utf8_decode($dat['name']),1,1,'C');
					$pdf->Cell(20,5,utf8_decode("Carrera"),1,0,'R',true);
					$pdf->Cell(140,5,utf8_decode($dat['nom_car']),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("Grado"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode("8"),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Grupo"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['gpo_ubi']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Turno"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['tno_ubi']),1,1,'C');
					$pdf->Cell(160,5,utf8_decode("DATOS GENERALES"),1,1,'C',true);
					$pdf->Cell(35,5,utf8_decode("Domicilio"),1,0,'R',true);
					$pdf->Cell(125,5,utf8_decode($dat['domicilio_a']),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("Colonia"),1,0,'R',true);
					$pdf->Cell(75,5,utf8_decode($dat['colonia_a']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("C.P."),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['cp_a']),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("Municipio"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode(strtolower($dat['municipio'])),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Estado"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['estado']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Teléfono"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['telp_a']),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("Móvil"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['telc_a']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("E-mail"),1,0,'R',true);
					$pdf->Cell(75,5,utf8_decode(strtolower($dat['email_a'])),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("Teléfono Emergencia"),1,0,'R',true);
					$pdf->Cell(125,5,utf8_decode($dat['telc_p']),1,1,'C');
					$pdf->Cell(35,5,utf8_decode("NSS"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['imss']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Edad"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['edad']),1,0,'C');
					$pdf->Cell(25,5,utf8_decode("Nacionalidad"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode("Mexicana"),1,1,'C');
					$pdf->Cell(160,5,utf8_decode("DATOS FAMILIARES"),1,1,'C',true);
					$pdf->Cell(42,5,utf8_decode("Nombre del Tutor"),1,0,'R',true);
					$pdf->Cell(73,5,utf8_decode($dat['name_p']),1,0,'C');
					$pdf->Cell(20,5,utf8_decode("Teléfono"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['telc_p']),1,1,'C');
					$pdf->Cell(42,5,utf8_decode("Nombre de otro Contacto"),1,0,'R',true);
					$pdf->Cell(73,5,utf8_decode($dat['name_o']),1,0,'C');
					$pdf->Cell(20,5,utf8_decode("Teléfono"),1,0,'R',true);
					$pdf->Cell(25,5,utf8_decode($dat['telc_o']),1,1,'C');
					$pdf->Ln();
					$pdf->MultiCell(160,4, utf8_decode("Sin otro particular, me despido de usted reiterándole mi más atenta y distinguida consideración."),0,'J');
					$pdf->Ln();
					$pdf->Cell(25,4,utf8_decode("A t e n t a m e n t e"),0,1);
					$pdf->Cell(25,4,utf8_decode("\"Piensa y Trabaja\""),0,1);
					$pdf->Cell(25,4,utf8_decode("Guadalajara, Jalisco a ".date("d")." de Enero de ".date("Y")."."),0,1);
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Cell(25,4,utf8_decode("Gilberto Simón Guevara Galindo"),0,1);
					$pdf->Cell(25,4,utf8_decode("Coordinador de Carrera"),0,1);
					$pdf->Ln();
				}
			}
			$pdf->Output();
		}
		function vinculacion(){
			global $url_array;
			require_once 'assets/complementos/pdf.php';
			$dat = $this->data->infoRepo($url_array[2]);
			$pdf = new vinculacion();
			$pdf->AddPage();
			$pdf->SetMargins(37,5);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(20,4,".",0,2);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(20,4,'Empresa: '.$dat['name_e'],0,2);
			$pdf->Cell(32,4,'Representante: '.$dat['name_en'],0,2);
			$pdf->Cell(15,4,'Cargo: '.$dat['cargo'],0,2);
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(160,4, utf8_decode("Agradecemos la oportunidad brindada por su empresa al concedernos plazas para los alumnos de la Escuela Politécnica Guadalajara, estamos seguros que los educandos al tener la oportunidad de estar en contacto con el campo en el ejercicio profesional afín a su carrera, lograrán la retroalimentación del conocimiento que los llevará al aprendizaje significativo."),0,'J');
			$pdf->Ln();
			$pdf->MultiCell(160,4, utf8_decode("Aprovechamos el comunicado para informarles que, en el mes de marzo o abril, se aplica la Prueba Planea, y los días 23 y 24 de marzo la Expolinova, en las instalaciones de la Escuela Politécnica Guadalajara, la cual es OBLIGATORIA para todos los alumnos de octavo semestre. Por lo que solicitamos se les permita ausentarse de sus labores durante los días que se aplique dichos eventos antes mencionados."),0,'J');
			$pdf->Ln();
			$pdf->MultiCell(160,4, utf8_decode("El C.".utf8_decode($dat['name']).", es el estudiante asignado a su empresa para la realización de las Prácticas Profesionales, las cuales inician el ".$dat['dia_ini']." de febrero al 14 de mayo de 2018 con una carga de ".$dat['horas']."hrs. totales, asistiendo de lunes a viernes cuatro horas diarias; la asignación de horario será determinado por la empresa en acuerdo con el alumno."),0,'J');
			$pdf->Ln();
			$pdf->SetFillColor(192, 192, 192);
			$pdf->Cell(160,5,utf8_decode("DATOS ESCOLARES"),1,2,'C',true);
			$pdf->Cell(20,5,utf8_decode("Código"),1,0,'R',true);
			$pdf->Cell(140,5,utf8_decode($dat['codigo_a']),1,1,'C');
			$pdf->Cell(20,5,utf8_decode("Nombre"),1,0,'R',true);
			$pdf->Cell(140,5,utf8_decode($dat['name']),1,1,'C');
			$pdf->Cell(20,5,utf8_decode("Carrera"),1,0,'R',true);
			$pdf->Cell(140,5,utf8_decode($dat['nom_car']),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("Grado"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode("8"),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Grupo"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['gpo_ubi']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Turno"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['tno_ubi']),1,1,'C');
			$pdf->Cell(160,5,utf8_decode("DATOS GENERALES"),1,1,'C',true);
			$pdf->Cell(35,5,utf8_decode("Domicilio"),1,0,'R',true);
			$pdf->Cell(125,5,utf8_decode($dat['domicilio_a']),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("Colonia"),1,0,'R',true);
			$pdf->Cell(75,5,utf8_decode($dat['colonia_a']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("C.P."),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['cp_a']),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("Municipio"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode(strtolower($dat['municipio'])),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Estado"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['estado']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Teléfono"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['telp_a']),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("Móvil"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['telc_a']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("E-mail"),1,0,'R',true);
			$pdf->Cell(75,5,utf8_decode(strtolower($dat['email_a'])),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("Teléfono Emergencia"),1,0,'R',true);
			$pdf->Cell(125,5,utf8_decode($dat['telc_p']),1,1,'C');
			$pdf->Cell(35,5,utf8_decode("NSS"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['imss']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Edad"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['edad']),1,0,'C');
			$pdf->Cell(25,5,utf8_decode("Nacionalidad"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode("Mexicana"),1,1,'C');
			$pdf->Cell(160,5,utf8_decode("DATOS FAMILIARES"),1,1,'C',true);
			$pdf->Cell(42,5,utf8_decode("Nombre del Tutor"),1,0,'R',true);
			$pdf->Cell(73,5,utf8_decode($dat['name_p']),1,0,'C');
			$pdf->Cell(20,5,utf8_decode("Teléfono"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['telc_p']),1,1,'C');
			$pdf->Cell(42,5,utf8_decode("Nombre de otro Contacto"),1,0,'R',true);
			$pdf->Cell(73,5,utf8_decode($dat['name_o']),1,0,'C');
			$pdf->Cell(20,5,utf8_decode("Teléfono"),1,0,'R',true);
			$pdf->Cell(25,5,utf8_decode($dat['telc_o']),1,1,'C');
			$pdf->Ln();
			$pdf->MultiCell(160,4, utf8_decode("Sin otro particular, me despido de usted reiterándole mi más atenta y distinguida consideración."),0,'J');
			$pdf->Ln();
			$pdf->Cell(25,4,utf8_decode("A t e n t a m e n t e"),0,1);
			$pdf->Cell(25,4,utf8_decode("\"Piensa y Trabaja\""),0,1);
			$pdf->Cell(25,4,utf8_decode("Guadalajara, Jalisco a ".date("d")." de Enero de ".date("Y")."."),0,1);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(25,4,utf8_decode("Ing. Gilberto Simón Guevara Galindo"),0,1);
			$pdf->Cell(25,4,utf8_decode("Coordinador de Carrera"),0,1);
			$pdf->Ln();
			$pdf->Output();
		}
	}
?>