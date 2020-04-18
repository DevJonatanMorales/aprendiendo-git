$(document).ready(function () {
	console.log("archivo cargado 100%");

	let editar = false;
	fetchTask();//funcion de mostrar datos

	$('#task-result').hide();
	$('#search').keyup(function (e) {//realizar busquedas en la DB
		if ($('#search').val()) {//para validar si el input esta vasio.
			let search = $('#search').val();
			$.ajax({
				url: 'task_search.php',
				type: 'POST',
				data: { search },
				success: function (response) {
					let searchTasks = JSON.parse(response);
					let template = '';

					searchTasks.forEach(searchTasks => {
						template += `<h1> 
						${searchTasks.nom_tareas}
						</h1>`
					});

					$('#container').html(template);
					$('#task-result').show();
				}
			});
		}
	});

	//para inserta o modificar datos en la base de datos.
	$('#task-form').submit(function (e) {//evento onclick
		const postDate = {
			id: $('#txtTaskId').val(),
			name: $('#name').val(),
			description: $('#description').val()
		};

		let url = editar === false ? 'task_add.php' : 'task_edit.php';
		// console.log(postDate);

		$.post(url, postDate, function (response) {
			fetchTask();
			$('#task-form').trigger('reset');
		});

		e.preventDefault();
	});

	//para mostrar los datos de la DB.
	function fetchTask() {
		$.ajax({
			url: 'task_list.php',
			type: 'GET',
			success: function (result) {
				const tasks = JSON.parse(result);
				let showDate = '';
				tasks.forEach(tasks => {
					showDate += `<tr taskId="${tasks.id}">
						<td>${tasks.id}</td>
						<td><a  href="#" class="task-itmen">${tasks.name}</a></td>
						<td><a  href="#" class="task-itmen">${tasks.description}</a></td>
						<td>
							<button class="btn btn-danger task-delete">
								Delete
							</button>
						</td>
					</tr>`
				});

				$('#tasks').html(showDate);
				editar = false;
			}
		})
	}

	//onclick en el boton eliminar.
	$(document).on('click', '.task-delete', function () {
		if (confirm('Are you sure you  want to delete it?')) {
			let elementId = $(this)[0].parentElement.parentElement;
			let taskId = $(elementId).attr('taskId');
			console.log(taskId);

			$.post('task_delete.php', { taskId }, function (resultDelete) {
				fetchTask();
			})
		}
	})

	//para mostrar los datos a modificcar
	$(document).on('click', '.task-itmen', function () {
		let elementId = $(this)[0].parentElement.parentElement;
		let taskId = $(elementId).attr('taskId');

		$.post('task_single.php', { taskId }, function (resultSingle) {
			const task = JSON.parse(resultSingle);
			$('#txtTaskId').val(task.id);
			$('#name').val(task.name);
			$('#description').val(task.description);
			editar = true;
		})
	})
});
