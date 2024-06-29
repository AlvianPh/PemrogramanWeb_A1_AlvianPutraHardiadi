<?php

namespace App\Controllers;

use App\Models\TodoModel;

class Home extends BaseController
{
    public function index($id='')
    {
        $dataEdit = array();
        $todosModel = new TodoModel();
        $data = $todosModel->orderBy('id', 'desc')->findAll();
        $data = array_chunk($data, 4);
        if (is_numeric($id)) {
            $dataEdit = $todosModel->find($id);
        } 
        return view('todos', array("data" => $data, 'dataEdit' => $dataEdit));
    }

    public function store($id='')
    {
        $data = $this->request->getPost();
        $todosModel = new TodoModel();
        if (!empty($id) && is_numeric($id)) {

            $isDone = $todosModel->update($id, $data);
        } else {

            $isDone = $todosModel->insert($data);
        }

        if (!$isDone) {
            $errors = $todosModel->errors();
            session()->set('errorsMessages', $errors);
        }

        return redirect()->to('home');
    }

    public function delete($id)
    {
        $todosModel = new TodoModel();
        $todosModel->delete($id);
        session()->setFlashdata('successMesssage', 'Deleted Successfully');

        return redirect()->to('home');
    }
}
