<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Asset;
use App\Enums\UserType;
use Illuminate\Http\Request;
use App\DataTables\AssetDataTable;
use App\Http\Controllers\Controller;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AssetDataTable $dataTable)
    {
        return $dataTable->render("pages.assets.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type','!=',UserType::SUPERADMIN)->where('is_active',1)->get();
        return view('pages.assets.create',compact(
            'users'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'purchase_date' => 'required|date',
            'purchase_from' => 'required',
            'manufacturer' => 'required',
            'model' => 'nullable|max:100',
            'serial_no' => 'nullable|max:50',
            'supplier' => 'nullable|max:200',
            'condition' => 'nullable|max:200',
            'warranty' => 'nullable',
            'cost' => 'required',
            'status' => 'required',
            'user' => 'required',
            'description' => 'nullable|max:255'
        ]);
        $dir = public_path("storage/assets");
        $fileNames = [];
        if(!empty($fileNames) && count($fileNames) > 0){
            foreach($request->astFiles as $key => $requestFile){
                if (!empty($requestFile)) {
                    $fileName = random_str(7) . '.' . $requestFile->extension();
                    array_push($fileNames, $fileName);
                    $requestFile->move($dir, $fileName);
                }
            }
        }
        $totalAsset = Asset::count();
        $assetId = "AST-" . pad_zeros(($totalAsset + 1));
        Asset::create([
            'ast_id' => $request->ast_id ?? $assetId,
            'name' => $request->name,
            'purchase_date' => $request->purchase_date,
            'purchase_from' => $request->purchase_from,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'serial_no' => $request->serial_no,
            'supplier' => $request->supplier,
            'ast_condition' => $request->condition,
            'warranty' => $request->warranty,
            'warranty_end' => $request->warranty_end,
            'brand' => $request->brand,
            'cost' => $request->cost,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user,
            'created_by' => auth()->user()->id,
            'files' => $fileNames
        ]);
        $notification = notify(__("Asset has been added"));
        return redirect()->route('assets.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('pages.assets.show',compact(
            'asset'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $users = User::where('type','!=',UserType::SUPERADMIN)->where('is_active',1)->get();
        return view("pages.assets.edit",compact(
            'asset','users'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name' => 'required|max:200',
            'purchase_date' => 'required|date',
            'purchase_from' => 'required',
            'manufacturer' => 'required',
            'model' => 'nullable|max:100',
            'serial_no' => 'nullable|max:50',
            'supplier' => 'nullable|max:200',
            'condition' => 'nullable|max:200',
            'warranty' => 'nullable',
            'cost' => 'required',
            'status' => 'required',
            'user' => 'required',
            'description' => 'nullable|max:255'
        ]);
        $dir = public_path("storage/assets");
        $fileNames = $asset->files ?? [];
        if(!empty($fileNames) && count($fileNames) > 0){
            foreach($request->astFiles as $key => $requestFile){
                if (!empty($requestFile)) {
                    $fileName = random_str(7) . '.' . $requestFile->extension();
                    array_push($fileNames, $fileName);
                    $requestFile->move($dir, $fileName);
                }
            }
        }
        $asset->update([
            'ast_id' => $request->ast_id,
            'name' => $request->name,
            'purchase_date' => $request->purchase_date,
            'purchase_from' => $request->purchase_from,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'serial_no' => $request->serial_no,
            'supplier' => $request->supplier,
            'ast_condition' => $request->condition,
            'warranty' => $request->warranty,
            'warranty_end' => $request->warranty_end,
            'brand' => $request->brand,
            'cost' => $request->cost,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user,
            'created_by' => auth()->user()->id,
            'files' => $fileNames,
        ]);
        $notification = notify(__("Asset has been updated"));
        return redirect()->route('assets.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        $notification = notify(__('Asset has been deleted'));
        return back()->with($notification);
    }
}
