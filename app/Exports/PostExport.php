<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class PostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->type == "0") {
            return Post::all();
        }
        else {
            return Post::where('create_user_id', Auth::user()->id)->get();
        }
    }
}
