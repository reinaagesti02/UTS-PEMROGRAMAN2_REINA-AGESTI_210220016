<?php
namespace App\Controllers;
use App\Models\DosenModel;

class Dosen extends BaseController
{
    /**
	 * index function
	 */
	public function index()
	{
	    //model initialize
		$DosenModel = new DosenModel();
		$pager = \config\Services::pager();
		
		$data = array(
		    'DosenModel' => $DosenModel->paginate(2, 'dosen'),
			'pager' => $DosenModel->pager
		);
		
		return view('dosen', $data);
	}
	public function update($id) 
	{
		$model = new DosenModel();
		$data['dosen'] = $model->getDosenById($id)->getRow(); //ambil function getMahasiswaById di model
        echo view('edit_dosen_view', $data);
	}
	public function edit() 
	{
		$model = new DosenModel();
        $id = $this->request->getPost('id_dosen');
        $data = array(
            'nama_dosen'  => $this->request->getPost('nama_dosen'),
            'jabatan' => $this->request->getPost('jabatan'),
			'no_telepon' => $this->request->getPost('no_telepon'),
        );
        $model->updateDosen($data, $id);
        return redirect()->to('/dosen');
	}
	public function delete($id) 
	{
		$model = new DosenModel();
        $model->deleteDosen($id);
        return redirect()->to('/dosen');
	}
	public function input()
	{
		echo view('input_dosen');
	}

	public function insert()
	{
		$model = new DosenModel();
		//$id = $this->request->getPost('id');
		$data = array (
			'nama_dosen'  => $this->request->getPost('nama_dosen'),
			'jabatan' => $this->request->getPost('jabatan'),
			'no_telepon' => $this->request->getPost('no_telepon'),
		);
		$model->insertDosen($data);
		return redirect()->to('/dosen');   
	}

    }
    

?>
	