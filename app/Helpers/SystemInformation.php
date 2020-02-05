<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\DB;

class SystemInformation
{
    public function avg()
    {
        if (is_readable('/proc/loadavg')) {
            return (float)file_get_contents('/proc/loadavg');
        }
    }

    public function memory()
    {
        if (is_readable('/proc/meminfo')) {
            $content = file_get_contents('/proc/meminfo');
            preg_match('/^MemTotal: \s*(\d*)/m', $content, $matches);
            $total = $matches[1] * 1024;
            preg_match('/^MemFree: \s*(\d*)/m', $content, $matches);
            $free = $matches[1] * 1024;
            $used = $total - $free;

            return [
                'total' => make_size($total),
                'free' => make_size($free),
                'used' => make_size($used),
                'percentage' => sprintf('%.2f', ($used / $total) * 100)
            ];
        }

        return [
            'total' => 0,
            'free' => 0,
            'used' => 0,
            'percentage' => 0
        ];
    }

    public function disk()
    {
        $total = disk_total_space(base_path());
        $free = disk_free_space(base_path());
        $used = $total - $free;

        return [
            'total' => make_size($total),
            'free' => make_size($free),
            'used' => make_size($used),
            'percentage' => sprintf('%.2f', ($used / $total) * 100)
        ];
    }

    public function uptime()
    {
        if (is_readable('/proc/uptime')) {

            $uptime = file_get_contents('/proc/uptime');

            if ($uptime !== false) {
                $uptime = explode(' ', $uptime);
                $uptime = $uptime[0];
                $days = explode('.', (($uptime % 31556926) / 86400));
                $hours = explode('.', ((($uptime % 31556926) % 86400) / 3600));
                $minutes = explode('.', (((($uptime % 31556926) % 86400) % 3600) / 60));
                $time = '.';

                if ($minutes > 0) {
                    $time = $minutes[0] . ' minuto' . ($minutes[0] >= 1 ? 's' : '') . $time;
                }
                if ($minutes > 0 && ($hours > 0 || $days > 0)) {
                    $time = ', ' . $time;
                }
                if ($hours > 0) {
                    $time = $hours[0] . ' hora' . ($hours[0] >= 1 ? 's' : '') . $time;
                }
                if ($hours > 0 && $days > 0) {
                    $time = ', ' . $time;
                }
                if ($days > 0) {
                    $time = $days[0] . ' dia' . ($days[0] >= 1 ? 's' : '') . $time;
                }
            } else {
                $time = false;
            }
        } else {
            $time = false;
        }
        return $time;
    }

    public function system_time()
    {
        return now();
    }

    public function basic()
    {
        return [
            'os' => php_uname('s'),
            'php' => substr(phpversion(), 0, 6),
            'database' => $this->database(),
            'laravel' => app()->version()
        ];
    }

    private function database()
    {
        $list = [
            'sqlite',
            'mysql',
            'pgsql',
            'sqlsrv'
        ];
        if (!in_array(config('database.default'), $list)) {
            return 'Desconhecido';
        }

        $result = DB::select(DB::raw('select version() as mysql_version'));

        return substr($result[0]->{'mysql_version'}, 0, 6);
    }

    /**
     * Get all the directory permissions as well as the recommended ones.
     */
    public function directoryPermissions()
    {
        return [
            [
                'directory' => base_path('bootstrap/cache'),
                'permission' => $this->getDirectoryPermission('bootstrap/cache'),
                'recommended' => '0775',
            ],
            [
                'directory' => base_path('public'),
                'permission' => $this->getDirectoryPermission('public'),
                'recommended' => '0775',
            ],
            [
                'directory' => base_path('storage'),
                'permission' => $this->getDirectoryPermission('storage'),
                'recommended' => '0775',
            ],
            [
                'directory' => base_path('vendor'),
                'permission' => $this->getDirectoryPermission('vendor'),
                'recommended' => '0775',
            ],
        ];
    }

    /**
     * Get the file permissions for a specific path/file.
     * @param $path
     * @return false|string
     */
    public function getDirectoryPermission(string $path)
    {
        try {
            return substr(sprintf('%o', fileperms(base_path($path))), -4);
        } catch (Exception $ex) {
            return 'Erro';
        }
    }
}
