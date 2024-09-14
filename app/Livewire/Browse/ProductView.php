<?php

namespace App\Livewire\Browse;

use Livewire\Component;
use App\Models\VinylRecord;
use App\Models\UserFavorite;

class ProductView extends Component {
    protected $listeners = ['refresh-product-view' => '$refresh'];

    public $vinylId;
    public $slug;
    public $title;
    public $artist;
    public $coverImage;
    public $lowestPrice;
    public $discogsLink;
    public $ebayLink;
    public $amazonLink;
    public $tracklist;
    public $user;
    public $currUserFavorite;
    public $userFavoritesCount;

    public function mount($vinylId, $slug) {
        $this->vinylId = $vinylId;
        $this->slug = $slug;
        $this->user = auth()->user();

        $vinyl = VinylRecord::where('id', $vinylId)->firstOrFail();

        $this->title = $vinyl->title;
        $this->artist = $vinyl->artist;
        $this->coverImage = $vinyl->cover_image;
        $this->lowestPrice = $vinyl->lowest_price;
        $this->discogsLink = $vinyl->discogs_link;
        $this->ebayLink = $vinyl->ebay_link;
        $this->amazonLink = $vinyl->amazon_link;
        $this->tracklist = json_decode($vinyl->tracklist) ?? [];
        $this->currUserFavorite = $this->user ? $this->user->userFavorites()->where('vinyl_record_id', $this->vinylId)->first() : null;
        $this->userFavoritesCount = UserFavorite::where('vinyl_record_id', $vinylId)->count();
    }

    public function toggleFavorite() {
        if (!$this->user) {
            // Dispatch event to show pop up asking to log in
            return;
        }
        
        if ($this->currUserFavorite) {
            $this->currUserFavorite->delete();
        } else {
            UserFavorite::create([
                'user_id' => $this->user->id,
                'vinyl_record_id' => $this->vinylId
            ]);
        }

        $this->currUserFavorite = $this->user->userFavorites()->where('vinyl_record_id', $this->vinylId)->first();
        $this->userFavoritesCount = UserFavorite::where('vinyl_record_id', $this->vinylId)->count();
        $this->dispatch('refresh-product-view');
    }

    public function render() {
        return view('livewire.browse.product-view')
            ->layout('layouts.main');
    }
}