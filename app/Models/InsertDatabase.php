<?php
namespace App\Models;

use CodeIgniter\Model;

class InsertDatabase extends Model
{
    //protected $table = 'utilisateurs';
        protected $table = 'utilisateur';
   	protected $allowedFields = ['name', 'birth', 'sexe', 'number', 'address'];

    public function insertUtilisateur($data)
    {
        return $this->insert($data);
    }
    	public function modify($id,$updat){
		return $this->update($id,$updat);
	}
}

