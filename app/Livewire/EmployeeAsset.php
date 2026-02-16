<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\AssetIssue;
use Livewire\Component;

class EmployeeAsset extends Component
{
    public $user;

    private $asset;

    public $showAsset = false;

    public $description;

    public $userId;

    public $assetId;

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
            'raised_by' => auth()->user()->id,
        ]);
        $this->asset = $asset;
        $this->dispatch('IssueRaiseSuccess', __('Issue has been submitted for review'));
    }

    public function render()
    {
        $asset = null;
        if ($this->showAsset) {
            $asset = $this->asset;
        }

        return view('livewire.employee-asset', compact(
            'asset'
        ));
    }
}
