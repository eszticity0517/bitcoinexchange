<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="index.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0" />
</head>

<script>
    var xhr = new XMLHttpRequest();
    var url = "http://localhost:8000";

    if ("withCredentials" in xhr) {
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                // alert(xhr.responseText);
            }
        };
        xhr.send(null);
    }
</script>

<script>
    $(document).ready(function() {

        sendAJAXRequests();

        $('#clear').on('click', function() {
            $.ajax({
                url: '/helpers/clear-tables.php',
                type: 'get',

                success: function(output) {
                    $('#lastHourTable').html("");
                    $('#btcTable').html("");
                    $('#ethTable').html("");
                }
            });
        });

        $('#insertnewrow').on('click', function() {
            var value = document.getElementById('huf').value;

            $.ajax({
                url: '/helpers/insert-new-rows.php',
                type: 'post',
                data: ({
                    huf: value
                })
            });

            $.ajax({
                url: './helpers/read-bitcoin-data.php',
                type: 'get',
                cache: 'false',
                success: function(output) {
                    var jsonData = JSON.parse(output);
                    loadEthBtcData(jsonData, "btcTable");
                }
            });

            $.ajax({
                url: './helpers/read-ethereum-data.php',
                type: 'get',
                cache: 'false',
                success: function(output) {
                    var jsonData = JSON.parse(output);
                    loadEthBtcData(jsonData, "ethTable");
                }
            });

            $.ajax({
                url: './helpers/read-last-hour-data.php',
                type: 'get',
                cache: 'false',
                success: function(output) {
                    var jsonData = JSON.parse(output);
                    loadLastHourData(jsonData);
                }
            });
        });
    });

    setInterval(sendAJAXRequests, 300000);

    function sendAJAXRequests() {
        $.ajax({
            url: './helpers/read-bitcoin-data.php',
            type: 'get',
            cache: 'false',
            success: function(output) {
                var jsonData = JSON.parse(output);
                loadEthBtcData(jsonData, "btcTable");
            }
        });

        $.ajax({
            url: './helpers/read-ethereum-data.php',
            type: 'get',
            cache: 'false',
            success: function(output) {
                var jsonData = JSON.parse(output);
                loadEthBtcData(jsonData, "ethTable");
            }
        });

        $.ajax({
            url: './helpers/read-last-hour-data.php',
            type: 'get',
            cache: 'false',
            success: function(output) {
                var jsonData = JSON.parse(output);
                loadLastHourData(jsonData);
            }
        });

        $.ajax({
            url: '/helpers/get-last-huf-value.php',
            type: 'get',
            success: function(output) {
                $.ajax({
                    url: '/helpers/insert-new-rows.php',
                    type: 'post',
                    data: ({
                        huf: output
                    })
                });
            }
        });
    }

    function loadLastHourData(jsonData) {
        $('#lastHourTable').html("");

        var $tr = $("<tr>");
        var $requestTimeHeader = $("<th>request time</th>");
        var $hufHeader = $("<th>huf</th>");
        var $btcBuyValueHeader = $("<th>btc buy</th>");
        var $btcSellValueHeader = $("<th>btc sell</th>");
        var $ethBuyValueHeader = $("<th>eth buy</th>");
        var $ethSellValueHeader = $("<th>eth sell</th>");

        $tr.append($requestTimeHeader);
        $tr.append($hufHeader);
        $tr.append($btcBuyValueHeader);
        $tr.append($btcSellValueHeader);
        $tr.append($ethBuyValueHeader);
        $tr.append($ethSellValueHeader);

        $('#lastHourTable').append($tr);

        for (var i = 0; i < jsonData.length; i++) {
            var jsonObj = jsonData[i];
            $tr = $("<tr>");
            var $requestTime = $("<td>");
            var $huf = $("<td>");
            var $btcBuyValue = $("<td>");
            var $btcSellValue = $("<td>");
            var $ethBuyValue = $("<td>");
            var $ethSellValue = $("<td>");

            $requestTime.append(jsonObj.requestTime);
            $huf.append(jsonObj.huf);
            $btcBuyValue.append(jsonObj.btcBuyValue);
            $btcSellValue.append(jsonObj.btcSellValue);
            $ethBuyValue.append(jsonObj.ethBuyValue);
            $ethSellValue.append(jsonObj.ethSellValue);

            $tr.append($requestTime);
            $tr.append($huf);
            $tr.append($btcBuyValue);
            $tr.append($btcSellValue);
            $tr.append($ethBuyValue);
            $tr.append($ethSellValue);

            $('#lastHourTable').append($tr);
        }
    }

    function loadEthBtcData(jsonData, id) {
        $('#' + id).html("");

        var $tr = $("<tr>");
        var $requestTimeHeader = $("<th>request time</th>");
        var $hufHeader = $("<th>huf</th>");
        var $BuyValueHeader = $("<th>buy</th>");
        var $SellValueHeader = $("<th>sell</th>");
        var $lowValueHeader = $("<th>low</th>");
        var $highValueHeader = $("<th>high</th>");
        var $lastValueHeader = $("<th>last</th>");
        var $openValueHeader = $("<th>open</th>");
        var $volValueHeader = $("<th>vol</th>");

        $tr.append($requestTimeHeader);
        $tr.append($hufHeader);
        $tr.append($BuyValueHeader);
        $tr.append($SellValueHeader);
        $tr.append($lowValueHeader);
        $tr.append($highValueHeader);
        $tr.append($lastValueHeader);
        $tr.append($openValueHeader);
        $tr.append($volValueHeader);

        $('#' + id).append($tr);

        for (var i = 0; i < jsonData.length; i++) {
            var jsonObj = jsonData[i];
            var $tr = $("<tr>");
            var $requestTime = $("<td>");
            var $huf = $("<td>");
            var $buyValue = $("<td>");
            var $sellValue = $("<td>");
            var $lowValue = $("<td>");
            var $highValue = $("<td>");
            var $lastValue = $("<td>");
            var $openValue = $("<td>");
            var $volValue = $("<td>");

            $requestTime.append(jsonObj.requestTime);
            $huf.append(jsonObj.huf);
            $buyValue.append(jsonObj.buyValue);
            $sellValue.append(jsonObj.sellValue);
            $lowValue.append(jsonObj.lowValue);
            $highValue.append(jsonObj.highValue);
            $lastValue.append(jsonObj.lastValue);
            $openValue.append(jsonObj.openValue);
            $volValue.append(jsonObj.volValue);

            $tr.append($requestTime);
            $tr.append($huf);
            $tr.append($buyValue);
            $tr.append($sellValue);
            $tr.append($lowValue);
            $tr.append($highValue);
            $tr.append($lastValue);
            $tr.append($openValue);
            $tr.append($volValue);

            $('#' + id).append($tr);
        }
    }
