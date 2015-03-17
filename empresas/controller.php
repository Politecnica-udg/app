<?php
	class empresas {
		var $view;
		var $data;
		function __construct()
		{
			$this->data = new general_E();
			$this->view = new vista_E();	
		}
		public function registro()
		{
			
			if ($_POST) {
				$this->data->guardar_prem($_POST);
				return render_to_response($this->view->gen_static('contacto.html'));
			}else{
				return render_to_response($this->view->gen_static('formulario.html'));
			}	
		}
		public function adiestramientos()
		{
			global $url_array;
			$datos=$this->data->consulta1_ad();
			if ($datos['acuerdo'] == 0) {
				if($_POST['acep']){
					$this->data->agregar($datos['id']);
					return HttpResponse('index.php/empresa/adiestramientos/');
				}else{
					return render_to_response($this->view->gen_s('acuerdo.html'));
				}
			}else{
				if ($url_array[3]) {
					$dat = $this->data->listar($url_array[3]);
					$dat['cantidad'] = $this->data->contar($url_array[3]);
					return render_to_response($this->view->gen_s('lista.html',$dat));
				}else{
					if ($_POST) {
						$this->data->sum($_POST['carre'],$datos['id']);
						$this->data->agre($_POST);
						return HttpResponse('index.php/empresa/adiestramientos/');
					}else{
						$datoq = $this->data->consultas();
						$dato = array('QTA' => $datoq['QTA'],
									  'QTI' => $datoq['QTI'],
									  'QTME' => $datoq['QTME'],
									  'QTP' => $datoq['QTP'],
									  'TEI' => $datoq['TEI'],
									  'TF' => $datoq['TF'],
									  'TMI' => $datoq['TMI'],
									  'TPI' => $datoq['TPI'],
									  'total' => $datoq['total'] );
						return render_to_response($this->view->gen_s('solicitar.html',$dato));
					}
				}
			}
		}
	}
?>