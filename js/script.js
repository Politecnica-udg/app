$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});
$('#myModal2').on('shown.bs.modal', function () {
  $('#myInput').focus()
});
var a = false;
var app = angular.module("pagPoli",[]);
app.controller("log",['$scope','$http',function ($scope,$http) {
	$scope.err = false;
	$scope.veriLog = function (){
		$http.get("index.php/log?user="+$scope.user+"&ps="+$scope.ps)
		.success(function (dato) {
			if (dato.estado == "true"){
				$scope.err = false;
				a = true;
				document.forms["form1"].submit()
			}else{
				$scope.err = true;
				$scope.ps = "";
			};
		})
		.error(function (err) {
			console.log(err);
		});
	}
}]);
app.controller("ocultar",['$scope','$http', function ($scope,$http) {
	$scope.datos = "";
	$scope.datosMaestros = function(){
		$http.get("index.php/datosMaestros")
		.success(function(dato){
			$scope.datos = dato;
		})
		.error(function(err){
			console.log(err);
		});
	}
}]);
app.controller("grupAlumnos",['$scope', '$http', function ($scope, $http) {
	$scope.datos =  "";
	$scope.consulta = function (cod) {
		$http.get("index.php/datosGrupos/"+cod)
		.success(function(dato){
			$scope.datos = dato;
		})
		.error(function(err){
			console.log(err);
		});
	}
}]);
app.controller("alumnoEva",['$scope', '$http', function ($scope, $http) {
	$scope.datos = "";
	$scope.check = false;
	$scope.materias_Al = function(codigo){
		$http.get("index.php/materias_Al")
		.success(function (dato){
			$scope.datos = dato;
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.chec = function () {
		$scope.check = true;
	}
}]);
app.controller("evaluarAlum",['$scope', '$http', function ($scope, $http) {
	$scope.datos = "";
	$scope.lista = function () {
		url = window.location.search;
		$http.get("index.php/datAl/"+url)
		.success(function(dato){
			$scope.datos = dato;
			console.log($scope.datos);
		})
		.error(function(err){
			console.log(err);
		});
	}
	$scope.saveFal = function (id,fal_al) {
		$http.get("index.php/saveFal?id_al="+id+"&fal="+fal_al+"&cTotal="+$scope.datos.clas.tclas_int)
		.success(function (dato) {
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.saveCal = function (id,cal_al) {
		if(cal_al >100){
			alert("Tiene que ser un numero menor o igual a 100");
		}else{
			$http.get("index.php/saveCal?id_al="+id+"&cal="+cal_al)
			.success(function (dato) {
			})
			.error(function (err) {
				console.log(err);
			});
		}
	}
	$scope.grabar = function(op_m){
		url = window.location.search;
		$http.get("index.php/grabarM/"+url+"&op="+op_m+"&fal="+$scope.datos.clas)
		.success(function(dato){
			console.log(dato);
			alert("Datos Grabados");
			location.href="index.php";
		})
		.error(function(err){
			console.log(err);
		});
	}
}]);

app.controller("pwNew",['$scope', '$http', function ($scope, $http) {
	$scope.confirmar = function () {
		if ($scope.pw1 == $scope.pw2) {
			$scope.pwaser = "has-success";
		}else{
			$scope.pwaser = "has-error";
		};
	}
	$scope.guardar = function (ID) {
		if ($scope.pw1 == $scope.pw2) {
			$http.post("index.php/pwNew/",{
				pw 		: $scope.pw1,
				id 		: ID})
			.success(function (dat) {
				alert("Contraseña Cambiada");
				$scope.pw1 = "";
				$scope.pw2 = "";
			})
			.error(function (err) {
				console.log(err);
			});
		}else{
			alert("No son iguales");
		};
	}
}]);
app.controller("em",['$scope', '$http', function ($scope, $http) {
	$scope.empresas = [];
	$scope.empInfo = function () {
		$http.post("index.php/empInfo")
		.success(function (dat) {
			$scope.empresas = dat;
		})
		.error(function (err) {
			console.log(err);
		});		
	}
	$scope.editEm = function (id) {
		$scope.id 		= $scope.empresas[id].id;
		$scope.name 	= $scope.empresas[id].name;
		$scope.domi 	= $scope.empresas[id].domi;
		$scope.cp		= $scope.empresas[id].cp;
		$scope.mun		= $scope.empresas[id].mun;
		$scope.email	= $scope.empresas[id].email;
		$scope.tel		= $scope.empresas[id].tel;
		$scope.name_en	= $scope.empresas[id].name_en;
		$scope.cargo	= $scope.empresas[id].cargo;
		$scope.email_en	= $scope.empresas[id].email_en;
	}
	$scope.editEmSave = function (id) {
		$http.post("index.php/eSaveEm",{
			id_em 	: id,
			name 	: $scope.name,
			domi 	: $scope.domi,
			cp		: $scope.cp,
			mun 	: $scope.mun,
			email 	: $scope.email,
			tel 	: $scope.tel,
			name_en : $scope.name_en,
			cargo	: $scope.cargo,
			email_en: $scope.email_en
		})
		.success(function (dat) {
			$scope.empInfo();
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.deleteEm = function (id) {
		$http.post("index.php/deleteEm/"+$scope.empresas[id].id)
		.success(function (dat) {
			$scope.empInfo();
		})
		.error(function (err) {
			console.log(err);
		});	
	}
	$scope.newEmpresa = function () {
		$scope.name 	= "";
		$scope.domi 	= "";
		$scope.cp		= "";
		$scope.mun		= "";
		$scope.email	= "";
		$scope.tel		= "";
		$scope.name_en	= "";
		$scope.cargo	= "";
		$scope.email_en	= "";
	}
	$scope.EmSave = function () {
		$http.post("index.php/EmSave",{
			name 	: $scope.name,
			domi 	: $scope.domi,
			cp		: $scope.cp,
			mun 	: $scope.mun,
			email 	: $scope.email,
			tel 	: $scope.tel,
			name_en : $scope.name_en,
			cargo	: $scope.cargo,
			email_en: $scope.email_en
		})
		.success(function (dat) {
			console.log(dat);
			$scope.empInfo();
		})
		.error(function (err) {
			console.log(err);
		});
				
	}
}]);
app.controller("soliEm",['$scope', '$http', function ($scope, $http) {
	$scope.solicitantes = [];
	$scope.soliIn = function (id) {
		$http.post("index.php/soliIn/"+id)
		.success(function (dat) {
			$scope.solicitantes = dat;
		})
		.error(function (err) {
			console.log(err);
		});		
	}
	$scope.soliEdit = function (id) {
		$scope.id_soli	= $scope.solicitantes[id].id_soli;
		$scope.carr		= $scope.solicitantes[id].carr;
		$scope.act 		= $scope.solicitantes[id].act;
		$scope.apoyo	= $scope.solicitantes[id].apoyo;
		$scope.sexo_em 	= $scope.solicitantes[id].sexo_em;
	}
	$scope.eSaveSo = function (id, em) {
		$http.post("index.php/eSaveSo",{
			id_soli	: id,
			carr	: $scope.carr,
			act 	: $scope.act,
			apoyo	: $scope.apoyo,
			sexo_em	: $scope.sexo_em
		})
		.success(function (dat) {
			$scope.soliIn(em);
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.quitAl = function (cod , em) {
		$http.post("index.php/quitAl/"+cod)
		.success(function (dat) {
			$scope.soliIn(em);
		})
		.error(function (err) {
			console.log(err);
		});
				
	}
}]);


/**----------------------------------------------------------------------------------------
----------------------------- Codigo de Google analytics. -----------------------
----------------------------------------------------------------------------------------  
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37376197-4', 'udg.mx');
  ga('send', 'pageview');
//-----------------*/
function nav_old(a) {
	alert(a);
}