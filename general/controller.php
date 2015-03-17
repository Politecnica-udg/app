<?php
	class poli{
		var $data;
		function __construct()
		{
			$this->data = new general();
		}
		public function log_in(){
			if($_SESSION['tipo']){
				$str_datos = file_get_contents("main/templates/complementos/apps.json");
      				$lang = json_decode($str_datos,true);
      				$_SESSION['apps'] = array_merge($lang[$_SESSION['nivel']],$lang['general']);
      				return render_to_response(vista::principal());
			}elseif ($_POST) {
				$con = $this->data->datos();
				if ($con != '') {
					$_SESSION = $con;
					return HttpResponse('index.php/');
				}else{
					$_SESSION['error']='si';
					return HttpResponse('index.php/');
				}
			}else{
				return render_to_response(vista::index_log_in());
			}
		}
		public function url_p($url)
		{
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
		public function perfil()
		{
			global $url_array;
			if ($url_array[2]=='editar') {
				if ($_POST) {
					if ($_POST['nip'] == $_POST['nip2']) {
						$this->data->peditar($_POST);
						$_SESSION['email'] =$_POST['email'];
						return HttpResponse('index.php/');
					}else{echo "No coinciden los nip";}
					
				}else{
					return render_to_response($this->view->gen_dinamic('edit_perfil.html'));
				}
			}else{
				echo "ver perfil";
			}
			
		}
		public function denegado()
		{
			return render_to_response("Sin permiso");
		}
		public function E_404()
		{
			return render_to_response ($this->view->MS_404());
		}


		public function distroy(){
			$url = URL_short();
			if ($url =="/distroy/") {
				session_destroy();
			}
			return HttpResponse("");
		}
	}
?>