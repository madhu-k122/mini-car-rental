<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSupplierRequest;
use App\Models\User;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = User::where('role', 'supplier')->orderBy('created_at', 'desc')->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(AdminSupplierRequest $request)
    {
        $data = $request->validated();
        $data["code"] = generateRandomStringCode(20);
        $data['role'] = 'supplier';
        $data['password'] = bcrypt($data['password']);
        $data['created_by'] = auth()->id();
        User::create($data);
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier added.');
    }

    public function edit(User $supplier)
    {
        return view('admin.suppliers.create', compact('supplier'));
    }

    public function update(AdminSupplierRequest $request, User $supplier)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $data['updated_by'] = auth()->id();
        $supplier->update($data);
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated.');
    }

    public function destroy(User $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully.']);
    }
}
