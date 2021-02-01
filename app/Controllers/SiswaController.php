<?php namespace App\Controllers;

use App\Models\SiswaModel;
use Dompdf\Dompdf;
// use CodeIgniter\CodeIgniter;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SiswaController extends BaseController
{
    protected $optionPusher;
    protected $pusher;
    protected $siswaModel;

    public function __construct() {

        // inisialisasi Pusher
        $this->optionPusher = [
            'cluster' => 'ap1',
            'useTLS'  => true
        ];

        $this->pusher = new \Pusher\Pusher(
            '21462231767a3927aeb6', #ganti dengan key pusher channel anda
            '65c86d94bb3ddddcba6b', #ganti dengan secret pusher channel anda
            '1147591', #ganti dengan app_id pusher channel anda
            $this->optionPusher,
        );

        $this->siswaModel = new SiswaModel();
    }

    public function index() {
        echo view('pages/siswa/index');
    }

    public function getSiswa() {

        if(!$this->request->isAJAX())
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forControllerNotFound('Siswa','getSiswa');
        }

        $data = [
            'siswa' => $this->siswaModel->findAll(),
        ];
        return json_encode($data);
    }

    public function create() {
        echo view('pages/siswa/create');
    }

    public function save() {

        // Validation
        
        $rules = [
            'nisn' => 'required|is_unique[siswa.nisn]',
            'nama' => 'required',
            'alamat' => 'required'
        ];   

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        echo current_url();
        $data = [
            'nisn' => $this->request->getPost('nisn'),
            'name' => $this->request->getPost('nama'),
            'address' => $this->request->getPost('alamat'),
        ];

        $this->siswaModel->insert($data);

        // Pusher
        $data["message"] = "success";
        $this->pusher->trigger('my-channel','my-event',$data);

        return redirect()->route('siswa');
    }

    public function edit(int $nisn) {
        $checkSiswa = $this->siswaModel->find($nisn);

        if(empty($checkSiswa)) {
            throw new \Exception("Invalid NISN",404);
        }

        $data = [
            'siswa' => $checkSiswa,
        ];

        echo view('pages/siswa/edit',$data);
    }

    public function update(int $nisn) {
        
        // check nisn di edit atau tidak

        $newNisn = $this->request->getPost('nisn');
        if($nisn == $newNisn) {
            $nisnRule = 'required';
        } else {
            $nisnRule = 'required|is_unique[siswa.nisn]';
        }

        $rules = [
            'nisn' => $nisnRule,
            'nama' => 'required',
            'alamat' => 'required'
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput();
        }

        $objects = [
            'nisn' => $newNisn,
            'name' => $this->request->getPost('nama'),
            'address' => $this->request->getPost('alamat')
        ];

        $this->siswaModel->update($nisn,$objects);

        // pusher
        $data['message'] = 'success';
        $this->pusher->trigger('my-channel','my-event',$data);

        return redirect()->route('siswa');
    }

    public function delete(int $nisn) {

        $this->siswaModel->delete($nisn);

        // Pusher
        $data['message'] = 'success';
        $this->pusher->trigger('my-channel','my-event',$data);

        return redirect()->route('siswa')->with('notif','Berhasil Menghapus Data');
    }


    public function detail(int $nisn) {

        $checkSiswa = $this->siswaModel->find($nisn);

        if(empty($checkSiswa)) {
            throw new \Exception("Invalid NISN",404);
        }

        $data = ['siswa' => $checkSiswa];
        echo view('pages/siswa/detail',$data);
    }

    // Export

    public function exportExcel() {
        
        $dataSiswa = $this->siswaModel->findAll();


        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // Cell 
        $sheet->setCellValue('A1','Nisn');
        $sheet->setCellValue('B1','Nama');
        $sheet->setCellValue('C1','Alamat');

        $index = 2;
        foreach($dataSiswa as $siswa) {
            $sheet->setCellValue('A'.$index,$siswa["nisn"]);
            $sheet->setCellValue('B'.$index,$siswa["name"]);
            $sheet->setCellValue('C'.$index,$siswa["address"]);
            $index ++;
        }
        

        $writer = new Xlsx($spreadsheet);
        $filename = "daftar-siswa";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function exportPdf() {
        $domPDF = new Dompdf();

        $data = ["siswa" => $this->siswaModel->findAll()];
        $domPDF->loadHtml(view('export/pdf',$data));

        $domPDF->setPaper('A4','portrait');
        $domPDF->render();
        $domPDF->stream();
    }
}