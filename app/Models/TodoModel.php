<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model 
{
    protected $table      = 'todos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['todoname', 'description'];
    
    protected $validationRules    = [
        'todoname' => 'required|min_length[3]',
        'description' => 'permit_empty|min_length[3]',
    ];

    protected $validationMessages = [
        'todoname' => [
            'min_length' => 'Todo name must have minimum 3 characters.',
        ],
        'description' => [
            'min_length' => 'Description must have minimum 3 characters.',
        ],
    ];
}