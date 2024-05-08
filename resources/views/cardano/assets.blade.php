<!DOCTYPE html>
<html>
<head>
    <title>Cardano NFTs and Tokens</title>
</head>
<body>
    <h1>NFTs and Tokens for Stake Key: {{ $stakeKey }}</h1>
    <ul>
        @foreach ($assets as $asset)
            <li>Asset: {{ $asset['unit'] }}, Quantity: {{ $asset['quantity'] }}</li>
        @endforeach
    </ul>
    <a href="{{ url('/') }}">Go Back</a>
</body>
</html>
