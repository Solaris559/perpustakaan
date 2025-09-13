<?php
namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = "petugas";
    protected $primaryKey = "id_petugas";

    protected $allowedFields = ['username', 'password', 'nama', 'role', 'foto'];
    public function cekLogin($username, $password)
    {

        $user = $this->db->table('petugas')
            ->where('username', $username)
            ->get()
            ->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return null;
        }

    }

    public function updatePetugas($id_petugas, $data)
    {
        return $this->db->table("buku")->where("id_petugas", $id_petugas)->update($data);
    }
}
