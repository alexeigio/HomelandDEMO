<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $responce = Http::get('https://localhost:3000/api/v1/employees');
        $employees = $responce->json();
        return view('employees.index', compact('employees'));
    }
}
