<?php

namespace App\Controllers;

use App\Models\PerspectiveModel;
use App\Models\ApartmentModel;

class Apartment extends BaseController
{
	protected $apartmentModel;
	protected $perspectiveModel;
	protected $statusColor;

	public function __construct()
	{
		$this->apartmentModel = new ApartmentModel();
		$this->perspectiveModel = new PerspectiveModel();

		$this->statusColor = [ '#f2383866', '#42a48799'];
		helper('form');		
	}

	public function index()
	{
		$data = [
			'title' => 'Upload Perspective Image',
			'all_data' => $this->perspectiveModel->findAll()
		];

		return view('apartment/perspective', $data);
	}

	public function upload_perspective(){
		$image = $this->request->getFile('photo');
		$imageName = $image->getRandomName();

		// check if it is valid image
		$f_size = getimagesize($image);
		$f_type =	$image->getMimeType();
		if ($f_type== "image/gif" OR $f_type== "image/png" OR $f_type== "image/jpeg" OR $f_type== "image/JPEG" OR $f_type== "image/PNG" OR $f_type== "image/GIF")
				$error=False;
		else $error=True;

		if ($error){
			return redirect()->to("perspective");
		}

		$data = [
			'title' => $this->request->getPost('title'),
			'image'		=> $imageName,
			'address'		=> $this->request->getPost('title'),
			'details'		=> $this->request->getPost('details'),
			'email'		=> $this->request->getPost('email'),
			'width'		=> $f_size[0],
			'height'		=> $f_size[1],
		];

		$this->perspectiveModel->insert($data);

		$image->move('images/perspective', $imageName);
		
		return redirect()->to("apartments");
	}

	public function apartments(){

		if (!session()->get('user')){
			return redirect()->to("/login");
		}

		$data = [
			'title' => 'Apartment Settings',
			'perspective' => $this->perspectiveModel->orderBy('id', 'desc')->findAll()[0],
			'apartments' => $this->apartmentModel->findAll(),
			'statusColor' => $this->statusColor
		];
		// var_dump($data['perspective']);
		// die();
		return view("apartment/apartments", $data);
	}
	public function preview(){
		/*
		$apartments = $this->apartmentModel->where('status', 0)->findAll();
		foreach($apartments as $apart){
			$imgPath = "images/apartments/" . $apart['image'];
			$imgInfo = \Config\Services::image('')
				->withFile($imgPath)
				->getFile()
				->getProperties(true);

			$tarWidth = 200;
			$tarHeight = 200 / $imgInfo['width'] *	$imgInfo['height'];


			$image = \Config\Services::image()
			->withFile($imgPath)
			->fit($tarWidth,$tarHeight,'center')
			->save('images/apartments/resized/preview-' . $apart['image']);
		}
		*/


		if (!session()->get('user')){
			return redirect()->to("/login");
		}

		$min_good_sqm = $this->apartmentModel->where('status', 1)
			->orderBy('good_sqm', 'asc')
			->find()[0]['good_sqm'];
		$max_good_sqm = $this->apartmentModel->where('status', 1)
			->orderBy('good_sqm', 'desc')
			->find()[0]['good_sqm'];
		$min_price = $this->apartmentModel->where('status', 1)
			->orderBy('price', 'asc')
			->find()[0]['price'];
		$max_price = $this->apartmentModel->where('status', 1)
			->orderBy('price', 'desc')
			->find()[0]['price'];
		$min_bedroom = $this->apartmentModel->where('status', 1)
			->orderBy('bedroom', 'asc')
			->find()[0]['bedroom'];
		$max_bedroom = $this->apartmentModel->where('status', 1)
			->orderBy('bedroom', 'desc')
			->find()[0]['bedroom'];

		$data = [
			'title' => 'Preview Apartments',
			'perspective' => $this->perspectiveModel->orderBy('id', 'desc')->findAll()[0],
			'apartments' => $this->apartmentModel->findAll(),  //->orderBy('status', 'desc')
			'availableApartments' => $this->apartmentModel->where('status', 1)->findAll(),
			'soldApartments' => $this->apartmentModel->where('status', 0)->findAll(),
			'statusColor' => $this->statusColor,
			'min_good_sqm' => floor($min_good_sqm - 1),
			'max_good_sqm' => ceil($max_good_sqm),
			'min_price' => $min_price,
			'max_price' => $max_price,
			'min_bedroom' => $min_bedroom,
			'max_bedroom' => $max_bedroom,
		];
		// var_dump($data['perspective']);
		// die();
		return view("apartment/preview", $data);
	}

	public function save_details()
	{
		$image = $this->request->getFile('image');
		$imageName = $image->getRandomName();

		$image->move('images/apartments', $imageName);


		$imgPath = "images/apartments/" . $imageName;
		$imgInfo = \Config\Services::image('')
			->withFile($imgPath)
			->getFile()
			->getProperties(true);

		$tarWidth = 200;
		$tarHeight = 200 / $imgInfo['width'] *	$imgInfo['height'];


		$image = \Config\Services::image()
		->withFile($imgPath)
		->fit($tarWidth,$tarHeight,'center')
		->save('images/apartments/resized/preview-' . $imageName);
			

		$apart_id = str_replace(' ', '', strtolower($this->request->getPost('title')));
		$path = $this->request->getPost('path');

		if ($this->apartmentModel->where('apart_id', $apart_id)->find()){
			session()->setFlashData("error", "Duplicate house title, Input another title!");
			return redirect()->to('apartments');
		}

		if ($path == ""){
			session()->setFlashData("error", "Empty path, draw the region first!");
			return redirect()->to('apartments');				
		}

		$newData = [
			'title' =>	$this->request->getPost('title'),
			'apart_id' =>	$apart_id,
			'path' =>	$path,
			'price' =>	$this->request->getPost('price'),
			'cost' =>	$this->request->getPost('cost'),
			'bedroom' =>	$this->request->getPost('bedroom'),
			'good_sqm' =>	$this->request->getPost('good_sqm'),
			'room_sqm' =>	$this->request->getPost('room_sqm'),
			'terrace_sqm' =>	$this->request->getPost('terrace_sqm'),
			'balcony_sqm' =>	$this->request->getPost('balcony_sqm'),
			'floor' =>	$this->request->getPost('floor'),
			'story' =>	$this->request->getPost('story'),
			'address' =>	$this->request->getPost('address'),
			'image' =>	$imageName,
		];

		$result = $this->apartmentModel->insert($newData);

		if ($result){
			return redirect()->to('apartments');	
		}

		session()->setFlashData("error", "Internal Server Error!");
		return redirect()->to('apartments');	

	}

	public function delete($apartId='')
	{
		// code...
		$apart = $this->apartmentModel->where('id', $apartId)->find();
		if (!$apart){
			session()->setFlashData("error", "Invalid Operation Detected!");
			return redirect()->to('apartments');
		}
		$this->apartmentModel->where('id', $apartId)->delete();
		return redirect()->to('apartments');
	}

	public function view_apartment($apartId = "")
	{
		$apart = $this->apartmentModel->where('apart_id', $apartId)->find();
		if (!$apart){
			session()->setFlashData("error", "Invalid Operation Detected!");
			return redirect()->to('apartments');
		}

		$data = [
			'perspective' => $this->perspectiveModel->orderBy('id', 'desc')->findAll()[0],
			'title' => 'View Apartment',
			'apart' => $apart[0],
		];
		return view('apartment/view_apartment', $data);

	}
}
