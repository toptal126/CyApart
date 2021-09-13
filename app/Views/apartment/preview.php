<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="Simple Starter Project CodeIgniter 4" />
	<title><?= $title; ?></title>
	<link href="<?= base_url(); ?>/css/styles.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

	<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
	<script src="/assets/bootstrap/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	
	<link href="/css/apartment.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand" href="<?= base_url('dashboard'); ?>">Apart</a>

		<ul class="navbar-nav d-md-inline-block	ml-auto mr-0 my-2 ">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#profileModal" data-toggle="modal" data-target="#profileModal">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- Render section content -->
	<div id="layoutSidenav_content" style="background-color: #d4e4d8;">
	<main>
		<div class="container-fluid pt-5">

			<h1 hidden class="mt-5"><i class="fas fa-eye"></i> <?= $title; ?></h1>
			<div class="row mb-5 mt-3">
				<div class="mt-auto mb-auto ml-3">
					<b>Find your home</b>
					<div>Available housing: 32</div>
				</div>
				<div style="margin-left: 30px;">
					<b>South</b>
					<div style="border-radius: 10px; box-shadow: 4px 4px 8px rgb(0 0 0 / 40%);">
						<img style="border-radius: 10px;" width="120px" height="70px" src="/images/perspective/<?= $perspective['image'] ?>">
					</div>
				</div>
				<div class="ml-auto mr-5 mt-auto mb-auto">
					<button class="btn btn-lg btn-outline-primary " onclick="$('#filter_panel').toggle()"> <i class="fas fa-sliders-h"></i> Filter</button>
				</div>
			</div>
			<div class="row mb-5" id="filter_panel" style="display:none">
				<div class="col-md-4 pl-5 pr-5">
					<p class="text-center font-weight-bold mb-n1">Good Area</p>
					<span id="good_sqm_slider_start"><?= $min_good_sqm ?></span>
					<span id="good_sqm_slider_end" class="float-right"><?= $max_good_sqm ?></span>
					<div class="mt-1" id="good_sqm_slider"></div>
				</div>
				<div class="col-md-4 pl-5 pr-5">
					<p class="text-center font-weight-bold mb-n1">Price</p>
					<span id="price_slider_start"><?= $min_price ?></span>
					<span id="price_slider_end" class="float-right"><?= $max_price ?></span>
					<div class="mt-1" id="price_slider"></div>
				</div>
				<div class="col-md-4 pl-5 pr-5">
					<p class="text-center font-weight-bold mb-n1">Good Area</p>
					<span id="bedroom_slider_start"><?= $min_bedroom ?></span>
					<span id="bedroom_slider_end" class="float-right"><?= $max_bedroom ?></span>
					<div class="mt-1" id="bedroom_slider"></div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-12">
					<svg xmlns="http://www.w3.org/2000/svg" id="img_preview" style="background-image: url(/images/perspective/<?= $perspective['image'] ?>); background-size: cover;" width="100%"	viewBox="0 0 2427 1200">
						<?php $no=0;?>
						<?php foreach ($apartments as $apart): ?>
							<path id="path-<?=$no ?>" class="status-<?=$apart['status']?> <?=$apart['status']?'lightning':''?>" d="<?=$apart['path']?>" fill="#0000"	data-placement="right" onclick="gotoRoom('<?=$apart['apart_id']?>', <?=$apart['status']?>, true, <?=$no++?>)" data-toggle="tooltip" data-html="true"
								data-good_sqm="<?= $apart['good_sqm'] ?>"
								data-price="<?= $apart['price'] ?>"
								data-bedroom="<?= $apart['bedroom'] ?>"
								title='<div class="hover-popup">
									<div class="hover-popup-title"><?=$apart['title']?></div>
									<div class="hover-popup-status-hr hr-status-<?=$apart['status']?>"></div>
									<div class="hover-popup-status-text text-status-<?=$apart['status']?>">
										<?=$apart['status']?'Available':'Sold'?>
									</div>
									<div class="hover-popup-body">
										<?=$apart['status']?("<strong>Price:</strong>".$apart['price']."<br>"):'' ?>
										<strong>BRA m²:</strong> <?=$apart['good_sqm']?><br>
										<strong>Soverom:</strong> <?=$apart['bedroom']?><br>
										<img class="hover-popup-image" src="/images/apartments/resized/preview-<?=$apart['image']?>" alt="" crossorigin="anonymous">
									</div>
								</div>'
							?> \'></path>';
						<?php endforeach;?>
					</svg>
				</div>
				<div class="col-md-12 d-md-none" id="slick_panel"> <!--	 -->
					<button type="button" class="btn btn-primary btn-circle slide-prev-btn"><i class="fas fa-angle-left"></i></button>
					<button type="button" class="btn btn-primary btn-circle slide-next-btn"><i class="fas fa-angle-right"></i></button>

					<div id="slickSlide">
						<?php foreach ($availableApartments as $apart) : ?>
							<div class="hover-slide" onclick="gotoRoom('<?= $apart['apart_id'] ?>')">
								<div class="hover-slide-title"><?=$apart['title']?></div>
								<div class="hover-slide-status-hr hr-status-<?=$apart['status']?>"></div>
								<div class="hover-slide-status-text text-status-<?=$apart['status']?>">
									<?=$apart['status']?'Available':'Sold'?>
								</div>
								<div class="hover-slide-body d-flex flex-column flex-sm-row">
									<div class="mt-auto mb-auto">
										<?=$apart['status']?("<strong>Price:</strong>".$apart['price']."<br>"):'' ?>
										<strong>BRA m²:</strong> <?=$apart['good_sqm']?><br>
										<strong>Soverom:</strong> <?=$apart['bedroom']?><br>
									</div>
									<div style="flex-grow: 2; text-align: center;">
										<img class="hover-slide-image" src="/images/apartments/resized/preview-<?=$apart['image']?>">
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-md-12 pt-3 pb-3 pr-5">
					<button type="button" id="view_image_btn" class="btn btn-outline-primary float-right" onclick="toggleCard(1)"><i class="fas fa-th"></i> Image</button>
					<button type="button" id="view_price_btn" class="btn btn-primary float-right mr-3" onclick="toggleCard(0)"><i class="fas fa-list"></i> Price</button>
				</div>

				<div class="col-md-12 pl-5 pr-5" id="price_panel">
					<div class="table-responsive">
						<table style="cursor: pointer;" class="table-hover table table-striped" id="apartTable" width="100%" cellspacing="0">
							<thead class="thead-dark">
								<tr>
									<!-- Status	Price	Bedroom	BRA m²	P-Rom m²	Balkong m²	Terrace area m²	Story	Floors	Apartment ID -->
									<th>Status</th>
									<th>Price</th>
									<th>Bedroom</th>
									<th>Area m²</th>
									<th>Room m²</th>
									<th>Balcony m²</th>
									<th>Terrace m²</th>
									<th>Story</th>
									<th>Floors</th>
									<th>Apartment ID</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($availableApartments as $apart) : ?>
									<tr onclick="gotoRoom('<?= $apart['apart_id'] ?>')">
										<td><?= $apart['status']==1?'Available':'Sold' ?></td>
										<td><?= $apart['price']?></td>
										<td><?= $apart['bedroom']?></td>
										<td><?= $apart['good_sqm']?$apart['good_sqm']:'' ?></td>
										<td><?= $apart['room_sqm'] ?></td>
										<td><?= $apart['balcony_sqm']!=0?$apart['balcony_sqm']:''	?></td>
										<td><?= $apart['terrace_sqm']!=0?$apart['terrace_sqm']:''	?></td>
										<td><?= $apart['story']!=0?$apart['story']:''	?></td>
										<td><?= $apart['floor']!=0?$apart['floor']:''	?></td>
										<td><?= $apart['title']?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-12 pl-5 pr-5" id="image_panel" style="display:none">
					<div class="row">
					<?php foreach ($availableApartments as $apart) { ?>
						<div class="bg-light my-card pl-4 pr-4" onclick="gotoRoom('<?= $apart['apart_id'] ?>')">
							<div style="height: 250px; background: url('/images/apartments/resized/preview-<?=$apart['image'] ?>') 	 no-repeat center; background-size: contain;">
							</div>
							<div class="my-card-ribbon ml-n4">Available</div>
							<div class="my-card-body text-left">
								<p><b><?= $apart['title'] ?></b></p>
								<p><i class="fas fa-building"></i> Good Area : <?= $apart['good_sqm'] ?></p>
								<p><i class="fas fa-bed"></i> Bedroom : <?= $apart['bedroom'] ?></p>
								<p><i class="fas fa-tag"></i> Price : <?= $apart['price'] ?></p>
							</div>
						</div>
					<?php } ?>
					</div>
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
			$('#slickSlide').slick({
				infinite: false,
				waitForAnimate: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: $('.slide-prev-btn'),
				nextArrow: $('.slide-next-btn')
			});

			$('#slickSlide').on('afterChange', function(event, slick, currentSlide){
				$('.mobile-hover').removeClass("mobile-hover");
				$("#path-" + currentSlide).addClass("mobile-hover");
			});

			$(function () {
				if ($("#slick_panel").css("display") == "block")
					return;
				$('[data-toggle="tooltip"]').tooltip()
			});
			$("#apartTable").dataTable({
				info: false,
				searching: false,
				paging: false
			});

			$("#good_sqm_slider").slider({
				min: <?= $min_good_sqm ?>,
				max: <?= $max_good_sqm ?>,
				step: 1,
				values: [$("#good_sqm_slider_start").html(), $("#good_sqm_slider_end").html()],
				slide: function(event, ui) {
					if ( ui.values[0] >= ui.values[1] ) {
						return false;
					} else {
						$("#good_sqm_slider_start").html(ui.values[0]);
						$("#good_sqm_slider_end").html(ui.values[1]);
					}
				},
				stop : function (e, ui){
					filterApartment();
				}
			});

			$("#price_slider").slider({
				min: <?= $min_price ?>,
				max: <?= $max_price ?>,
				step: 10000,
				values: [$("#price_slider_start").html(), $("#price_slider_end").html()],
				slide: function(event, ui) {
					if ( ui.values[0] >= ui.values[1] ) {
						return false;
					} else {
						$("#price_slider_start").html(ui.values[0]);
						$("#price_slider_end").html(ui.values[1]);
					}
				},
				stop : function (e, ui){
					filterApartment();
				}
			});
			
			$("#bedroom_slider").slider({
				min: <?= $min_bedroom ?>,
				max: <?= $max_bedroom ?>,
				step: 1,
				values: [$("#bedroom_slider_start").html(), $("#bedroom_slider_end").html()],
				slide: function(event, ui) {
					if ( ui.values[0] >= ui.values[1] ) {
						return false;
					} else {
						$("#bedroom_slider_start").html(ui.values[0]);
						$("#bedroom_slider_end").html(ui.values[1]);
					}
				},
				stop : function (e, ui){
					filterApartment();
				}
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

		function toggleCard(isImage){
			if (isImage){
				$("#view_image_btn").removeClass("btn-outline-primary");
				$("#view_image_btn").addClass("btn-primary");
				$("#view_price_btn").removeClass("btn-primary");
				$("#view_price_btn").addClass("btn-outline-primary");

				$("#price_panel").hide();
				$("#image_panel").show();
			}
			else{
				$("#view_price_btn").removeClass("btn-outline-primary");
				$("#view_price_btn").addClass("btn-primary");
				$("#view_image_btn").removeClass("btn-primary");
				$("#view_image_btn").addClass("btn-outline-primary");
				$("#price_panel").show();
				$("#image_panel").hide();
			}
		}

		function gotoRoom(apartId, status, onPath, page) {
			if (onPath){
				if ($("#slick_panel").css("display") == "block") //if it's mobile
				{
					if (status){
						$('.mobile-hover').removeClass("mobile-hover");
						$('#slickSlide').slick('slickGoTo', page, false)
					}
					return;
				}
			}
			window.location.href = '/view_apartment/' + apartId;
		}

		function filterApartment() {
			const min_good_sqm = $("#good_sqm_slider_start").html();
			const max_good_sqm = $("#good_sqm_slider_end").html();
			const min_price = $("#price_slider_start").html();
			const max_price = $("#price_slider_end").html();
			const min_bedroom = $("#bedroom_slider_start").html();
			const max_bedroom = $("#bedroom_slider_end").html();

			$('#img_preview').children('path').each(function () {
				$(this).removeClass('lightning');
				$(this).removeClass('filter-decline');
				$(this).removeClass('filter-accept');
				const good_sqm = $(this).data('good_sqm');
				const price = $(this).data('price');
				const bedroom = $(this).data('bedroom');
				if (good_sqm < min_good_sqm || good_sqm > max_good_sqm){
					$(this).addClass('filter-decline');
					return;
				}
				if (price < min_price || price > max_price){
					$(this).addClass('filter-decline');
					return;
				}
				if (bedroom < min_bedroom || bedroom > max_bedroom){
					$(this).addClass('filter-decline');
					return;
				}
				$(this).addClass('filter-accept');
			});
		}
	</script>

	<!-- Footer -->
	<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid">
			Apart Written By Top Talent 126
		</div>
	</footer>
	</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/js/scripts.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/assets/demo/chart-area-demo.js"></script>
	<script src="<?= base_url(); ?>/assets/demo/chart-bar-demo.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>/assets/demo/datatables-demo.js"></script>

	<!-- Modal Logout -->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Logout Confirm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure..?, Please click the 'logout button'...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					<a href="<?= base_url('/logout'); ?>" class="btn btn-primary btn-sm">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Profile -->
	<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Your Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Email : <?= session('user')->email ?> <br>
					Username : <?= session('user')->username; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


