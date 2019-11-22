<?php

namespace App\Helpers;

use Exception;
use App\Models\Torrent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class TorrentUploader
 * @package App\Helpers
 */
class TorrentUploader
{
    public $info;

    protected $announce;
    protected $announce_list = [];
    protected $info_hash;
    protected $date;
    protected $name;
    protected $size;
    protected $files = [];
    protected $file_count;
    protected $comment;
    protected $private;
    protected $filename;
    protected $created_by;

    const timeout = 30;
    protected static $errors = [];

    function __construct($data = null)
    {
        if (is_null($data)) {
            return false;
        }

        $data = self::decode($data);

        foreach ($data as $key => $value) {
            $this->{trim($key)} = $value;
        }
    }

    public function __toString()
    {
        return $this->encode($this);
    }

    public function error()
    {
        return empty(self::$errors) ? false : self::$errors[0]->getMessage();
    }

    public function errors()
    {
        return empty(self::$errors) ? false : self::$errors;
    }

    public function announce($announce = null)
    {
        if (is_null($announce)) {
            return !isset($this->{'announce-list'}) ? isset($this->announce) ? $this->announce : null : $this->{'announce-list'};
        }
        $this->touch();
        if (is_string($announce) && isset($this->announce)) {
            return $this->{'announce-list'} = self::announceList(isset($this->{'announce-list'}) ? $this->{'announce-list'} : $this->announce, $announce);
        }
        unset($this->{'announce-list'});
        if (is_array($announce) || is_object($announce)) {
            if (($this->announce = self::firstAnnounce($announce)) && count($announce) > 1) {
                return $this->{'announce-list'} = self::announceList($announce);
            } else {
                return $this->announce;
            }
        }
        if (!isset($this->announce) && $announce) {
            return $this->announce = (string)$announce;
        }
        unset($this->announce);
    }

    public function one_announce()
    {
        return isset($this->announce) ? $this->announce : "Vazio";
    }

    public function creation_date($timestamp = null)
    {
        return is_null($timestamp) ? isset($this->{'creation date'}) ? $this->{'creation date'} : null : $this->touch($this->{'creation date'} = (int)$timestamp);
    }

    public function comment($coment = null)
    {
        return is_null($coment) ? isset($this->comment) ? $this->comment : null : $this->touch($this->comment = (string)$coment);
    }

    public function name($name = null)
    {
        return is_null($name) ? isset($this->info['name']) ? $this->info['name'] : null : $this->touch($this->info['name'] = (string)$name);
    }

    public function is_private($private = null)
    {
        return is_null($private) ? !empty($this->info['private']) : $this->touch($this->info['private'] = $private ? 1 : 0);
    }

    public function source($source = null)
    {
        return is_null($source) ? isset($this->info['source']) ? $this->info['source'] : null : $this->touch($this->info['source'] = (string)$source);
    }

    public function url_list($urls = null)
    {
        return is_null($urls) ? isset($this->{'url-list'}) ? $this->{'url-list'} : null : $this->touch($this->{'url-list'} = is_string($urls) ? $urls : (array)$urls);
    }

    public function piece_length()
    {
        return isset($this->info['piece length']) ? $this->info['piece length'] : null;
    }

    public function hash_info()
    {
        return isset($this->info) ? sha1(self::encode($this->info)) : null;
    }

    public function content($precision = null)
    {
        $files = [];
        if (isset($this->info['files']) && is_array($this->info['files'])) {
            foreach ($this->info['files'] as $file) {
                $files[self::path($file['path'])] = $precision ? self::format($file['length'], $precision) : $file['length'];
            }
        } elseif (isset($this->info['name'])) {
            $files[$this->info['name']] = $precision ? self::format($this->info['length'], $precision) : $this->info['length'];
        }
        return $files;
    }

    public function offset()
    {
        $files = [];
        $size = 0;
        if (isset($this->info['files']) && is_array($this->info['files'])) {
            foreach ($this->info['files'] as $file) {
                $files[self::path($file['path'], $this->info['name'])] = [
                    'startpiece' => floor($size / $this->info['piece length']),
                    'offset' => fmod($size, $this->info['piece length']),
                    'size' => $size += $file['length'],
                    'endpiece' => floor($size / $this->info['piece length']),
                ];
            }
        } elseif (isset($this->info['name'])) {
            $files[$this->info['name']] = [
                'startpiece' => 0,
                'offset' => 0,
                'size' => $this->info['length'],
                'endpiece' => floor($this->info['length'] / $this->info['piece length']),
            ];
        }
        return $files;
    }

    public function size($precision = null)
    {
        $size = 0;
        if (isset($this->info['files']) && is_array($this->info['files'])) {
            foreach ($this->info['files'] as $file) {
                $size += $file['length'];
            }
        } elseif (isset($this->info['name'])) {
            $size = $this->info['length'];
        }
        return is_null($precision) ? $size : self::format($size, $precision);
    }

