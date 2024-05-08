<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CardanoAssetController extends Controller
{
    private $blockfrostApiUrl = 'https://cardano-mainnet.blockfrost.io/api/v0/';
    private $blockfrostApiKey;

    public function __construct()
    {
        $this->blockfrostApiKey = env('BLOCKFROST_API_KEY');
    }

    public function index()
    {
        return view('cardano.index');
    }

    public function showAssets(Request $request)
    {
        $stakeKey = $request->input('stake_key');

        $response = Http::withHeaders([
            'project_id' => $this->blockfrostApiKey,
        ])->get("{$this->blockfrostApiUrl}accounts/{$stakeKey}");

        if ($response->failed()) {
            return back()->withErrors('Unable to fetch account data. Check the stake key or API key.');
        }

        $assetsResponse = Http::withHeaders([
            'project_id' => $this->blockfrostApiKey,
        ])->get("{$this->blockfrostApiUrl}accounts/{$stakeKey}/addresses/assets");

        if ($assetsResponse->failed()) {
            return back()->withErrors('Unable to fetch assets data.');
        }

        $assets = $assetsResponse->json();
        return view('cardano.assets', compact('assets', 'stakeKey'));
    }
}
