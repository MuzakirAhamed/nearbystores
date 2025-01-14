<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::where('status', 1)->get();
        return view('store.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable'
        ]);
        Store::create([
            'store_name' => $request->input('store_name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'address' => $request->input('address'),
            'status' => 1
        ]);
        $request->session()->flash('message', 'Store location stored successfully!!');
        return redirect()->route('store.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = Store::find($id);
        return view('store.show', ['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store = Store::find($id);
        return view('store.edit', ['store' => $store]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'edit_store_name' => 'required',
            'edit_latitude' => 'required|numeric|between:-90,90',
            'edit_longitude' => 'required|numeric|between:-180,180',
            'edit_address' => 'nullable'
        ]);
        $store = Store::find($id);

        $store->update([
            'store_name' => $request->input('edit_store_name'),
            'latitude' => $request->input('edit_latitude'),
            'longitude' => $request->input('edit_longitude'),
            'address' => $request->input('edit_address'),
        ]);
        $request->session()->flash('message', 'Store location updated successfully!!');
        return redirect()->route('store.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $deleteStore = Store::find($id);
        $deleteStore->status = 0;
        $deleteStore->save();
        $request->session()->flash('message', 'Student deleted successfully');
        return redirect()->route('store.index');
    }
}
