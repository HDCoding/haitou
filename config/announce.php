<?php

return [

    /*
     * Interval
     */
    'time' => [
        'interval' => (45 * 60), //45 Minutes
        'min_interval' => (30 * 60), //30 Minutes
    ],

    /*
     * Blocked Ports
     */
    'ports' => [
        411, //direct connect 411 ot 413
        412,
        413,
        1214, //kazaa 1214
        4662, //emule 4662
        6346, //gnutella 6346 to 6347
        6347,
        6699, //winmx 6699
        6881, //bittorrent 6881 to 6889
        6882,
        6883,
        6884,
        6885,
        6886,
        6887,
        6889,
        6969,
        65535 //IRC bot based trojans 65535
    ],

    /*
     * Blocked Browser
     */
    'browsers' => [
        'Amigo',
        'Chrome',
        'Chromium',
        'Cốc',
        'Internet',
        'Maxthon',
        'Microsoft',
        'Mozilla',
        'Naver',
        'Netscape',
        'Opera',
        'Pale Moon',
        'PhantomJS',
        'QQ',
        'Safari',
        'SeaMonkey',
        'Secure',
        'SlimBrowser',
        'Slimjet',
        'Sogou',
        'Suite',
        'UC',
        'Vivaldi',
        'Yandex',
    ],

    /*
     * Updated at 14/09/2019
     */
    'peers' => [
        // ABC
        'A3',
        // Ares
        '-AG',
        // Azureus
        'AZ09',
        'AZ10',
        'AZ20',
        'AZ21',
        'AZ22',
        'AZ23',
        'AZ24',
        'AZ25',
        'AZ30',
        'AZ31',
        '-AZ4000-',
        'AZ40',
        'AZ41',
        'AZ42',
        'AZ43',
        'AZ44',
        'AZ45',
        'AZ46',
        'AZ47',
        'AZ48',
        'AZ49',
        'AZ50',
        'AZ51',
        'AZ52',
        '-AZ5200-',
        'AZ53',
        'AZ54',
        // BitBuddy
        'BB',
        // BTSlave
        'BS',
        // BitComent
        '-BC',
        // BitTornado
        'T03I',
        // BitTorrent
        'M7',
        // Deluge
        'DE11',
        'DE12',
        '-DE1300-',
        '-DE1310-',
        '-DE1320-',
        '-DE1330-',
        '-DE1340-',
        '-DE1350-',
        '-DE1360-',
        '-DE1370-',
        '-DE1380-',
        '-DE1390-',
        '-DE1311-',
        '-DE1312-',
        '-DE1313-',
        // nao lembro
        'ex',
        'FUTB',
        // Limeware
        'LIME',
        // MLDonkey
        '-ML',
        // Shareaza
        '-S~',
        '-SZ',
        // qBitTorrent
        'qB28',
        // '-qB2810-', '-qB2820-',
        // rTorrent
        '-lt',
        // Transmission
        'TR0',
        'TR1',
        'TR20',
        'TR21',
        'TR22',
        '-TR2300-',
        '-TR2310-',
        '-TR2320-',
        '-TR2330-',
        // uTorrent for MAC
        '-UM1514-',
        '-UM1630-',
        '-UM1640-',
        '-UM1650-',
        '-UM1800-',
        '-UM1810-',
        '-UM1820-',
        '-UM1830-',
        // uTorrent
        'UT11',
        'UT12',
        'UT13',
        'UT14',
        'UT15',
        'UT16',
        'UT17',
        'UT18',
        'UT19',
        'UT20',
        'UT21',
        'UT22',
        'UT30',
        'UT31',
        'UT32',
        'UT33',
        'UT34',
        // UT35 é mais recente nao da para bloquear
        // XBT
        'XBT'
    ]

];
