var btc = document.getElementById("bitcoin");
var eth = document.getElementById("ethereum");
var teth = document.getElementById("tether");
var ltc = document.getElementById("litecoin");
var zcash = document.getElementById("zcash");
var solana = document.getElementById("solana");




var livePrice = {
    "async" : true,
    "croosDomain": true,
    "url": "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum%2Ctether%2Clitecoin%2Czcash%2Csolana&vs_currencies=usd",



    "method": "GET",
    "headers": {}

}


$.ajax(livePrice).done(function(response) {
    btc.innerHTML = response.bitcoin.usd;
    eth.innerHTML = response.ethereum.usd;
    teth.innerHTML = response.tether.usd;
    ltc.innerHTML = response.litecoin.usd;
    zcash.innerHTML = response.zcash.usd;
    solana.innerHTML = response.solana.usd;
})