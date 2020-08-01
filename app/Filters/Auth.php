<?php
namespace App\Filters;

class Auth implements \CodeIgniter\Filters\FilterInterface
{
	public function before(
		\CodeIgniter\HTTP\RequestInterface $request,
		$arguments = null
	) {
		$session = \Config\Services::session();
		$area = null;

		switch ($request->uri->getSegment(1)) {
			case 'admin':
				$area = $session->has('idUsuario') ?: "admin";
				break;

			default:
				$area = $session->has('id') ?: "";
				break;
		}

		if (is_string($area)) {
			$session->setFlashdata([
				'success' => false,
				'message' => 'CNPJ/CPF ou Senha inválido.'
			]);

			return redirect()->to(base_url($area));
		}

		return;
	}

	//--------------------------------------------------------------------

	public function after(
		\CodeIgniter\HTTP\RequestInterface $request,
		\CodeIgniter\HTTP\ResponseInterface $response,
		$arguments = null
	) {
		// Do something here
	}
}