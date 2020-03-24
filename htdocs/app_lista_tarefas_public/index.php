<?php
	$acao = "recuperarTarefasPendentes";
	require 'tarefa_controller.php';

	// echo "<pre>";
	// print_r($tarefas);
	// echo "</pre>";
?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			var i = setInterval(function () {
    
				clearInterval(i);
			
				// some a animação no tempo escolhido
				document.getElementById("anima").style.display = "none";

			}, 2000);


			function editar(id, txt_tarefa){
				//formulario 
				let form = document.createElement('form');
				form.method = 'post';
				form.action = 'index.php?pag=index&acao=atualizar';
				form.className = 'row mt-3';

				// inputs
				let input = document.createElement('input');
				input.className = 'form-control col-8';
				input.type = 'text';
				input.name = 'tarefa';
				input.value = txt_tarefa;
				
				//criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input');
				inputId.type = 'hidden';
				inputId.name = 'id';
				inputId.value = id;
				

				// botao
				let botao = document.createElement('button');
				botao.className = 'btn btn-info col-4';
				botao.type = "submit";
				botao.innerHTML = 'Atualizar';
				
				// colocar no formulario
				form.appendChild(inputId);
				// colocar no formulario
				form.appendChild(input);
				// colocar no formulario
				form.appendChild(botao);

				//teste
				//console.log(form);

				// selecionar tarefa pelo id
				let tarefa = document.getElementById('tarefa_'+id);

				// limpar tarefa
				tarefa.innerHTML = '';

				// colocar form na pagina
				//insertBefore serve para colocar um grpo de codigo html na pagina
				tarefa.insertBefore(form, tarefa[0]);
				// passa dois parametros 1° arvore de elementos 2° o indice onde o 1° parametro será adicionado no elemento no caso tarefa
			
			}

			function remover(id){
				location.href = 'index.php?pag=index&acao=remover&id='+id ;
			}

			function marcarRealizada(id){
				location.href = 'index.php?pag=index&acao=marcarRealizada&id='+id ;
			}
		</script>
	</head>

	<body>

		<div class="container-icons" id="anima">
			<div class="icon correct">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="-5 -25 550.00533 512" class="">
					<g>
						<path
							d="m306.582031 317.25c-12.074219 12.097656-28.160156 18.753906-45.25 18.753906-17.085937 0-33.171875-6.65625-45.246093-18.753906l-90.667969-90.664062c-12.09375-12.078126-18.75-28.160157-18.75-45.25 0-17.089844 6.65625-33.171876 18.75-45.246094 12.074219-12.097656 28.160156-18.753906 45.25-18.753906 17.085937 0 33.171875 6.65625 45.246093 18.753906l45.417969 45.394531 125.378907-125.375c-40.960938-34.921875-93.996094-56.10546875-152.042969-56.10546875-129.601563 0-234.667969 105.06640575-234.667969 234.66406275 0 129.601562 105.066406 234.667969 234.667969 234.667969 129.597656 0 234.664062-105.066407 234.664062-234.667969 0-24.253907-3.6875-47.636719-10.515625-69.652344zm0 0"
							fill="#4caf50" data-original="#4CAF50" class="active-path"
							data-old_color="#4caf50" />
						<path
							d="m261.332031 293.335938c-5.460937 0-10.921875-2.089844-15.082031-6.25l-90.664062-90.667969c-8.34375-8.339844-8.34375-21.824219 0-30.164063 8.339843-8.34375 21.820312-8.34375 30.164062 0l75.582031 75.582032 214.253907-214.25c8.339843-8.339844 21.820312-8.339844 30.164062 0 8.339844 8.34375 8.339844 21.824218 0 30.167968l-229.335938 229.332032c-4.15625 4.160156-9.621093 6.25-15.082031 6.25zm0 0"
							fill="#2196f3" data-original="#2196F3" class=""  data-old_color="#2196f3" />
					</g>
				</svg>

			</div>
		</div>

		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<? foreach ($tarefas as $indice => $tarefa) { ?>
									
									
									<div class="row mb-3 d-flex align-items-center tarefa">

										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
											<?= $tarefa->tarefa ?>
										</div>

										<div class="col-sm-3 mt-2 d-flex justify-content-between">

											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>
												

										</div>
									</div>

								<? } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>