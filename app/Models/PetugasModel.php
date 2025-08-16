<?php
namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = "petugas";
    protected $primaryKey = "id";
    public function cekLogin($username, $password)
    {
        // This method retrieves a petugas (staff) record based on username and password.
        // It returns the first matching record as an associative array.
        // If no record is found, it returns null.
        // return $this->db->table("petugas")
        //     ->where(array('username' => $username, 'password' =>($password)))
        //     ->get()
        //     ->getRowArray();

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
}
