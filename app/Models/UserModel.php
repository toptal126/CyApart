<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table         = 'users';
	protected $primaryKey    = 'id';
	protected $returnType    = 'array';
	protected $allowedFields = ['email', 'username', 'password_hash', 'active','deleted_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function attemptLogin($email, $password){
		$user = $this->db->table('users')->where('email', $email)->get()->getFirstRow();

		if (!$user){
			return ["type" => 0, "message" => "User not registered yet!"];
		}

		if(!password_verify($password, $user->password_hash)) {
			return ["type" => 0, "message" => "Invalied credentials!"];
		}

		return ["type" => 1, "message" => "Success!", "user"=> $user];

	}
}
