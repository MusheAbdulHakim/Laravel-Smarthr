<?php

namespace App\Livewire;

use App\Models\Asset;
use Livewire\Component;
use App\Models\AssetIssue;
use Illuminate\Support\Facades\Crypt;

class EmployeeAsset extends Component
{
    public $user;
    private $asset;

    public $showAsset = false;

    public $description, $userId, $assetId;

    public function viewAsset(Asset $asset)
    {
        $this->showAsset = true;
        $this->asset = $asset;
    }

    public function raiseIssue(Asset $asset)
    {
        AssetIssue::create([
            'asset_id' => $asset->id,
            'description' => $this->description,
            'raised_by' => auth()->user()->id
        ]);
        $notification = notify("Issue has been submitted for review");
        return redirect()
        ->route('employees.show', 
            ['employee' => Crypt::encrypt($asset->user->employeeDetail->id)])
            ->with($notification);
    }


    public function render()
    {
        $asset = null;
        if($this->showAsset){
            $asset = $this->asset;
        }
        return view('livewire.employee-asset',compact(
            'asset'
        ));
    }

}
