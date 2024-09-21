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

    <!-- Importing chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

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
    <div class="mx-2 mx-md-5 mt-3 bg-secondary text-light">
        <div class="container-fluid">
            <div id="content-loading" class="d-flex justify-content-center py-4">
                <div class="lds-roller">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div id="content-wrapper" class="d-none">
            <div class="row justify-content-center align-items-center py-4">
                <div class="col-12 ml-5 ml-md-5 col-md-6">
                    <h2 id="cryptoName"></h2>
                    <h4 id="cryptoCurrentDate">12 july 2021</h4>
                </div>
                <div class="col-12 ml-4 ml-md-0 col-md-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="my-1 text-success">High <span class="text-light" id="cryptoHigh"></span>
                                </h5>
                            </div>
                            <div class="col-6">
                                <h5 class="my-1 text-success">Change <span class="text-primary"
                                        id="cryptoChange"></span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5 class="my-1 text-success">Low <span class="text-light" id="cryptoLow"></span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-11">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Set url to get crypto data from the current currency
        const urlGetInfo = 'https://api.coincap.io/v2/assets/{{ $crypto }}';

        // Set variables from elements in the DOM
        const cryptoName = document.getElementById('cryptoName');
        const cryptoCurrentDate = document.getElementById('cryptoCurrentDate');
        const cryptoChange = document.getElementById('cryptoChange');
        const cryptoHigh = document.getElementById('cryptoHigh');
        const cryptoLow = document.getElementById('cryptoLow');


        fetch(urlGetInfo)
            .then(response => response.json())
            .then(data => get(data['data']))
            .catch(error => console.log(error))

        // Set Currency name, symbol and change
        const get = (currencyData) => {
            cryptoName.innerHTML = capitalizeFirstLetter(currencyData.id) + " (" + currencyData.symbol + ")";
            cryptoCurrentDate.innerHTML = getDMYDate(today = new Date());

            const changePercent = parseFloat(currencyData.changePercent24Hr).toFixed(2);
            cryptoChange.innerHTML = changePercent + "%";

            // If changePercent is below 0, then the text would be red
            if (changePercent < 0) {
                cryptoChange.classList.remove("text-primary");
                cryptoChange.style.color = '#ff1100';
            }
        }

        let labels = [];
        let priceDataset = [];

        // Notes that the url variable has the parameter passed in from the controller view
        const urlChart = 'https://api.coincap.io/v2/assets/{{ $crypto }}/history?interval=m5';

        // Get coincap info
        fetch(urlChart)
            .then(response => response.json())
            .then(data => show(data['data']))
            .catch(error => console.log(error))

        const show = (currencyData) => {
            currencyData.forEach(element => {
                // This is for converting unix to normal date
                const dateObject = new Date(element.time);
                const month = getPrettyMonth(dateObject);
                const dayOfMonth = dateObject.getDate();
                const year = dateObject.getFullYear();
                const hour = dateObject.getHours();
                let minute = dateObject.getMinutes();

                if (minute < 10) {
                    minute = '0' + minute;
                }

                const date = month + ' ' + dayOfMonth + ', ' + year + ' - ' + hour + ':' + minute;

                // Jul 12, 2021 - 06:25AM

                labels.push(date);
                priceDataset.push(element.priceUsd);
            });
        }

        const data = {
            labels: labels,
            datasets: [{
                label: 'Price',
                backgroundColor: '#1cd01a',
                borderColor: '#1cd01a',
                pointRadius: 0,
                borderWidth: 1,
                data: priceDataset
            }]
        };

        const config = {
            type: 'line',
            data,
            options: {
                onHover: (e) => {
                    e.native.target.style.cursor = "pointer";
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    axis: 'x'
                }
            }
        };

        // Show chart and Set High and Low values
        setTimeout(function() {
            max = maxValue(priceDataset);
            high = numberWithCommas(max.toFixed(2));
            cryptoHigh.innerHTML = "$" + high;

            min = minValue(priceDataset);
            low = numberWithCommas(min.toFixed(2));
            cryptoLow.innerHTML = "$" + low;

            const contentWrapper = document.getElementById('content-wrapper');
            const contentLoading = document.getElementById('content-loading');

            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

            contentLoading.className = '';
            contentLoading.classList.add('d-none');

            contentWrapper.className = '';
            contentWrapper.classList.add('d-block');

        }, 4000);

        // Get real month name and not a number
        function getPrettyMonth(dateObject) {
            const months = {
                0: 'January',
                1: 'February',
                2: 'March',
                3: 'April',
                4: 'May',
                5: 'June',
                6: 'July',
                7: 'August',
                8: 'September',
                9: 'October',
                10: 'November',
                11: 'December'
            }

            return m = months[dateObject.getMonth()];
        }

        // Get maximun data from an array
        function maxValue(input) {
            if (toString.call(input) !== "[object Array]")
                return false;
            return Math.max.apply(null, input);
        }

        // Get minimun data from an array
        function minValue(input) {
            if (toString.call(input) !== "[object Array]")
                return false;
            return Math.min.apply(null, input);
        }

        // Capitalize first letter    
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Get formated d/m/y date
        function getDMYDate(date) {
            const day = date.getDate();
            const month = getPrettyMonth(date);
            const year = date.getFullYear();

            return day + ' ' + month + ' ' + year;

        }

        // Get formated number with commas
        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
    </script>
</body>

</html>