    public function send($torrent_id, $torrent_name)
    {
        $this->__construct(storage_path("torrents/{$torrent_id}.torrent"));

        $decode = self::decode(storage_path("torrents/{$torrent_id}.torrent"));
        //remove old encode
        unset($decode['announce']);
        unset($decode['announce-list']);
        unset($decode['comment']);
        unset($decode['name']);
        unset($decode['httpseeds']);
        unset($decode['created by']);
        //add new encode
        $decode['announce'] = route('announce', ['passkey' => auth()->user()->passkey]);
        $decode['comment'] = "Downloaded in " . config('app.name');
        $decode['name'] = $torrent_name;
        $decode['creation date'] = time();
        $decode['private'] = true;
        //new encode
        $data = self::encode($decode);

//        $this->touch();
//        $this->announce(false);
//        $this->comment(false);
//        $this->announce(route('announce', ['passkey' => auth()->user()->passkey]));
//        $this->is_private(true);

        $response = Response::create($data, 200);
        $response->header('Cache-control', 'public');
        $response->header('Content-Length', strlen($data));
        $response->header('Content-Type', 'application/x-bittorent');
        $response->header('Content-Disposition', 'attachment; filename=' . $torrent_name . '.torrent');
        $response->header('Progma', 'no-cache');
        return $response;
    }

    public function save($file, $fileID)
    {
        Storage::disk('torrents')->putFileAs('', $file, $fileID.'.torrent');
    }

    /**
     * Encode Torrent File
     * @param $mixed
     * @return string
     */
    public static function encode($mixed)
    {
        switch (gettype($mixed)) {
            case 'integer':
            case 'double':
                return self::encodeInteger($mixed);
            case 'object':
                $mixed = get_object_vars($mixed); // no break
            case 'array':
                return self::encodeArray($mixed);
            default:
                return self::encodeString($mixed);
        }
    }

    private static function encodeString($string)
    {
        return strlen($string) . ':' . $string;
    }

    private static function encodeInteger($integer)
    {
        return 'i' . $integer . 'e';
    }

    private static function encodeArray($array)
    {
        if (self::is_list($array)) {
            $return = 'l';
            foreach ($array as $value) {
                $return .= self::encode($value);
            }
        } else {
            ksort($array, SORT_STRING);
            $return = 'd';
            foreach ($array as $key => $value) {
                $return .= self::encode(strval($key)) . self::encode($value);
            }
        }
        return $return . 'e';
    }
    /**
     * End Encode
     */

    /**
     * Decode Torrent File
     * @param $string
     * @return array
     */
    protected static function decode($string)
    {
        $data = is_file($string) || self::url_exists($string) ? self::fileGetContents($string) : $string;
        return (array)self::decodeData($data);
    }

    private static function decodeData(&$data)
    {
        switch (self::char($data)) {
            case 'i':
                $data = substr($data, 1);
                return self::decodeInteger($data);
            case 'l':
                $data = substr($data, 1);
                return self::decodeList($data);
            case 'd':
                $data = substr($data, 1);
                return self::decodeDictionary($data);
            default:
                return self::decodeString($data);
        }
    }

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

    private static function decodeString(&$data)
    {
        if (self::char($data) === '0' && substr($data, 1, 1) != ':') {
            return self::setError(new Exception('Tamanho da String invalida, iniciando do zero'));
        }
        if (!$colon = @strpos($data, ':')) {
            return self::setError(new Exception('Tamanho da String invalida, coluna nao encontrada'));
        }
        $length = intval(substr($data, 0, $colon));
        if ($length + $colon + 1 > strlen($data)) {
            return self::setError(new Exception('String invalida, entrada muito curta para comprimento de string'));
        }
        $string = substr($data, $colon + 1, $length);
        $data = substr($data, $colon + $length + 1);
        return $string;
    }

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
     * End Decode
     */

    protected function build($data, $piece_length)
    {
        if (is_null($data)) {
            return false;
        } elseif (is_array($data) && self::is_list($data)) {
            return $this->info = $this->files($data, $piece_length);
        } elseif (is_dir($data)) {
            return $this->info = $this->folder($data, $piece_length);
        } elseif ((is_file($data) || self::url_exists($data)) && !self::isTorrent($data)) {
            return $this->info = $this->file($data, $piece_length);
        } else {
            return false;
        }
    }

    protected function touch($void = null)
    {
        $this->{'created by'} = config('app.name') . ' ' . config('app.url');
        $this->{'creation date'} = time();
        return $void;
    }

    protected static function setError($exception, $message = false)
    {
        return (array_unshift(self::$errors, $exception) && $message) ? $exception->getMessage() : false;
    }

    protected static function announceList($announce, $merge = [])
    {
        return array_map(function ($a) {
            return (array)$a;
        }, array_merge((array)$announce, (array)$merge));
    }

    protected static function firstAnnounce($announce)
    {
        while (is_array($announce)) {
            $announce = reset($announce);
        }
        return $announce;
    }

    protected static function pack(&$data)
    {
        return pack('H*', sha1($data)) . ($data = null);
    }

    protected static function path($path, $folder = null)
    {
        array_unshift($path, $folder);
        if ($folder == null) {
            return join($path);
        }
        return join(DIRECTORY_SEPARATOR, $path);
    }

