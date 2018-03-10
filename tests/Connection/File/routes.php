<?php

/**
 * The resourceId is a sha1 from queryParams after serialize
 *
 * @var array [string action => [string resourceId => string FileName]
 */
return [
    'acl-field-update' => [
        'ec1009edcfbc4d44063e3e4c7bf7f042bcbd2dd1' => 'acl-field-update-success',
        '7fec835d624f38f4f6b1a4f93442ea8b5c4c4726' => 'acl-field-update-no-access',
        'c0db054e609efa75105a7888ff851f177c2a7d06' => 'acl-field-update-invalid',
    ],

    'common-info' => [
        '0b34b32f12106f1aa4aefefa3363a2bf826cb94b' => 'common-info',
        '684e8d69d8f4b646cc8007f667d784e0359f31c4' => 'common-info',
    ],

    'group-membership-update' => [
        '5e253185ad6e3a7e303d22f972a017ac5b02c799' => 'group-membership-update-success',
        '6463d48e5069e62e884206d0bffdd96d905f42c6' => 'group-membership-no-access',
        '12e9e36dbe3c9bfb3a37222f27019bae5efea4b1' => 'group-membership-update-invalid',
    ],

    'list-recordings' => [
        '7c8db3e9804cd73bea5842d7507e229ad0b01ffb' => 'list-recordings-success',
        '57b346ce02528b904643a12241f6488562d515f1' => 'list-recordings-no-data',
        '6337d6a112fb8394ccf6126adf4c39f9c41dbee5' => 'list-recordings-no-access',
    ],

    'login' => [
        'd635c464148d1934d1195a30edba072b35e59e9c' => 'login-success',
        '54d6988c059905b6c7a87bbc10c3e84f538115e3' => 'login-invalid',
    ],

    'logout' => [
        'cac7b6bb995acffa265c6cc9c38c9904be3d4ad6' => 'logout',
    ],

    'meeting-feature-update' => [
        '9d2cc3f416743c3a256d124643ab1d0c7f1ce65b' => 'meeting-feature-update-success',
        'b49f99e9765f9554afbd1252075d5bd1653f1c00' => 'meeting-feature-update-no-access',
        'b3a13d33abaa781720820d257e4e270dea3d996a' => 'meeting-feature-update-invalid',
    ],

    'permissions-info' => [
        '889f22d94f8698acf494e0b92a32af621b8d523a' => 'permissions-info-principal',
        'cb92de166bc3ac9eb17061330521245f315789e6' => 'permissions-info-no-data',
        'fe034c017cb5f28e6c5197cb4c60b2cb43f6e8b5' => 'permissions-info-no-access',
        '66199296f7cb96201b74d1b514d38ffd5d751da9' => 'permissions-info-all',
        '088ec38122a16dbbed309a960aeef2a67264f2c5' => 'permissions-info-filter-permission',
        '721100c4ce934c1cb3816d5806843832c1fb681f' => 'permissions-info-all',
        '0652074d72bec5542bc55ad052a27db8c1f41b75' => 'permissions-info-empty',
        'b11a3d47c71ca83a8fff379b191f06351e659a70' => 'permissions-info-no-access',
    ],

    'permissions-update' => [
        '71e3d7c0567ec5429da14cd91b0f16a20d0a244d' => 'permission-update-success',
        '403b845b83b942e00dc00d907829fa8c9f8bcd34' => 'permission-update-no-access',
    ],

    'principals-delete' => [
        '6c39a7165c57b3339d1ddc39499f850cfa31bb99' => 'principals-delete-success',
        '083cad6581fdbf158165192598040f2c18fcf9bd' => 'principals-delete-no-access',
    ],

    'principal-info' => [
        '49d78b23c62f9a7bc35704a4a5d4c6ab57cc3290' => 'principal-info-user',
        '618259e8dc03ad89e8261150b5adb14a9e460649' => 'principal-info-group',
        '8d355bf7aea07113487665e0eedd26e04b252688' => 'principal-info-no-access',
    ],

    'principal-update' => [
        '0a3ff4f4bf08f7c18a08c4accb0c952f2663e2cf' => 'principal-update-no-access',
        '7e8f86017c3168c211e0da2f739a6b29b4b0f988' => 'principal-update-no-access',
        'd707626582cc0bea8be5a10011b4fb6afcb62afa' => 'principal-update-create-user',
        '1177141f4482789d55daffa0cda76b2a327ba6fd' => 'principal-update-create-group',
        'd74fb1b82f258a0066340ef1ca4172bbdfb3a60f' => 'principal-update-update',
        '4ead5c80628ae73a4343a588979a2f7fef1e7798' => 'principal-update-update',
    ],

    '' => [
        '' => '',
    ],
];
