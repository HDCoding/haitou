<?php

namespace App\Helpers;

class NetworkInformation
{
    public function formatBitrate($bytes, $seconds)
    {
        $units = ['bit', 'kbit', 'mbit', 'gbit', 'tbit'];
        $bits = ($bytes * 8) / $seconds;
        $pow = floor(($bits ? log($bits) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bits /= (1 << (10 * $pow));

        return round($bits, 2) . ' ' . $units[$pow] . '/s';
    }

    public function formatRatio($incoming, $outcoming)
    {
        $total = $incoming + $outcoming;
        $percentage = ($incoming / $total * 100);

        return sprintf('<div class="ratio"><div style="width: %f%%;"></div></div>', $percentage);
    }

    public function hourly($interface)
    {
        $data = $this->processData();

        $traffic_data = [];

        $index = array_search($interface, array_column($data['interfaces'], 'id'));

        $i = 0;

        foreach ($data['interfaces'][$index]['traffic']['hours'] as $traffic) {

            if (is_array($traffic)) {
                $i++;

                if (round($data['jsonversion']) == 1) {
                    $hour = $traffic['id'];
                } else {
                    $hour = $traffic['time']['hour'];
                }

                $traffic_data[$i]['label'] = date('d/m/Y H:i', mktime($hour, 0, 0, $traffic['date']['month'], $traffic['date']['day'], $traffic['date']['year']));
                $traffic_data[$i]['time'] = mktime($hour, 0, 0, $traffic['date']['month'], $traffic['date']['day'], $traffic['date']['year']);
                $traffic_data[$i]['rx'] = make_size($traffic['rx']);
                $traffic_data[$i]['tx'] = make_size($traffic['tx']);
                $traffic_data[$i]['total'] = make_size($traffic['rx'] + $traffic['tx']);
            }

        }

        return $traffic_data;
    }

    private function processData()
    {
        // Execute a command to output a json dump of the vnstat data
        if (is_readable('/usr/bin/vnstat')) {

            // Execute a command to output a json dump of the vnstat data
            $vnstatStream = popen('/usr/bin/vnstat --json', 'r');

            // Is the stream valid?
            if (is_resource($vnstatStream)) {
                $streamBuffer = '';
                while (!feof($vnstatStream)) {
                    $streamBuffer .= fgets($vnstatStream);
                }
                // Close the handle
                pclose($vnstatStream);

                return json_decode($streamBuffer, true);
            }
        }
    }

    public function daily($interface)
    {
        $data = $this->processData();

        $traffic_data = [];

        $index = array_search($interface, array_column($data['interfaces'], 'id'));

        $i = 0;

        foreach ($data['interfaces'][$index]['traffic']['days'] as $traffic) {

            if (is_array($traffic)) {
                $i++;

                $traffic_data[$i]['label'] = date('d/m/Y', mktime(0, 0, 0, $traffic['date']['month'], $traffic['date']['day'], $traffic['date']['year']));
                $traffic_data[$i]['rx'] = make_size($traffic['rx']);
                $traffic_data[$i]['tx'] = make_size($traffic['tx']);
                $traffic_data[$i]['total'] = make_size($traffic['rx'] + $traffic['tx']);
            }

        }

        return $traffic_data;
    }

    public function monthly($interface)
    {
        $data = $this->processData();

        $traffic_data = [];

        $index = array_search($interface, array_column($data['interfaces'], 'id'));

        $i = 0;

        foreach ($data['interfaces'][$index]['traffic']['months'] as $traffic) {

            if (is_array($traffic)) {
                $i++;

                $traffic_data[$i]['label'] = sprintf("%d / %d", $traffic['date']['month'], $traffic['date']['year']);
                $traffic_data[$i]['rx'] = make_size($traffic['rx']);
                $traffic_data[$i]['tx'] = make_size($traffic['tx']);
                $traffic_data[$i]['total'] = make_size($traffic['rx'] + $traffic['tx']);
            }

        }

        return $traffic_data;
    }

    public function topten($interface)
    {
        $data = $this->processData();

        $traffic_data = [];

        $index = array_search($interface, array_column($data['interfaces'], 'id'));

        $i = 0;

        foreach ($data['interfaces'][$index]['traffic']['tops'] as $traffic) {

            if (is_array($traffic)) {
                $i++;

                $traffic_data[$i]['label'] = date('d/m/Y', strtotime($traffic['date']['month'] . "/" . $traffic['date']['day'] . "/" . $traffic['date']['year']));
                $traffic_data[$i]['rx'] = make_size($traffic['rx']);
                $traffic_data[$i]['tx'] = make_size($traffic['tx']);
                $traffic_data[$i]['total'] = make_size($traffic['rx'] + $traffic['tx']);
                $traffic_data[$i]['totalraw'] = ($traffic['rx'] + $traffic['tx']);
            }

        }

        return $traffic_data;
    }

    public function data()
    {
        $data = $this->processData();

        return [
            'version' => $data['vnstatversion'],
            'json_version' => $data['jsonversion']
        ];
    }
}
