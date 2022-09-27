<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dynamic_model extends CI_Model
{

    public function getDataProv()
    {
        return $this->db->get('wilayah_provinsi')->result_array();
    }

    public function getDatakabupaten($idprov)
    {
        return $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $idprov])->result();
    }

    public function getDatakecamatan($idkab)
    {
        return $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $idkab])->result();
    }

    public function getDataDesa($idkec)
    {
        return $this->db->get_where('wilayah_desa', ['kecamatan_id' => $idkec])->result();
    }

    public function tambah()
    {
        $data = [
            'nama_penduduk' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nik' => $this->input->post('nik'),
            'provinsi' => $this->input->post('provinsi'),
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'desa' => $this->input->post('desa')
        ];
        $this->db->insert('master_penduduk', $data);
    }

    public function tampil()
    {
        $this->db->select('master_penduduk.id_penduduk, master_penduduk.nama_penduduk, master_penduduk.alamat, master_penduduk.nik,wilayah_provinsi.nama AS provinsi,wilayah_kecamatan.nama AS kecamatan,wilayah_kabupaten.nama AS kabupaten,wilayah_desa.nama AS desa');
        $this->db->from('master_penduduk');
        $this->db->join('wilayah_provinsi', 'master_penduduk.provinsi = wilayah_provinsi.id');
        $this->db->join('wilayah_kabupaten', 'master_penduduk.kabupaten = wilayah_kabupaten.id');
        $this->db->join('wilayah_kecamatan', 'master_penduduk.kecamatan = wilayah_kecamatan.id');
        $this->db->join('wilayah_desa', 'master_penduduk.desa = wilayah_desa.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}