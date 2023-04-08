<?php
namespace App\Controllers;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    /**
	 * index function
	 */
	public function index()
	{
	    //model initialize
		$MahasiswaModel = new MahasiswaModel();
		$pager = \config\Services::pager();
		
		$data = array(
		    'MahasiswaModel' => $MahasiswaModel->paginate(2, 'mahasiswa'),
			'pager' => $MahasiswaModel->pager
		);
		
		return view('mahasiswa', $data);
	}
	public function update($id) 
	{
		$model = new MahasiswaModel();
		$data['mahasiswa'] = $model->getMahasiswaById($id)->getRow(); //ambil function getMahasiswaById di model
        echo view('edit_mahasiswa_view', $data);
	}
	public function edit() 
	{
		$model = new MahasiswaModel();
        $id = $this->request->getPost('id_mahasiswa');
        $data = array(
            'nama'  => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
			'jurusan' => $this->request->getPost('jurusan'),
        );
        $model->updateMahasiswa($data, $id);
        return redirect()->to('/mahasiswa');
	}
	public function delete($id) 
	{
		$model = new MahasiswaModel();
        $model->deleteMahasiswa($id);
        return redirect()->to('/mahasiswa');
	}
	public function input()
	{
		echo view('input_mahasiswa');
	}

	public function insert()
	{
		$model = new MahasiswaModel();
		//$id = $this->request->getPost('id');
		$data = array (
			'nama'  => $this->request->getPost('nama'),
			'nim' => $this->request->getPost('nim'),
			'jurusan' => $this->request->getPost('jurusan'),
		);
		$model->insertMahasiswa($data);
		return redirect()->to('/mahasiswa');   
	}

    }
    

?>
	