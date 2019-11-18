<?php

return [

    /*
     * Server
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Server
     *
     * Note: when server is empty string, it will not add to response header
     */

    'server' => '',

    /*
     * X-Content-Type-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
     *
     * Available Value: 'nosniff'
     */

    'x-content-type-options' => 'nosniff',

    /*
     * X-Download-Options
     *
     * Reference: https://msdn.microsoft.com/en-us/library/jj542450(v=vs.85).aspx
     *
     * Available Value: 'noopen'
     */

    'x-download-options' => 'noopen',

    /*
     * X-Frame-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options
     *
     * Available Value: 'deny', 'sameorigin', 'allow-from <uri>'
     */

    'x-frame-options' => 'sameorigin',

    /*
     * X-Permitted-Cross-Domain-Policies
     *
     * Reference: https://www.adobe.com/devnet/adobe-media-server/articles/cross-domain-xml-for-streaming.html
     *
     * Available Value: 'all', 'none', 'master-only', 'by-content-type', 'by-ftp-filename'
     */

    'x-permitted-cross-domain-policies' => 'none',

    /*
     * X-Power-By
     *
     * Note: it will not add to response header if the value is empty string.
     */

    'x-power-by' => '',

    /*
     * X-XSS-Protection
     *
     * Reference: https://blogs.msdn.microsoft.com/ieinternals/2011/01/31/controlling-the-xss-filter
     *
     * Available Value: '1', '0', '1; mode=block'
     */

    'x-xss-protection' => '1; mode=block',

    /*
     * Referrer-Policy
     *
     * Reference: https://w3c.github.io/webappsec-referrer-policy
     *
     * Available Value: 'no-referrer', 'no-referrer-when-downgrade', 'origin', 'origin-when-cross-origin',
     *                  'same-origin', 'strict-origin', 'strict-origin-when-cross-origin', 'unsafe-url'
     */

    'referrer-policy' => 'no-referrer',

    /*
     * Clear-Site-Data
     *
     * Reference: https://w3c.github.io/webappsec-clear-site-data/
     */

    'clear-site-data' => [
        'enable' => false,

        'all' => false,

        'cache' => true,

        'cookies' => true,

        'storage' => true,

        'executionContexts' => true,
    ],

    /*
     * HTTP Strict Transport Security
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/HTTP_strict_transport_security
     *
     * Please ensure your website had set up ssl/tls before enable hsts.
     */

    'hsts' => [
        'enable' => false,

        'max-age' => 15552000,

        'include-sub-domains' => false,

        'preload' => true,
    ],

    /*
     * Expect-CT
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Expect-CT
     */

    'expect-ct' => [
        'enable' => false,

        'max-age' => 2147483648,

        'enforce' => false,

        'report-uri' => null,
    ],

    /*
     * Public Key Pinning
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/Public_Key_Pinning
     *
     * hpkp will be ignored if hashes is empty.
     */

    'hpkp' => [
        'hashes' => [
            // 'sha256-hash-value',
        ],

        'include-sub-domains' => false,

        'max-age' => 15552000,

        'report-only' => false,

        'report-uri' => null,
    ],

    /*
     * Feature Policy
     *
     * Reference: https://wicg.github.io/feature-policy/
     */

    'feature-policy' => [
        'enable' => true,

        /*
         * Each directive details can be found on:
         *
         * https://github.com/WICG/feature-policy/blob/master/features.md
         *
         * 'none', '*' and 'self allow' are mutually exclusive,
         * the priority is 'none' > '*' > 'self allow'.
         */

        'accelerometer' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'ambient-light-sensor' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'autoplay' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'camera' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'display-capture' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'document-domain' => [
            'none' => false,

            '*' => true,

            'self' => false,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'encrypted-media' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'fullscreen' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'geolocation' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'gyroscope' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'magnetometer' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'microphone' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'midi' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'payment' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'picture-in-picture' => [
            'none' => false,

            '*' => true,

            'self' => false,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'speaker' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'sync-xhr' => [
            'none' => false,

            '*' => true,

            'self' => false,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'usb' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],

        'vr' => [
            'none' => false,

            '*' => false,

            'self' => true,

            'src' => false,

            'allow' => [
                // 'url',
            ],
        ],
    ],

    /*
     * Content Security Policy
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/CSP
     *
     * csp will be ignored if custom-csp is not null. To disable csp, set custom-csp to empty string.
     *
     * Note: custom-csp does not support report-only.
     */

    'custom-csp' => null,

    'csp' => [
        'report-only' => false,

        'report-uri' => null,

        'block-all-mixed-content' => false,

        'upgrade-insecure-requests' => false,

        /*
         * Please references script-src directive for available values, only `script-src` and `style-src`
         * supports `add-generated-nonce`.
         *
         * Note: when directive value is empty, it will use `none` for that directive.
         */

        'script-src' => [
            'allow' => [
                // 'url',
            ],

            'hashes' => [
                // 'sha256' => [
                //     'hash-value',
                // ],
            ],

            'nonces' => [
                // 'base64-encoded',
            ],

            'schemes' => [
                // 'https:',
            ],

            'self' => false,

            'unsafe-inline' => false,

            'unsafe-eval' => false,

            'strict-dynamic' => false,

            'unsafe-hashed-attributes' => false,

            // https://www.chromestatus.com/feature/5792234276388864
            'report-sample' => true,

            'add-generated-nonce' => false,
        ],

        'style-src' => [
            'allow' => [
                //
            ],

            'hashes' => [
                // 'sha256' => [
                //     'hash-value',
                // ],
            ],

            'nonces' => [
                //
            ],

            'schemes' => [
                // 'https:',
            ],

            'self' => false,

            'unsafe-inline' => false,

            'report-sample' => true,

            'add-generated-nonce' => false,
        ],

        'img-src' => [
            //
        ],

        'default-src' => [
            //
        ],

        'base-uri' => [
            //
        ],

        'connect-src' => [
            //
        ],

        'font-src' => [
            //
        ],

        'form-action' => [
            //
        ],

        'frame-ancestors' => [
            //
        ],

        'frame-src' => [
            //
        ],

        'manifest-src' => [
            //
        ],

        'media-src' => [
            //
        ],

        'object-src' => [
            //
        ],

        'worker-src' => [
            //
        ],

        'plugin-types' => [
            // 'application/x-shockwave-flash',
        ],

        'require-sri-for' => '',

        'sandbox' => '',

    ],

];
