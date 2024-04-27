<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
	protected $table = 'utilisateur';
 //['name', 'birth', 'sexe', 'number', 'address'];
   public function getdata(){
	return $this->findAll();
  }
  public function search($cherche,$number){
        return $this->like("name",$cherche['nom'])->orLike("birth",$cherche['nom'])->orLike("sexe",$cherche['nom'])->orLike("number",$cherche['nom'])->orLike("address",$cherche['nom'])->paginate($number);
	}
	public function supprimer($id){
		return $this->delete($id);
	}
	public function pagination($number){
		return $this->paginate($number);
	}
	public function counter(){
		return $this->countAllResults();
	}

}
