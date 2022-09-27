<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Select extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dynamic_model');
    }

    public function index()
    {
        $data['provinsi'] = $this->Dynamic_model->getDataProv();
        $data['penduduk'] = $this->Dynamic_model->tampil();

        // var_dump($data['penduduk']);
        $this->load->view('dynamicselect/getdata', $data);
    }

    public function getKabupaten()
    {
        $idprov = $this->input->post('id');
        $data = $this->Dynamic_model->getDatakabupaten($idprov);
        $output = '<option value="">--Pilih Kabupaten-- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '"> ' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getKecamatan()
    {
        $idkabupaten = $this->input->post('id');
        $data = $this->Dynamic_model->getDatakecamatan($idkabupaten);
        $output = '<option value="">--Pilih Kecamatan-- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '"> ' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getDesa()
    {
        $idkecamatan = $this->input->post('id');
        $data = $this->Dynamic_model->getDataDesa($idkecamatan);
        $output = '<option value="">--Pilih Desa-- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '"> ' . $row->nama . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function tambah()
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $nik = $this->input->post('nik');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $desa = $this->input->post('desa');

        $data = array(
            'nama_penduduk' => $nama,
            'alamat' => $alamat,
            'nik' => $nik,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
        );

        $this->Dynamic_model->tambah($data, 'master_penduduk');
        redirect('select');
    }

    public function hapus($id)
    {
        $id = $this->uri->segment(3);
        $this->db->delete('master_penduduk', ['id_penduduk' => $id]);
        redirect('select');
    }

    public function edit($id)
    {
        $id = $this->uri->segment(3);
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $nik = $this->input->post('nik');

        $data = array(
            'nama_penduduk' => $nama,
            'alamat' => $alamat,
            'nik' => $nik,
        );

        $this->db->where('id_penduduk', $id);
        $this->db->update('master_penduduk', $data);
        redirect('select');
    }
}