<?= $this->extend('layout/templates'); ?>

<?= $this->Section('styles'); ?>
<link href="/css/apartment.css" rel="stylesheet" />
<?= $this->endSection();?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
	<main>
		<!-- Modal -->
		<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="/apartment/save_details" method="post" id="detail_form" enctype="multipart/form-data">
						<?= csrf_field(); ?>
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Apartment Detail</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
								<div class="form-group">
									<input type="text" class="form-control" name="title" id="title" placeholder="Title..." required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="price" id="price" placeholder="Price...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="cost" id="cost" placeholder="cost...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="bedroom" id="bedroom" placeholder="Bedroom...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="good_sqm" id="good_sqm" placeholder="GOOD sqm...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="room_sqm" id="room_sqm" placeholder="Room space sqm...">
								</div>

								<div class="form-group">
									<input type="text" class="form-control" name="terrace_sqm" id="terrace_sqm" placeholder="Terrace area...">
								</div>

								<div class="form-group">
									<input type="text" class="form-control" name="balcony_sqm" id="balcony_sqm" placeholder="Balcony area...">
								</div>

								<div class="form-group">
									<input type="text" class="form-control" name="floor" id="floor" placeholder="floor...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="story" id="story" placeholder="story...">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="address" id="address" placeholder="Address...">
								</div>

								<div class="form-group">
									<label for="image">Select Image</label>
									<input class="form-control-file" type="file" id="image" name="image" required>
								</div>


								<div class="form-group">
									<textarea class="form-control" name="path" id="path" placeholder="Path..." required readonly></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<h1 class="mt-4"><i class="fas fa-city"></i> <?= $title; ?></h1>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('apartment'); ?>"><?= $title; ?></a></li>
				<li class="breadcrumb-item"><?= $perspective['title']?></a></li>
			</ol>
			<div class="row">
				<div class="col-md-12 mb-2">
					<?php if (session()->getFlashdata('error')){
					echo '<div class="alert alert-danger" role="alert">';
					echo session()->getFlashdata('error');
					echo '</div>';}
					?>
					<button type="button" class="btn btn-primary" id="start_btn" onclick="startPath()">Start Path</button>
					<button type="button" class="btn btn-success" disabled id="finish_btn"	onclick="finishPath()">Finish Path</button>
					<button type="button" class="btn btn-secondary" disabled id="clear_btn"	onclick="clearPath()">Clear Path</button>
					<button type="button" class="btn btn-outline-success float-right"	data-toggle="modal" data-target="#detailModal">Input Details</button>
				</div>

				<div class="col-md-12">
					<svg xmlns="http://www.w3.org/2000/svg" id="img_preview" style="background-image: url(/images/perspective/<?= $perspective['image'] ?>); background-size: cover;" width="100%"	viewBox="0 0 2427 1200">

						<?php foreach ($apartments as $apart) {
							echo '<path onclick="onClickPath(' . $apart['id'] . ')" class="status-'. $apart['status'] . '" d="' . $apart['path'] . '" fill="#0000"  data-placement="right" data-toggle="tooltip" data-html="true" title=\' ' . 
								'<div class="hover-popup">
									<div class="hover-popup-title">' . $apart['title'] . '</div>
									<div class="hover-popup-status-hr hr-status-' . $apart['status'] . '"></div>
									<div class="hover-popup-status-text text-status-' . $apart['status'] . '">
										' . $apart['title'] . '
									</div>
									<div class="hover-popup-body">
										<strong>BRA m²:</strong> ' . $apart['good_sqm'] . '<br>
										<strong>Soverom:</strong> ' . $apart['bedroom'] . '<br>
										<img class="hover-popup-image" src="/images/apartments/resized/preview-' . $apart['image'] . '" alt="" crossorigin="anonymous">
									</div>
								</div>'
							 . ' \'></path>';
						}?>
					</svg>
				</div>
			</div>
		</div>
	</main>
	<script src="/assets/js/apartArray.js" type="text/javascript"></script>

	<script type="text/javascript">
		for (var i = apartArray.length - 1; i >= 0; i--) {
			// console.log("https://granpark.no/api/data/prosjektside/boligvelger/" + apartArray[i].page.uri.split('/')[3]);
		}

		$(document).ready(function() {
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
		})
	</script>
	<script type="text/javascript">

		let statusColor = Array();
		statusColor.push("<?= $statusColor[0]?>");
		statusColor.push("<?= $statusColor[1]?>");
		let fillColor = "#0000";

		let cur_path_d = '';
		let cur_path_obj;
		let isPathDrawing = false;

		const perspectiveSize = {
			width : <?= $perspective['width'] ?>,
			height : <?= $perspective['height'] ?>,
		};

		$("#img_preview").click(function (e){
			if (isPathDrawing == false)
				return;
			var rect = $("#img_preview")[0].getBoundingClientRect();
			var x = e.clientX - rect.left; //x position within the element.
			var y = e.clientY - rect.top;	//y position within the element.
			x = x * perspectiveSize.width / rect.width;
			y = y * perspectiveSize.height / rect.height;
			cur_path_d += (Math.round(x * 10) / 10 + ',' + Math.round(y * 10) / 10 + ' ');
			cur_path_obj.setAttribute('d', cur_path_d);
			// console.log(x,y);
		})
		function startPath(){
			$("#start_btn").prop("disabled",true);
			$("#finish_btn").prop("disabled",false);
			$("#clear_btn").prop("disabled",false);
			cur_path_d = 'M';
			isPathDrawing = true;

			cur_path_obj =	document.createElementNS('http://www.w3.org/2000/svg', "path");
			cur_path_obj.setAttribute('fill', "rgba(66, 164, 135, 0.6)");
			$("#img_preview").append(cur_path_obj);
		}
		function finishPath(){
			$("#start_btn").prop("disabled",false);
			$("#finish_btn").prop("disabled",true);
			cur_path_d += " z";

			cur_path_obj.setAttribute('d', cur_path_d);
			$("#img_preview").append(cur_path_obj);

			$("#path").val(cur_path_d);

			isPathDrawing = false;
		}
		function clearPath(){
			$("#start_btn").prop("disabled",false);
			$("#finish_btn").prop("disabled",true);
			$("#clear_btn").prop("disabled",true);
			cur_path_d = '';
			cur_path_obj.setAttribute('d', cur_path_d);
			isPathDrawing = false;
		}

		$("#detail_form").submit(function(e){
			if (isPathDrawing == true || cur_path_d == ""){
				e.preventDefault();
				alert("Complete the drawing path first!");
				return;	
			}		
		});

		function onClickPath(apartId) {
			// alert(apartId);
			Swal.fire({
			 title: 'Are you going to delete this data?',
			 text: `You won't be able to revert this!`,
			 icon: 'question',
			 showCancelButton: true,
			 confirmButtonColor: '#d33',
			 cancelButtonColor: '#3085d6',
			 confirmButtonText: 'Yes, delete it!',
			 cancelButtonText: 'Cancel'
		 }).then((result) => {
			 if (result.value){
			 	window.location.href = "apartment/delete/" + apartId;
			 }
		 });
		}
	</script>
	<?= $this->endSection();