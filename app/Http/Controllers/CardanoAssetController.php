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
        $assets = [];
        return view('cardano.assets', compact('assets', 'stakeKey'));
    }
}
