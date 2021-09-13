<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid">
			<h1 class="mt-4"><i class="fas fa-image"></i> <?= $title; ?></h1>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('apartment'); ?>"><?= $title; ?></a></li>
			</ol>
					<?= form_open_multipart("upload_perspective"); ?>
					<?= csrf_field(); ?>
					<div class="form-group">
						<input type="text" placeholder="Title..." name="title" id="title" class="form-control" value="<?= old('title'); ?>" required>
					</div>

					<div class="form-group">
						<input placeholder="Adress..." type="text" name="address" id="address" class="form-control" value="<?= old('address'); ?>">
					</div>
					
					<div class="form-group">
						<textarea placeholder="Type details..." name="details" id="details" cols="30" rows="5" class="form-control"><?= old('details'); ?></textarea>
					</div>
					<div class="form-group">
						<label for="photo">Photo</label>
						<input type="file" name="photo" id="photo">
					</div>
					<button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
					<a href="<?= base_url('dashboard'); ?>" class="btn btn-secondary btn-sm float-right mr-1">Back</a>
					<?= form_close(); ?>
		</div>
	</main>
	<?= $this->endSection(); ?>