<?php

class Mahasiswa_model extends CI_Model
{
  public function getMahasiswa($id = null)
  {
    if ($id === null) {
      $mahasiswa = $this->db->get('mahasiswa')->result_array();
    } else {
      $mahasiswa = $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
    }
    return $mahasiswa;
  }

  public function deleteMahasiswa($id)
  {
    $this->db->delete('mahasiswa', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function createMahasiswa($data)
  {
    $this->db->insert('mahasiswa', $data);
    return $this->db->affected_rows();
  }

  public function updateMahasiswa($data, $id)
  {
    $this->db->update('mahasiswa', $data, ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function updatekas($tambah, $nama)
  {
    $hasil = $this->db->get_where('mahasiswa', ['nama' => $nama])->result_array();
    $kas = $hasil[0]['saldo_kas'];

    $this->db->update('mahasiswa', ['saldo_kas' => $kas + $tambah], ['nama' => $nama]);
    return $this->db->affected_rows();
  }
}
