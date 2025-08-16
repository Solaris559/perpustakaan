<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is logged in
        // If not, redirect to the login page with a flash message
        if (!session()->get('username')) {
            return redirect()->to('/')->with('gagal', 'Anda harus login terlebih dahulu');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
        // This method can be used for post-processing after the request has been handled.
        // Currently, it does not perform any actions.
    }
}
