<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Page icon -->
    <link rel="site icon" type="image/png" href="{{ asset('storage/bitcoin.png') }}">
    <link rel="site icon" sizes="192x192" href="{{ asset('storage/bitcoin.png') }}">

    <title>Crypto Exchanges</title>
</head>

<body>
    <header class="bg-secondary">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-4">
                    <h1 class="text-primary"><a href="{{ route('home') }}"
                            style="transition: all 0.2s ease-out; text-decoration: none;">Crypto exchanges</a></h1>
                </div>
            </div>
        </div>
    </header>
    <div class="mt-5 mx-2 mx-md-5">
        <table class="table table-light table-hover table-responsive-md">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Market Cap</th>
                    <th scope="col">VWAP (24hr)</th>
                    <th scope="col">Supply</th>
                    <th scope="col">Volume (24hr)</th>
                    <th scope="col">Change (24hr)</th>
                </tr>
            </thead>
            <tbody>
                <tr id="row-bitcoin">
                    <th scope="row">Bitcoin</th>
                    <td>{{ $bitcoin['priceUsd'] }}</td>
                    <td>{{ $bitcoin['marketCapUsd'] }}</td>
                    <td>{{ $bitcoin['vwap24Hr'] }}</td>
                    <td>{{ $bitcoin['supply'] }}</td>
                    <td>{{ $bitcoin['volumeUsd24Hr'] }}</td>

                    @if ($bitcoin['changePercent24Hr'] > 0)
                        <td class="text-success">{{ number_format($bitcoin['changePercent24Hr'], 2) }}%</td>
                    @else
                        <td style="color: #ff1100;">{{ number_format($bitcoin['changePercent24Hr'], 2) }}%</td>
                    @endif
                </tr>
                <tr id="row-ethereum">
                    <th scope="row">Ethereum</th>
                    <td>{{ $ethereum['priceUsd'] }}</td>
                    <td>{{ $ethereum['marketCapUsd'] }}</td>
                    <td>{{ $ethereum['vwap24Hr'] }}</td>
                    <td>{{ $ethereum['supply'] }}</td>
                    <td>{{ $ethereum['volumeUsd24Hr'] }}</td>

                    @if ($ethereum['changePercent24Hr'] > 0)
                        <td class="text-success">{{ number_format($ethereum['changePercent24Hr'], 2) }}%</td>
                    @else
                        <td style="color: #ff1100;">{{ number_format($ethereum['changePercent24Hr'], 2) }}%</td>
                    @endif
                </tr>
                <tr id="row-tether">
                    <th scope="row">Tether</th>
                    <td>{{ $tether['priceUsd'] }}</td>
                    <td>{{ $tether['marketCapUsd'] }}</td>
                    <td>{{ $tether['vwap24Hr'] }}</td>
                    <td>{{ $tether['supply'] }}</td>
                    <td>{{ $tether['volumeUsd24Hr'] }}</td>

                    @if ($tether['changePercent24Hr'] > 0)
                        <td class="text-success">{{ number_format($tether['changePercent24Hr'], 2) }}%</td>
                    @else
                        <td style="color: #ff1100;">{{ number_format($tether['changePercent24Hr'], 2) }}%</td>
                    @endif
                </tr>
                <tr id="row-binance-coin">
                    <th scope="row">Binance Coin</th>
                    <td>{{ $binance_coin['priceUsd'] }}</td>
                    <td>{{ $binance_coin['marketCapUsd'] }}</td>
                    <td>{{ $binance_coin['vwap24Hr'] }}</td>
                    <td>{{ $binance_coin['supply'] }}</td>
                    <td>{{ $binance_coin['volumeUsd24Hr'] }}</td>

                    @if ($binance_coin['changePercent24Hr'] > 0)
                        <td class="text-success">{{ number_format($binance_coin['changePercent24Hr'], 2) }}%</td>
                    @else
                        <td style="color: #ff1100;">{{ number_format($binance_coin['changePercent24Hr'], 2) }}%</td>
                    @endif
                </tr>
                <tr id="row-cardano">
                    <th scope="row">Cardano</th>
                    <td>{{ $cardano['priceUsd'] }}</td>
                    <td>{{ $cardano['marketCapUsd'] }}</td>
                    <td>{{ $cardano['vwap24Hr'] }}</td>
                    <td>{{ $cardano['supply'] }}</td>
                    <td>{{ $cardano['volumeUsd24Hr'] }}</td>

                    @if ($cardano['changePercent24Hr'] > 0)
                        <td class="text-success">{{ number_format($cardano['changePercent24Hr'], 2) }}%</td>
                    @else
                        <td style="color: #ff1100;">{{ number_format($cardano['changePercent24Hr'], 2) }}%</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Set events to click and redirect
        document.getElementById('row-bitcoin').onclick = function() {
            location.href = '{{route('home.show', $bitcoin['id'])}}';
        }

        document.getElementById('row-ethereum').onclick = function() {
            location.href = '{{route('home.show', $ethereum['id'])}}';
        }

        document.getElementById('row-tether').onclick = function() {
            location.href = '{{route('home.show', $tether['id'])}}';
        }

        document.getElementById('row-binance-coin').onclick = function() {
            location.href = '{{route('home.show', $binance_coin['id'])}}';
        }

        document.getElementById('row-cardano').onclick = function() {
            location.href = '{{route('home.show', $cardano['id'])}}';
        }
    </script>
</body>

</html>
