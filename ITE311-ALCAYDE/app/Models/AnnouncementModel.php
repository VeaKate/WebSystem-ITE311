<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table      = 'announcements';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Or 'object' if you prefer objects

    protected $allowedFields = [
        'title',
        'content',
        'created_at'
    ];

    // If using created_at field, but not updated_at
    protected $useTimestamps = false; // Set to true if you want CI4 to auto-manage timestamps
    protected $createdField  = 'created_at';
    // No updatedField, as migration does not create it

    // Optionally, validation rules
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'content' => 'permit_empty'
    ];
}