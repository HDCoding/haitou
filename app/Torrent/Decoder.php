<?php

namespace App\Torrent;

use Exception;

class Decoder
{
    const TIMEOUT = 30;
    protected static $errors = [];

    /**
     * @param $string
     * @return array
     */
    public static function decode($string)
    {
        $data = is_string($string) || is_file($string) || self::url_exists($string) ? self::fileGetContents($string) : $string;
        return (array)self::decodeData($data);
    }

    /**
     * @param $data
     * @return array|bool|int|string
     */
    private static function decodeData(&$data)
    {
        switch (self::char($data)) {
            case 'i':
                $data = substr($data, 1);
                return self::decodeInteger($data);
                break;
            case 'l':
                $data = substr($data, 1);
                return self::decodeList($data);
                break;
            case 'd':
                $data = substr($data, 1);
                return self::decodeDictionary($data);
                break;
            default:
                return self::decodeString($data);
                break;
        }
    }

    /**
     * @param $data
     * @return array|bool
     */
    private static function decodeDictionary(&$data)
    {
        $dictionary = [];
        $previous = null;
        while (($char = self::char($data)) != 'e') {
            if (false === $char) {
                return self::setError(new Exception('Dicionario indeterminado'));
            }
            if (!ctype_digit($char)) {
                return self::setError(new Exception('Chave do dicionario invalida'));
            }
            $key = self::decodeString($data);
            if (isset($dictionary[$key])) {
                return self::setError(new Exception('Chave do dicionario duplicada'));
            }
            if ($key < $previous) {
                return self::setError(new Exception('Chave do dicionario sem classificacao'));
            }
            $dictionary[$key] = self::decodeData($data);
            $previous = $key;
        }
        $data = substr($data, 1);
        return $dictionary;
    }

    /**
     * @param $data
     * @return array|bool
     */
    private static function decodeList(&$data)
    {
        $list = [];
        while (($char = self::char($data)) != 'e') {
            if (false === $char) {
                return self::setError(new Exception('Lista indeterminada'));
            }
            $list[] = self::decodeData($data);
        }
        $data = substr($data, 1);
        return $list;
    }

    /**
     * @param $data
     * @return bool|string
     */
    private static function decodeString(&$data)
    {
        if (self::char($data) === '0' && substr($data, 1, 1) != ':') {
            return self::setError(new Exception('Tamanho da String invalida, iniciando do zero'));
        }
        if (!$colon = @strpos($data, ':')) {
            return self::setError(new Exception('Tamanho da String invalida, coluna nao encontrada'));
        }
        $length = (int)substr($data, 0, $colon);
        if ($length + $colon + 1 > strlen($data)) {
            return self::setError(new Exception('String invalida, entrada muito curta para comprimento de string'));
        }
        $string = substr($data, $colon + 1, $length);
        $data = substr($data, $colon + $length + 1);
        return $string;
    }

    /**
     * @param $data
     * @return bool|int
     */
    private static function decodeInteger(&$data)
    {
        $start = 0;
        $end = strpos($data, 'e');
        if (0 === $end) {
            return self::setError(new Exception('Integer vazio'));
        }
        if (self::char($data) == '-') {
            $start++;
        }
        if (substr($data, $start, 1) == '0' && $end > $start + 1) {
            return self::setError(new Exception('Integer iniciando do zero'));
        }
        if (!ctype_digit(substr($data, $start, $start ? $end - 1 : $end))) {
            return self::setError(new Exception('Nenhum digitos em numeros inteiros'));
        }
        $integer = (int)substr($data, 0, $end);
        $data = substr($data, $end + 1);
        return 0 + $integer;
    }

    /**
     * @param $exception
     * @param bool $message
     * @return bool
     */
    protected static function setError($exception, $message = false)
    {
        return (array_unshift(self::$errors, $exception) && $message) ? $exception->getMessage() : false;
    }

    /**
     * @param $data
     * @return bool|string
     */
    private static function char($data)
    {
        return empty($data) ? false : substr($data, 0, 1);
    }

    /**
     * @param $url
     * @return bool
     */
    public static function url_exists($url)
    {
        return self::is_url($url) ? (bool)self::fileSize($url) : false;
    }

    /**
     * @param $url
     * @return false|int
     */
    public static function is_url($url)
    {
        return preg_match('#^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$#i', $url);
    }

    /**
     * @param $file
     * @return float|int
     */
    public static function fileSize($file)
    {
        if (is_file($file)) {
            return (float)sprintf('%u', @filesize($file));
        } elseif ($content_length = preg_grep($pattern = '#^Content-Length:\s+(\d+)$#i', (array)@get_headers($file))) {
            return (int)preg_replace($pattern, '$1', reset($content_length));
        }
    }

    /**
     * @param $file
     * @param int $timeout
     * @param null $offset
     * @param null $length
     * @return bool|false|string
     */
    public static function fileGetContents($file, $timeout = self::TIMEOUT, $offset = null, $length = null)
    {
        if (is_file($file) || ini_get('allow_url_fopen')) {
            $context = !is_file($file) && $timeout ? stream_context_create(['http' => ['timeout' => $timeout]]) : null;

            return !is_null($offset) ? $length ?
                @file_get_contents($file, false, $context, $offset, $length) :
                @file_get_contents($file, false, $context, $offset) :
                @file_get_contents($file, false, $context);

        } elseif (!function_exists('curl_init')) {
            return self::setError(new Exception('Instale Curl ou habilite "allow_url_fopen"'));
        }
        $handle = curl_init($file);
        if ($timeout) {
            curl_setopt($handle, CURLOPT_TIMEOUT, $timeout);
        }
        if ($offset || $length) {
            curl_setopt($handle, CURLOPT_RANGE, $offset . '-' . ($length ? $offset + $length - 1 : null));
        }
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($handle);
        $size = curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($handle);

        return ($offset && $size == -1) || ($length && $length != $size) ? $length ?
            substr($content, $offset, $length) :
            substr($content, $offset) :
            $content;
    }
}
