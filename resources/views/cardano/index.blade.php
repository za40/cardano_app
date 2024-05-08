<!DOCTYPE html>
<html>

<head>
    <title>Cardano NFTs and Tokens</title>
</head>

<body>
    <h1>Enter Cardano Stake Key</h1>
    <form action="{{ route('assets.show') }}" method="POST">
        @csrf
        <label for="stake_key">Stake Key:</label>
        <input type="text" id="stake_key" name="stake_key"
            value="stake1u9uz4j024qfud557ucrqw3kqfdndjgaxj7m44x7tamkvmyqzdwe7v" required size="60">
        <button type="submit">Fetch NFTs and Tokens</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>