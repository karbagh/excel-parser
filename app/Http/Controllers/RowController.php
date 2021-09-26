<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\View\View;

class RowController extends Controller
{

    public function index(): View
    {
        $rows = Row::paginate();

        return view('rows.index', compact('rows'));
    }
}
