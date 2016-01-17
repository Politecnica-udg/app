<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/studenModel.php';
	class studen{
		var $data;
		function __construct(){$this->data = new model_studen();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::studen($html.'.html'));
		}
	}
?>