<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ListCardanoNFTsAndTokens extends Command
{
    protected $signature = 'cardano:list {stakeKey}';
    protected $description = 'List all NFTs and tokens of a Cardano wallet by stake key';

    private $blockfrostApiUrl = 'https://cardano-mainnet.blockfrost.io/api/v0/';
    private $blockfrostApiKey;

    public function __construct()
    {
        parent::__construct();
        $this->blockfrostApiKey = env('BLOCKFROST_API_KEY');
    }

    public function handle()
    {
        $stakeKey = $this->argument('stakeKey');

        $response = Http::withHeaders([
            'project_id' => $this->blockfrostApiKey,
        ])->get("{$this->blockfrostApiUrl}accounts/{$stakeKey}");

        if ($response->failed()) {
            $this->error('Unable to fetch account data. Check the stake key or API key.');
            return;
        }

        $this->info("Fetching NFTs and tokens for stake key: {$stakeKey}...");

        $assetsResponse = Http::withHeaders([
            'project_id' => $this->blockfrostApiKey,
        ])->get("{$this->blockfrostApiUrl}accounts/{$stakeKey}/addresses/assets");

        if ($assetsResponse->failed()) {
            $this->error('Unable to fetch assets data.');
            return;
        }

        $assets = $assetsResponse->json();
        $this->info("\nAssets:");
        foreach ($assets as $asset) {
            $this->info("- Asset: {$asset['unit']}, Quantity: {$asset['quantity']}");
        }

        $this->info("\nDone.");
    }
}
