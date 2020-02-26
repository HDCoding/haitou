<?php

namespace App\Helpers;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class Toastr
{
    protected $session;
    protected $config;
    protected $messages = [];

    public function __construct(SessionManager $session, Repository $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    public function message()
    {
        $messages = $this->session->get('toastr::messages');

        if (!$messages) {
            $messages = [];
        }

        foreach ($messages as $message) {
            $config = (array)$this->config->get('toastr.options');

            $script = '';

            if (count($message['options'])) {
                $config = array_merge($config, $message['options']);
            }
            if ($config) {
                $script .= 'toastr.options = ' . json_encode($config) . ';';
            }

            $title = $message['title'] ?: null;

            $script .= 'toastr.' . $message['type'] . '(\'' . $message['message'] . "','$title" . '\');';

            return $script;
        }
    }

    public function info($message, $title = null, $options = [])
    {
        $this->add('info', $message, $title, $options);
    }

    public function add($type, $message, $title = null, $options = [])
    {
        $types = ['error', 'info', 'success', 'warning'];

        if (!in_array($type, $types)) {
            throw new Exception("The $type remind message is not valid.");
        }

        $this->messages[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'options' => $options
        ];

        $this->session->flash('toastr::messages', $this->messages);
    }

    public function success($message, $title = null, $options = [])
    {
        $this->add('success', $message, $title, $options);
    }

    public function warning($message, $title = null, $options = [])
    {
        $this->add('warning', $message, $title, $options);
    }

    public function error($message, $title = null, $options = [])
    {
        $this->add('error', $message, $title, $options);
    }

    /**
     * Clear messages
     */
    public function clear()
    {
        $this->messages = [];
    }
}
