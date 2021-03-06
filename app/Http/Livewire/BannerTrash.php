<?php

namespace App\Http\Livewire;

use App\Models\Banner;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class BannerTrash extends Component
{
    protected $listeners = ['forceDeleteBanner'];

    public function restoreBanner($id)
    {
        Banner::onlyTrashed()->find($id)->restore();
        Cache::forget('bannerCache');

        session()->flash('message', 'Banner Item has been restored');
    }
    public function confirmForceDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are Your sure',
            'text' => "You won't be able to revert this action!",
            'id' => $id,
        ]);
    }
    public function forceDeleteBanner($id)
    {
        Banner::onlyTrashed()->find($id)->forceDelete();
        Cache::forget('bannerCache');

        session()->flash('message', 'Banner Item has been permanently Deleted');
    }
    public function render()
    {
        return view('livewire.banner-trash', ['banners' => Banner::onlyTrashed()->latest()->toBase()->simplePaginate()]);
    }
}
