<?php

namespace App\Livewire\Landing;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Credentials\TokenCredentials;
use Livewire\Component;
use App\Models\VinylRecord;
use App\Models\PriceHistory;

use Illuminate\Support\Facades\Log;

class TopCollectedVinyl extends Component {
    public $topVinyl = [];
    private $consumerKey;
    private $consumerSecret;
    private $client;
    private $baseUri = 'https://api.discogs.com';

    public function mount() {
        $this->consumerKey = env('DISCOGS_CONSUMER_KEY');
        $this->consumerSecret = env('DISCOGS_CONSUMER_SECRET');

        $this->client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        // $this->setPriceHistory();
        $this->getRandomVinyl();
        // $this->getEbayTrending();
        // Get first 4 from database in array
        // $this->topVinyl = VinylRecord::take(4)->get()->toArray();
    }

    public function getRandomVinyl() {
        $url = '/database/search';
        $params = [
            'query' => 'vinyl',
            'format' => 'vinyl',
            'sort' => 'have',
            'sort_order' => 'desc',
            'type' => 'release',
            'year' => 2024,
            'per_page' => 25,
            'page' => 1
        ];
    
        try {
          $response = $this->client->get($url, [
            'headers' => [
              'Authorization' => 'Discogs key=' . $this->consumerKey . ', secret=' . $this->consumerSecret,
              'User-Agent' => 'VinylWatchdog/1.0'
            ],
            'query' => $params
          ]);
    
          $statusCode = $response->getStatusCode();
          $body = $response->getBody()->getContents();
    
          $data = json_decode($body, true);

          if (isset($data['results'])) {
            foreach ($data['results'] as $item) {
              $parts = explode('-', $item['title']);
              $title = trim($parts[1]);
              $artist = trim($parts[0]);
              // Check if record is in the database by seeing if there is a name that is the same as the title
              $record = VinylRecord::where('discogs_id', $item['id'])->first();

              if (!$record) {
                $lowestPrice = $this->getLowestPrice($item['id']);
                $discogsInfo = $this->getDiscogsInfo($item['id']);
    
                $record = VinylRecord::create([
                  'discogs_id' => $item['id'],
                  'title' => $title,
                  'artist' => $artist,
                  'genre' => $item['genre'][0] ?? null,
                  'pressing' => $discogsInfo['pressing'] ?? null,
                  'year' => $discogsInfo['year'] ?? null,
                  'cover_image' => $item['cover_image'],
                  'discogs_link' => $discogsInfo['link'],
                  'lowest_price' => $lowestPrice['value'],
                  'lowest_price_currency' => $lowestPrice['currency'],
                  'tracklist' => json_encode($discogsInfo['tracklist'])
                ]);
              }
            }
          }
  
          // Log::info($data['results']);
          // return $finalVinylData ?? [];
        } catch (\Exception $e) {
          Log::error('Error fetching Discogs data: ' . $e->getMessage());
          return [];
        }
      }
    
      private function getLowestPrice($releaseId) {
        $url = "/marketplace/stats/$releaseId";
    
        try {
          $response = $this->client->get($url, [
            'headers' => [
              'Authorization' => 'Discogs key=' . $this->consumerKey . ', secret=' . $this->consumerSecret,
              'User-Agent' => 'VinylWatchdog/1.0'
            ]
          ]);
    
          $data = json_decode($response->getBody()->getContents(), true);
          
          return $data['lowest_price'] ?? null;
        } catch (\Exception $e) {
          Log::error('Error fetching lowest price for release ' . $releaseId . ': ' . $e->getMessage());
          return null;
        }
      }

      public function getDiscogsInfo($releaseId) {
        $url = "/releases/$releaseId";
        $response = $this->client->get($url, [
          'headers' => [
            'Authorization' => 'Discogs key=' . $this->consumerKey . ', secret=' . $this->consumerSecret,
            'User-Agent' => 'VinylWatchdog/1.0'
          ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $discogsInfo = [];

        // Log::info('data: ' . print_r($data, true));
        $variantPressing = '';

        $variantFormat = $data['formats'] ?? null;
        if ($variantFormat && is_array($variantFormat)) {
            $variantFormat = $variantFormat[0];

            // Loop through descriptions and keep everything that isn't LP or Album
            foreach ($variantFormat['descriptions'] as $description) {
                if (!in_array($description, ['LP', 'Album'])) {
                    // If variantPressing is empty add it on, if not add a comma first
                    $variantPressing .= $variantPressing ? ', ' . $description : $description;
                }
            }

            // Check if there is text and add that onto variantPressing
            if (isset($variantFormat['text'])) {
                $variantPressing .= $variantPressing ? ', ' . $variantFormat['text'] : $variantFormat['text'];
            }
        }

        $discogsInfo['pressing'] = $variantPressing;
        $discogsInfo['year'] = $data['year'];
        $discogsInfo['link'] = $data['uri'];

        // Create tracklist with position and title
        $tracklist = [];

        foreach ($data['tracklist'] as $track) {
          $tracklist[] = [
            'position' => $track['position'],
            'title' => $track['title'],
            'duration' => $track['duration']
          ];
        }
        
        $discogsInfo['tracklist'] = $tracklist;

        return $discogsInfo;
      }

    public function setPriceHistory() {
      // Loop through all vinyl records and create a new price history entry
      $vinylRecords = VinylRecord::all();

      foreach ($vinylRecords as $vinylRecord) {
          PriceHistory::create([
            'vinyl_record_id' => $vinylRecord->id,
            'source' => 'discogs',
            'price' => $vinylRecord->lowest_price,
            'currency' => $vinylRecord->lowest_price_currency
          ]);
      }
    }

    public function render() {
        return view('livewire.landing.top-collected-vinyl');
    }
}