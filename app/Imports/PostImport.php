<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use \Illuminate\Support\Collection;

class PostImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Post::create([
                'title' => $row[0],
                'description' => $row[1],
                'status' => $row[2],
                'create_user_id' => Auth::user()->id,
                'updated_user_id' => Auth::user()->id,
            ]);
        }
    }
}
