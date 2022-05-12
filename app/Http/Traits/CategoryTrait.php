<?php

namespace App\Http\Traits;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait CategoryTrait
{

    public function getCategoryData(Request $request)
    {
        return $request->except("_token");
    }

}

