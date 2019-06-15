<?php

return [
    'alipay' => [
        'app_id' => '2016092300575015',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0xtw/swT/7+71gpFz8Uywodr15/ysqZQev6mW9jzOZBhD45Z8Gysq8V3Uk/lPuZvflGwonr7TXhj6qQ+FSDhyqavtLjqrLK0T536v/C1ltpE54JyUqz4jf6PKW2KLqXpoI6j3x9B+ZrtRauBZJfZ935yPq9Ggf+cBNRYeOIP/EuAddtKpePxHjDUO5Em25ABNxXdzxeRTsBGJzTH6hbPWMCia+JqIk1YqKunEWS+zDXOKD95j1ItYwzIMqdJrGttYTL3zh0Saq0gkRApksPS7dEeSdMMtj2AAdWM9B6dK088L4bch5yBETQ9A0vykxiAzOm+mx55GaFd/AHEvZL6CQIDAQAB',
        'private_key' => 'MIIEpQIBAAKCAQEAr0kiT4fZJp2AdhwcFLW1ikzPlkm0RFYrAq1zHqplnltLDU3Ks7dnfWxcCJisbq337/UUJHcPitkj9LIt00hth43MgeLItuwCTBHPaCiEISe3swyhG9ZYNv3TNE1zXzStYcYkQYTMBq8FlB5YtIfO8MV3Rd2t3M2RZ4CZAf6R2Ed6NB7phAF2VS4cpJWbT7TE+EcvbCG7o1kr8DctniWnTipdOiFKhVgtl0mHgquotvUZE1sKpTQoKXLy3hZysLn1WbkYEEkmt6Y0btqg9VE46JVsO7H22ahDsqnHYcRdLujE+SyBbrrA1K9Iec+/XNj6JW7j3L8wwrX1kp7DovY31wIDAQABAoIBAQCmiXuZyF4efCIjFU3wtzvGLHhGN7yX+K5gmt73Ubm+nMpP14sw+J3Q4nUGjde2SH96coUyqBQSPYAV6nvzc6rs0WJuPUOp183O7FT8hxISViQIb4VaZ2nkxYA2/ycQW4InlRO5VCxsZTmNos9wpl+NDm/l51paoMz3Y4z8AhwbOSn2yeDfW2rPHJxuZktotNlnLpwSeu9T6IIfX0ZnSzNEw3lqMjt9NxMO1XzepR8NPa88YzRdCo24IXFOVuBOSsioPoqSXiD5Vrle/aTpGWL0dX4VKBaBgc/njWPAMRxaPRXRGCokmRE17VMIl5QxBm/yt1WGW2TFFX9J3zA/Fm3hAoGBAObIghOC01faNhS+hNPL8+O0CVxoaj5lY2apjfvPdAB0jlD17MKOy52+MCGxLIPMFfNXTM3dlEXx6vfeio3L7P6fIQ7gv4F4Mh0eV2nAB7+xpR4gBb9NOIHhkFnr5v1KzIv/VF4+pVEQuSmhwMnLZRUj7fGScmTrWg6AUK7ZFvv/AoGBAMJwPiKxhltq0EA6labyxKl3c/U7t8+KWbO2b4unyygSPrwpUXGXVcnvJoXDaTtStLt4ops1kVFnEg9PNUOwf84z6G9Xg5RtHaiQHq8s8I1UAztTF/YniI83ZMi39tSARYAvPj4wNdfnKTRniyUPfS6rSFLHFdBnJlZ+K2e9KCQpAoGADy8yH8aD0UvyMvs2EhlhOqIl24ajNufE2oRdaywDHeSNWJZVtZdfnkldMVpO630KFLCxxPnHP7LjGtvxkdLRDQ+7RRdUglg+M9xDNBoGaH5vtsO0nRmfliwZK1FyKUg6nRt3mZvVlLfc9vhFjwFq7TEn/rT8AdfaXQnkRRzTflECgYEAjooSQwS5ZlMLj8pi4xydp052p5S7z12xHNnlNBAyEpItg2sW1ZsHvR2gs/bpMiATdkudiQLgITjaOHbsqU6+or/S6azSPQEw+N2OYQUk47ZvGBJ2QnIA3lzReYPDY00Vpj779kMJddl0j4JIs0aDkq7mOijQiRLVPBsKXuaAguECgYEAuFNj54P+FXFqrjxLW/UC0iKBnhYyjPVowN7b+g/UY/+7t0BrbWRf1AN+4nw5XEfCLgLoH8TJ7XCnmWY2Ev3iakGnIT9nr4xcUfOwGOexqEcQMUnLiHg1CwAoTlT5uuoYW7AgTPJgsyzHmpT2d/C2cMh3N1VXlNuGop8H9b9rh5E=',
        'log' => [
            'file' => storage_path('logs/alipay_log'),
        ],
    ],

    'wechat' => [
        'app_id' => '',
        'mch_id' => '',
        'key' => '',
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],

];