<?php

use App\Helpers\Settings;
use App\Models\Setting;
use Carbon\Carbon;

if (!function_exists('md5_gen')) {
    /**
     * Generates random characters using MD5 values
     * 32 Characters
     */
    function md5_gen(): string
    {
        return md5(uniqid() . time() . microtime());
    }
}

if (!function_exists('make_size')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     **/
    function make_size($bytes, $decimals = 2)
    {
        $size = [' B', ' kB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB'];
        $floor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $floor)) . $size[$floor];
    }
}

if (!function_exists('sha1_gen')) {
    /**
     * Generates random characters using SHA1 values
     * 40 Characters
     */
    function sha1_gen($token = null): string
    {
        return sha1(uniqid() . time() . microtime() . md5_gen() . $token);
    }
}

if (!function_exists('day_month_year')) {
    /**
     * Return in Brazil format and translated the date: Day Month of Year
     */
    function day_month_year()
    {
        $day_number = date('d');
        $year = date('Y');

        switch (date('w')) {
            case 0: $today = 'Domingo'; break;
            case 1: $today = 'Segunda-Feira'; break;
            case 2: $today = 'Terça-Feira'; break;
            case 3: $today = 'Quarta-Feira'; break;
            case 4: $today = 'Quinta-Feira'; break;
            case 5: $today = 'Sexta-Feira'; break;
            case 6: $today = 'Sábado'; break;
            default: $today = 'Bugou'; break;
        }

        switch (date('n')) {
            case 1: $mes = 'Janeiro'; break;
            case 2: $mes = 'Fevereiro'; break;
            case 3: $mes = 'Março'; break;
            case 4: $mes = 'Abril'; break;
            case 5: $mes = 'Maio'; break;
            case 6: $mes = 'Junho'; break;
            case 7: $mes = 'Julho'; break;
            case 8: $mes = 'Agosto'; break;
            case 9: $mes = 'Setembro'; break;
            case 10: $mes = 'Outubro'; break;
            case 11: $mes = 'Novembro'; break;
            case 12: $mes = 'Dezembro'; break;
            default: $mes = 'Bugou'; break;
        }

        echo "Hoje é {$today}, {$day_number} de {$mes} de {$year}";
    }
}

if (!function_exists('ative_page')) {
    /**
     * Check the current URL that the user is browsing
     * Set as active for the current page
     */
    function ative_page(string $url): string
    {
        return request()->is($url) || request()->is("$url/*") ? 'active' : '';
    }
}

if (!function_exists('toastr')) {
    /**
     * Get the toastr instance
     *
     * @return App\Helpers\Toastr
     */
    function toastr()
    {
        return app('toastr');
    }
}

if (!function_exists('mention')) {
    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    function mention(): \App\Helpers\Mention
    {
        return app('mention');
    }
}

if (!function_exists('hideref')) {
    /**
     * @param $strUrl
     * @return string
     */
    function hideref($strUrl): string
    {
        return "https://dereferer.me/?".urlencode($strUrl);
    }
}

if (!function_exists('format_date_time')) {
    /**
     * Formata data do timestamp
     */
    function format_date_time($date_time)
    {
        return Carbon::parse($date_time)->format('d/m/Y H:i');
    }
}

if (!function_exists('format_date')) {
    /**
     * Formata data do timestamp
     */
    function format_date($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('setting')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed, we'll assume you want to set settings.
     *
     * @param string|array $key
     * @param mixed $default
     * @return mixed|Setting
     */
    function setting($key, $default = null)
    {
        if (is_null($key)) {
            return new Setting();
        }
        if (is_array($key)) {
            return Setting::set($key, $default);
        }
        $value = Setting::get($key);
        return is_null($value) ? value($default) : $value;
    }
}
