<?php

namespace App\Livewire\Landing;

use GuzzleHttp\Client;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Credentials\TokenCredentials;
use Livewire\Component;
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

        // $this->topVinyl = $this->getRandomVinyl();
        $this->topVinyl = $this->getTestData();
    }

    public function getTestData() {
        return [
            [
                'title' => 'Daft Punk - Random Access Memories',
                'cover_image' => 'https://i.discogs.com/zFVZE4s0zSXUIM7OMl2UDckSq0zlopdHBHRz23zqMJk/rs:fit/g:sm/q:90/h:600/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTQ1NzAz/NjYtMTUzOTI5NTA5/Mi02MDg3LnBuZw.jpeg',
                'link' => 'https://api.discogs.com/releases/4570366',
                'lowest_price' => [
                    'value' => 32.5,
                    'currency' => 'USD',
                ]
            ],
            [
                'title' => 'Pink Floyd - The Dark Side Of The Moon',
                'cover_image' => 'https://i.discogs.com/1fwskTLM6cfxbdNmBDJ8expl6wab0tEgxvuloLIqKh8/rs:fit/g:sm/q:90/h:596/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTkyODc4/MDktMTQ3OTc1MzIz/Ni05NjE3LmpwZWc.jpeg',
                'link' => 'https://api.discogs.com/releases/9287809',
                'lowest_price' => [
                    'value' => 15.75,
                    'currency' => 'USD',
                ]
            ],
            [
                'title' => 'Kendrick Lamar - Good Kid, M.A.A.d City',
                'cover_image' => 'https://i.discogs.com/NlmkKrMlFUvKaaW5GUSKFRrMB1snZbF9Zx6_fMUsBtY/rs:fit/g:sm/q:90/h:588/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM5NzU5/NTMtMTU3MDQwNDUz/Ni01NDY1LmpwZWc.jpeg',
                'link' => 'https://api.discogs.com/releases/3975953',
                'lowest_price' => [
                    'value' => 5.88,
                    'currency' => 'USD',
                ]
            ],
            [
                'title' => 'Michael Jackson - Thriller',
                'cover_image' => 'https://i.discogs.com/OQRwID3TvI5bMrPxrDgtFRftYhjZlkQ1FPE81xPOY5I/rs:fit/g:sm/q:90/h:602/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTI5MTEy/OTMtMTU5NDI0NTgx/Mi03OTMxLmpwZWc.jpeg',
                'link' => 'https://api.discogs.com/releases/2911293',
                'lowest_price' => [
                    'value' => 5.0,
                    'currency' => 'USD',
                ]
            ]
        ];
    }

    public function getRandomVinyl($limit = 4) {
        $url = '/database/search';
        $params = [
            'query' => 'vinyl',
            'format' => 'vinyl',
            'sort' => 'have',
            'sort_order' => 'desc',
            'type' => 'release',
            'per_page' => 4,
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
    
          $finalVinylData = [];
          if ($data['results']) {
            foreach ($data['results'] as $item) {
              $releaseId = $item['id'];
              $lowestPrice = $this->getLowestPrice($releaseId);
    
              $finalVinylData[] = [
                  'title' => $item['title'],
                  'cover_image' => $item['cover_image'],
                  'link' => $item['resource_url'],
                  'lowest_price' => $lowestPrice,
              ];
            }
          }
    
          $finalVinylData = array_slice($finalVinylData, 0, $limit);

          Log::info($finalVinylData);
          return $finalVinylData ?? [];
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

    public function render() {
        return view('livewire.landing.top-collected-vinyl');
    }
}