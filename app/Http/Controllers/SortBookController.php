<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Publisher;

class SortBookController
{
    public function show(Publisher $publisher)
    {
        return view('Customer.publisher.show', compact('publisher'));
    }
}