    protected static function pathExplode($path)
    {
        return explode(DIRECTORY_SEPARATOR, $path);
    }

    protected static function is_list($array)
    {
        foreach (array_keys($array) as $key) {
            if (!is_int($key)) {
                return false;
            }
        }
        return true;
    }

    private function pieces($handle, $piece_length, $last = true)
    {
        static $piece, $length;
        if (empty($length)) {
            $length = $piece_length;
        }
        $pieces = null;
        while (!feof($handle)) {
            if (($length = strlen($piece .= fread($handle, $length))) == $piece_length) {
                $pieces .= self::pack($piece);
            } elseif (($length = $piece_length - $length) < 0) {
                return self::setError(new Exception('piece length invalido'));
            }
        }
        fclose($handle);
        return $pieces . ($last && $piece ? self::pack($piece) : null);
    }

    private function file($file, $piece_length)
    {
        if (!$handle = self::fileOpen($file, $size = self::fileSize($file))) {
            return self::setError(new Exception('Falha ao abrir o arquivo: "' . $file . '"'));
        }
        if (self::is_url($file)) {
            $this->url_list($file);
        }
        $path = self::pathExplode($file);

        return [
            'length' => $size,
            'name' => end($path),
            'piece length' => $piece_length,
            'pieces' => $this->pieces($handle, $piece_length)
        ];
    }

    private function files($files, $piece_length)
    {
        sort($files);
        usort($files, function ($a, $b) {
            return strrpos($a, DIRECTORY_SEPARATOR) - strrpos($b, DIRECTORY_SEPARATOR);
        });
        $first = current($files);
        if (!self::is_url($first)) {
            $files = array_map('realpath', $files);
        } else {
            $this->url_list(dirname($first) . DIRECTORY_SEPARATOR);
        }
        $files_path = array_map('self::path_explode', $files);
        $root = call_user_func_array('array_intersect_assoc', $files_path);
        $pieces = null;
        $info_files = [];
        $count = count($files) - 1;

        foreach ($files as $key => $file) {
            if (!$handle = self::fileOpen($file, $filesize = self::fileSize($file))) {
                self::setError(new Exception('Falha ao abrir o arquivo "' . $file . '" descartado.'));
                continue;
            }
            $pieces .= $this->pieces($handle, $piece_length, $count == $key);
            $info_files[] = [
                'length' => $filesize,
                'path' => array_diff_assoc($files_path[$key], $root)
            ];
        }

        return [
            'files' => $info_files,
            'name' => end($root),
            'piece length' => $piece_length,
            'pieces' => $pieces
        ];
    }

    private function folder($dir, $piece_length)
    {
        return $this->files(self::scanDir($dir), $piece_length);
    }

    private static function char($data)
    {
        return empty($data) ? false : substr($data, 0, 1);
    }

    public static function format($bytes, $decimals = 2)
    {
        $floor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $floor));
    }

    public static function fileSize($file)
    {
        if (is_file($file)) {
            return (float)sprintf('%u', @filesize($file));
        } elseif ($content_length = preg_grep($pattern = '#^Content-Length:\s+(\d+)$#i', (array)@get_headers($file))) {
            return (int)preg_replace($pattern, '$1', reset($content_length));
        }
    }

    public static function fileOpen($file, $size = null)
    {
        if ((is_null($size) ? self::fileSize($file) : $size) <= 2 * pow(1024, 3)) {
            return fopen($file, 'r');
        } elseif (PHP_OS != 'Linux') {
            return self::setError(new Exception('O tamanho do arquivo é maior que 2 GB. Isso é suportado apenas no Linux'));
        } elseif (!is_readable($file)) {
            return false;
        } else {
            return popen('cat ' . escapeshellarg(realpath($file)), 'r');
        }
    }

    public static function scanDir($dir)
    {
        $paths = [];
        foreach (scandir($dir) as $item) {
            if ($item != '.' && $item != '..') {
                if (is_dir($path = realpath($dir . DIRECTORY_SEPARATOR . $item))) {
                    $paths = array_merge(self::scanDir($path), $paths);
                } else {
                    $paths[] = $path;
                }
            }

        }
        return $paths;
    }

    public static function is_url($url)
    {
        return preg_match('#^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$#i', $url);
    }

    public static function url_exists($url)
    {
        return self::is_url($url) ? (bool)self::fileSize($url) : false;
    }

    public static function isTorrent($file, $timeout = self::timeout)
    {
        return ($start = self::fileGetContents($file, $timeout, 0, 11))
            && 'd8:announce' === $start
            || 'd10:created' === $start
            || 'd13:creatio' === $start
            || 'd13:announc' === $start
            || 'd12:_info_l' === $start
            || 'd7:comment' === substr($start, 0, 10) // @see https://github.com/adriengibrat/torrent-rw/issues/32
            || 'd4:info' === substr($start, 0, 7)
            || 'd9:' === substr($start, 0, 3); // @see https://github.com/adriengibrat/torrent-rw/pull/17
    }

    public static function fileGetContents($file, $timeout = self::timeout, $offset = null, $length = null)
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
