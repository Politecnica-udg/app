<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/indexModel.php';
	class index{
		var $data;
		function __construct(){$this->data = new model_index();}
		public function inicio(){
			if ($_SESSION) {
				$str_datos = file_get_contents("frontend/assets/complementos/apps.json");
    			$app = json_decode($str_datos,true);
    			$_SESSION['apps'] = $app[$_SESSION['nivel']];
				return renderResponse(viewTemplad::page("principal.html"));
			}else{
				return renderResponse(viewTemplad::white("login.html"));
			}
		}
		public function log(){
			$datos = jsonPOST();
			$dat = $this->data->userData($datos['user']);
			if ($dat['nip'] == $datos['ps']) {
				$_SESSION = $dat;
				return jsonResponse(["estado" =>true]);
			}
			return jsonResponse(["estado" =>false]);
		}
		public function e404(){
			return renderResponse(viewTemplad::white("404.html"));
		}
		public function destroy(){
			session_destroy();
			return HttpResponse('index.php/');
		}
		public function app_admin(){
			if ($_POST) {
				$json = json_encode($_POST);
				file_put_contents("frontend/assets/complementos/apps.json", $json);
				return HttpResponse('index.php/app_admin');
			}else{
				$str_datos = file_get_contents("frontend/assets/complementos/apps.json");
    			$app['user'] = json_decode($str_datos,true);
    			$app['app'] = [ 0 => "cali",
    						1 => "eval_grup",
    						2 => "lis_maestos",
    						3 => "lis_calit",
    						4 => "eval_grups",
    						5 => "adiestramientos",
    						6 => "btrabajo",
							7 => "alum_e",
							8 => "cita",
							9 => "vae",
							10 => "im_evaa",
							11 => "vbt",
							12 => "app_admin",
							13 => "ips",
							14 => "ipsR",
							15 => "lis_grupo"];
				return renderResponse(viewTemplad::pageChosen('adapp.html',$app));
			}
		}
	}
?>