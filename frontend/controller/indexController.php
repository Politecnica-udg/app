<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/indexModel.php';
	class index{
		var $data;
		function __construct(){$this->data = new model_index();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::page($html.'.html'));
		}
		public function inicio(){
			if ($_SESSION) {
				$str_datos = file_get_contents("assets/complementos/apps.json");
    			$app = json_decode($str_datos,true);
    			$_SESSION['apps'] = $app[$_SESSION['nivel']];
				return renderResponse(viewTemplad::page("principal.html"));
			}else{
				return renderResponse(viewTemplad::white("login.html"));
			}
		}
		public function log(){
			$datos = $_GET;
			$dat = $this->data->userData($datos['user']);
			if ($dat['nip'] == $datos['ps']) {
				$_SESSION = $dat;
				return jsonResponse(["estado" =>"true"]);
			}
			return jsonResponse(["estado" =>"false"]);
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
				file_put_contents("assets/complementos/apps.json", $json);
				return HttpResponse('index.php/app_admin');
			}else{
				$str_datos = file_get_contents("assets/complementos/apps.json");
    			$app['user'] = json_decode($str_datos,true);
    			$app['app'] = [ 0 => "eval_grup",
    						1 => "lis_maestos",
							2 => "alum_e",
							3 => "app_admin",
							4 => "autEM"];
				return renderResponse(viewTemplad::pageChosen('adapp.html',$app));
			}
		}
		public function pwNew(){
			$dat = jsonPOST();
			$this->data->pwNew($dat['pw'],$dat['id']);
		}
	}
?>