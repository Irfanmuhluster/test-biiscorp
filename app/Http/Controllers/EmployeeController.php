<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

// use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search.value');
        // dd($search);
        if ($request->ajax()) {
            $data = Employee::query();
            if (!empty($search)) {
                $data->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
                });
            }
            return DataTables::eloquent($data)->toJson();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                // Validasi data
                $validatedData = $request->validate([
                    'positions_id' => 'required',
                    'name'=>'required',
                    'email'=>'required',
                    'gander'=>'required',
                    'address'=>'required',
                    'birthdate' => 'required|date|date_format:Y-m-d',
                    'file' => 'required|file|mimes:jpg,png,gif|max:1048', 
                ]);
        
                // Simpan file gambar ke storage
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public'); 
                }
        
                $formData = Employee::create([
                    'position_id' => $request->positions_id, 
                    'birthdate' => $request->birthdate,
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gander,
                    'address' => $request->address,
                    'profile_img' => $filePath ?? null,
                ]);
        
                return response()->json([
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData,
                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
