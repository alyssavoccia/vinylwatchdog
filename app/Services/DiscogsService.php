<?php

namespace App\Services;

use GuzzleHttp\Client;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Credentials\TokenCredentials;
use Illuminate\Support\Facades\Log;

class DiscogsService {
  protected $client;
  protected $baseUri = 'https://api.discogs.com';
  protected $consumerKey;
  protected $consumerSecret;

  public function __construct() {
      $this->consumerKey = env('DISCOGS_CONSUMER_KEY');
      $this->consumerSecret = env('DISCOGS_CONSUMER_SECRET');

      // Set up the Guzzle client
      $this->client = new Client([
          'base_uri' => $this->baseUri,
      ]);
  }

  public function getTopCollectedVinyl() {
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
}