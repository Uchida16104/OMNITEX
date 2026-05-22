<?php

namespace App\Services;

class NetworkRepairService
{
    public function analyze(): array
    {
        return [
            'status' => 'ok',
            'repair' => 'not required'
        ];
    }
}
