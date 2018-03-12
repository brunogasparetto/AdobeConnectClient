<?php

/**
 * The resourceId is a sha1 from queryParams after serialize
 *
 * @var array [string action => [string resourceId => string FileName]
 */
return [
    'acl-field-update' => [
        'ec1009edcfbc4d44063e3e4c7bf7f042bcbd2dd1' => 'status-ok',
        'f9bfa92d710a9988edec5b75ae121de4003dedba' => 'status-ok',
        '7fec835d624f38f4f6b1a4f93442ea8b5c4c4726' => 'status-no-access',
        '35f35a3fcea9c4b0f63e48b652e8ff41e175dc24' => 'status-no-access',
        'c0db054e609efa75105a7888ff851f177c2a7d06' => 'status-invalid',
    ],

    'common-info' => [
        '0b34b32f12106f1aa4aefefa3363a2bf826cb94b' => 'common-info',
        '684e8d69d8f4b646cc8007f667d784e0359f31c4' => 'common-info',
    ],

    'group-membership-update' => [
        '5e253185ad6e3a7e303d22f972a017ac5b02c799' => 'status-ok',
        '6463d48e5069e62e884206d0bffdd96d905f42c6' => 'status-no-access',
        '12e9e36dbe3c9bfb3a37222f27019bae5efea4b1' => 'status-invalid',
    ],

    'list-recordings' => [
        '7c8db3e9804cd73bea5842d7507e229ad0b01ffb' => 'list-recordings-success',
        '57b346ce02528b904643a12241f6488562d515f1' => 'status-no-data',
        '6337d6a112fb8394ccf6126adf4c39f9c41dbee5' => 'status-no-access',
    ],

    'login' => [
        'd635c464148d1934d1195a30edba072b35e59e9c' => 'status-ok',
        '54d6988c059905b6c7a87bbc10c3e84f538115e3' => 'status-no-data',
    ],

    'logout' => [
        'cac7b6bb995acffa265c6cc9c38c9904be3d4ad6' => 'status-ok',
    ],

    'meeting-feature-update' => [
        '9d2cc3f416743c3a256d124643ab1d0c7f1ce65b' => 'status-ok',
        'b49f99e9765f9554afbd1252075d5bd1653f1c00' => 'status-no-access',
        'b3a13d33abaa781720820d257e4e270dea3d996a' => 'status-invalid',
    ],

    'permissions-info' => [
        '889f22d94f8698acf494e0b92a32af621b8d523a' => 'permissions-info-principal',
        'cb92de166bc3ac9eb17061330521245f315789e6' => 'status-no-data',
        'fe034c017cb5f28e6c5197cb4c60b2cb43f6e8b5' => 'status-no-access',
        '66199296f7cb96201b74d1b514d38ffd5d751da9' => 'permissions-info-all',
        '088ec38122a16dbbed309a960aeef2a67264f2c5' => 'permissions-info-filter-permission',
        '721100c4ce934c1cb3816d5806843832c1fb681f' => 'permissions-info-all',
        '0652074d72bec5542bc55ad052a27db8c1f41b75' => 'permissions-info-empty',
        'b11a3d47c71ca83a8fff379b191f06351e659a70' => 'status-no-access',
    ],

    'permissions-update' => [
        '71e3d7c0567ec5429da14cd91b0f16a20d0a244d' => 'status-ok',
        'eed55aa2f119637eb9f12efc120087d6b3eedbc5' => 'status-ok',
        '403b845b83b942e00dc00d907829fa8c9f8bcd34' => 'status-no-access',
        'fdba3dd167f5071b7e28b6bf345ad17c836bf759' => 'status-no-access',
    ],

    'principals-delete' => [
        '6c39a7165c57b3339d1ddc39499f850cfa31bb99' => 'status-ok',
        '083cad6581fdbf158165192598040f2c18fcf9bd' => 'status-no-access',
    ],

    'principal-info' => [
        '49d78b23c62f9a7bc35704a4a5d4c6ab57cc3290' => 'principal-info-user',
        '618259e8dc03ad89e8261150b5adb14a9e460649' => 'principal-info-group',
        '8d355bf7aea07113487665e0eedd26e04b252688' => 'status-no-access',
    ],

    'principal-update' => [
        '0a3ff4f4bf08f7c18a08c4accb0c952f2663e2cf' => 'status-no-access',
        '7e8f86017c3168c211e0da2f739a6b29b4b0f988' => 'status-no-access',
        'd707626582cc0bea8be5a10011b4fb6afcb62afa' => 'principal-update-create-user',
        '1177141f4482789d55daffa0cda76b2a327ba6fd' => 'principal-update-create-group',
        'd74fb1b82f258a0066340ef1ca4172bbdfb3a60f' => 'status-ok',
        '4ead5c80628ae73a4343a588979a2f7fef1e7798' => 'status-ok',
    ],

    'principal-list' => [
        'c228737ee01c96f5b6c3c88ab94cb390347e3647' => 'status-no-access',
        'c7d426c3410ec12370e5a4319f8aeff934c9565f' => 'principal-list-all',
        '0f9879a925d933ca16dd095ba2fa5944ff13de0f' => 'principal-list-sorter',
        'ec5d33500aa52c47e176076b19037113a94db903' => 'principal-list-filter',
        'e5ca329139ae19dcc7f898f0eef70362cc476257' => 'principal-list-empty',
        'c62181a8a91f197ecdaa48da840f9dbc4bab28c7' => 'principal-list-group-all',
        '121875836a8430c43fba24097fb42c628258a142' => 'principal-list-group-is-member',
        'e7349e5d03ac0d62add8d6a9ba77972e3cf9ad76' => 'principal-list-group-is-not-member',
    ],

    'user-update-pwd' => [
        'dba78015dd3532813b513ac5f4d2825fbb712f8e' => 'status-no-access',
        'ff9d991b034d2bbc4fe76e71e5b64ba1cac353ed' => 'status-ok',
        '6e19a6356eb0449548c24b0182cbc5efd0d60fb3' => 'status-ok',
    ],

    'sco-delete' => [
        'fa080c80fc886df81b4f6f2b5adb027c5faa7bde' => 'status-no-access',
        'ced9e07bc427c0911de991aa2abcd903c39d215b' => 'status-ok',
    ],

    'sco-move' => [
        '5ab7622185a157a3fb9e9eec4e5b7e000e573dcc' => 'status-no-access',
        'fe5e5d7916561f55b32d545e9039bab99725d3cb' => 'status-invalid',
        '573eab90bb568ac1a94306d597ed7ab0ee25c85c' => 'status-ok',
    ],

    'sco-update' => [
        '8c04c6b8918e227615acc0403e454b4f1dfbcd42' => 'status-no-access',
        '742ad6cc07e48116478a84d5df2da1f2048ff04a' => 'status-ok',
    ],

    'sco-info' => [
        'ed476bd99c42683e347d1ced864d1d13dbc527de' => 'status-no-access',
        'd88a2216b9fa963ffd42a451bb84aa32383bc919' => 'sco-info',
    ],

    'sco-contents' => [
        'ab3ec4c010dd996283c23f67d019ea82c900bd07' => 'status-no-access',
        '74691ab673641f00810aad3074a6850a09999e21' => 'sco-contents-empty',
        'f670ae196389edaf3c9ade93f49f378c53e8a5da' => 'sco-contents',
        'd41d535ff7e391054a25e297accc378eb6520833' => 'sco-contents-filter',
        'f8520febc56b12508e51fdb11d76b427ead9e6e3' => 'sco-contents-sorter',
    ],

    '' => [
        '' => '',
    ],
];
