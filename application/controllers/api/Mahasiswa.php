<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mahasiswa_model', 'mahasiswa');
  }
  public function index_get()
  {
    $id = $this->get('id');

    if ($id === null) {
      $mahasiswa = $this->mahasiswa->getMahasiswa();
    } else {
      $mahasiswa = $this->mahasiswa->getMahasiswa($id);
    }

    if ($mahasiswa) {
      $this->response([
        'status' => TRUE,
        'data' => $mahasiswa,
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'id not found',
      ], RestController::HTTP_NOT_FOUND);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id');

    if ($id === null) {
      $this->response([
        'status' => FALSE,
        'message' => 'provide an id'
      ], RestController::HTTP_BAD_REQUEST);
    } else {
      if ($this->mahasiswa->deleteMahasiswa($id) > 0) {
        $this->response([
          'status' => TRUE,
          'id' => $id,
          'message' => 'deleted'
        ], RestController::HTTP_OK);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'id not found'
        ], RestController::HTTP_BAD_REQUEST);
      }
    }
  }

  public function index_post()
  {
    $data = [
      'nama' => $this->post('nama'),
      'nim' => $this->post('nim'),
      'email' => $this->post('email'),
      'jurusan' => $this->post('jurusan'),
      'saldo_kas' => $this->post('saldo_kas')
    ];

    if ($this->mahasiswa->createMahasiswa($data) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'new mahasiswa has been created'
      ], RestController::HTTP_CREATED);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'failed to create new data!'
      ], RestController::HTTP_BAD_REQUEST);
    }
  }

  public function index_put()
  {
    $id = $this->put('id');
    $data = [
      'nama' => $this->put('nama'),
      'nim' => $this->put('nim'),
      'email' => $this->put('email'),
      'jurusan' => $this->put('jurusan'),
      'saldo_kas' => $this->put('saldo_kas')
    ];

    if ($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'mahasiswa has been updated'
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'failed to update mahasiswa!'
      ], RestController::HTTP_BAD_REQUEST);
    }
  }
  public function updateKas_put()
  {
    $tambah = $this->put('tambah');
    $nama = $this->put('nama');

    if ($this->mahasiswa->updateKas($tambah, $nama) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'cash has been updated'
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => FAlSE,
        'message' => 'failed to update cash!!!'
      ], RestController::HTTP_NOT_FOUND);
    }
  }
}
