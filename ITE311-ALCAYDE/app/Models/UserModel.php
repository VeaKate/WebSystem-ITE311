<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;

    // Only allow these columns to be mass-assigned
    protected $allowedFields = ['username', 'email', 'password', 'role'];

    // Validate incoming form fields (including non-DB fields)
    protected $validationRules = [
        'username'         => 'required|min_length[3]|max_length[100]',
        'email'        => 'required|valid_email|is_unique[users.email]',
        'password'     => 'required|min_length[8]',
        'pass_confirm' => 'required|matches[password]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email is already taken.',
        ],
        'pass_confirm' => [
            'matches' => 'Passwords do not match.',
        ],
    ];

    protected $skipValidation = false;

    // Hash password on insert/update if provided
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
        $data['data']['password'] = password_hash(
            $data['data']['password'],
            PASSWORD_DEFAULT
        );
        unset($data['data']['pass_confirm']);
    }
    return $data;
    }
}