</script>

<body>
    <div class="container-fluid">
        <div class="page-header">
            <img src="icons/ethereum.png" />
            <img src="icons/Bitcoin-icon.png" />
            <h1>Exchanger</h1>
        </div>

            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <span class="input-group">
                            <span class="input-group-addon">HUF</span>
                        <input autocomplete="off" step="0.01" id="huf" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" />
                        <span class="input-group-addon">= 1 USD</span>
                        </span>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button id="insertnewrow" class="btn btn-primary" value="click">Submit</button>
                        <button id="clear" class="btn btn-danger" value="click">Clear history</button>
                    </div>
                </div>
            </div>

        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#alldata" data-toggle="tab">All data</a>
            </li>
            <li role="presentation">
                <a href="#lasthourdata" data-toggle="tab">Last hour data</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="alldata">
                <div class="panel panel-default">
                    <div class="panel-heading" />
                    <h3 class="panel-title">All data</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a href="#bitcoin" data-toggle="tab">Bitcoin</a>
                        </li>
                        <li role="presentation">
                            <a href="#ethereum" data-toggle="tab">Ethereum</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="bitcoin">
                            <table class="table" id="btcTable"></table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="ethereum">
                            <table class="table" id="ethTable"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="lasthourdata">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Last hour data</h3>
                </div>
                <div class="panel-body">
                    <table class="table" id="lastHourTable"></table>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</htm>
