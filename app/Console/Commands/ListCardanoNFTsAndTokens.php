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
    {}
}