<?php
	class poli{
		var $data;
		function __construct(){$this->data = new general();}
		public function log_in(){
			if ($_POST) {
				$user = $this->data->dato_user($_POST['user']);
				if ($user != '') {
					print_r($user);
					if ($user['nip'] == $_POST['ps']) {
						$_SESSION = $user;
					} else {
						$_SESSION['error'] = TRUE;
					}
				} else {
					$_SESSION['error'] = TRUE;
				}
				return HttpResponse('index.php/');
			} else {
				if ($_SESSION['nivel']) {
					$str_datos = file_get_contents("main/templates/complementos/apps.json");
    				$app = json_decode($str_datos,true);
    				$_SESSION['apps'] = $app[$_SESSION['nivel']];
    				return render_to_response(vista::page('principal.html',$ents));
				} else {
					return render_to_response(vista::index_log());
				}
				
				
			}
			
		}
		//-------------	
		public function url_p($url){
			global $url_array;
			$url_array = explode('/', $url);
			if (!$url_array[2]) {
				return $url;
			}elseif($url_array[1] == 'alumno' OR 
					$url_array[1] == 'maestro' OR 
					$url_array[1] == 'admon' OR
					$url_array[1] == 'empresa') {
					if ($url_array[1] == $_SESSION['tipo']) {
						return '/'.$url_array[1].'/'.$url_array[2].'/';
					}else{
						return '/denegado/';
					}
			}elseif ($url_array[1] == 'visitante') {
				return '/'.$url_array[1].'/'.$url_array[2].'/';
			}elseif($url_array[1] == 'perfil'){
				return $url;
			}else{
				return '404';
			}
		}
		public function distroy(){
			session_destroy();
			return HttpResponse('index.php/');
		}
		public function e404(){
			return render_to_response("404");
		}
		public function system_off(){
			return render_to_response("Sistema apagado");
		}
	}
?>