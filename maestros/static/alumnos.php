<div class="container">
	<div class="text-center" id="lis_grup">[Grupo] de <?=$_GET['g']?><?=$_GET['gr']?> </div>
	<div class="row">
  		<div class="col-md-9 col-md-push-3"><p class="text_ls">[name]: <?= utf8_encode($_SESSION['nombre'])?></p></div>
 		 <div class="col-md-3 col-md-pull-9"><p class="text_ls">[cod]: <?= $_SESSION['codigo']?></p></div>
	</div>
	<pre>[ins_cia]</pre>
	<form action="" method="post">
	<div class="row">
  		<div class="col-md-9 col-md-push-3"><p class="text_ls"><input type="text" class="form-control" id="asistencia" name="asistencias" value="<?= $_SESSION['class']?>" onfocus="if(this.value=='<?= $_SESSION['class']?>')this.value=''" onkeypress="return justNumbers(event)" placeholder="<?= $_SESSION['class']?>"></p></div>
 		 <div class="col-md-3 col-md-pull-9"><p class="text_ls">[tasistencias]</p></div>
	</div>
	<td>
 		
   		
    	</td>
	<table class="table table-striped" id="califiacion">
 		<tr>
 			<th>[cod]</th>
 			<th>[name]</th>
 			<th>[faltas]</th>
 			<th>[evaluacion]</th>
 		</tr>
 		<?php $n=0; foreach ($GLOBALS as $key => $value): $n++;?>
 			<tr>
 				<td><?=$value['cod_ev']?></td>
 				<input type="hidden"  name="cod<?=$key?>" value="<?=$value['cod_ev']?>">
 				<td><?=utf8_encode($value['nom_ubi'])?></td>
 				<td>
 					<label class="sr-only" for="faltas">[faltas]</label>
   					 <input type="faltas" class="form-control" id="faltas" name="fal<?=$key?>" value="<?=$value['tfal_int_ev']?>" onfocus="if(this.value=='<?=$value['tfal_int_ev']?>')this.value=''" onkeypress="return justNumbers(event)" placeholder="<?=$value['tfal_int_ev']?>">
    				</td>
    				<td>
 					<label class="sr-only" for="evaluacion">[evaluacion]</label>
   					 <input type="evaluacion" class="form-control" id="evaluacion" name="cal<?=$key?>" value="<?=$value['cal_int_ev']?>" onfocus="if(this.value=='<?=$value['cal_int_ev']?>')this.value=''" onkeypress="return justNumbers(event)" placeholder="<?=$value['cal_int_ev']?>">
    				</td>
 			</tr>
 		<?php endforeach; ?>
	</table>
	<input type="hidden" name="cantidad" value="<?=$n?>">
	<input type="hidden" name="opcion" value="si">
	<button type="submit" class="btn btn-default">[grabar]</button>
	<button type="submit" value="si" name="p" class="btn btn-default">[cerrar_enviar]</button>
	</form>
</div>