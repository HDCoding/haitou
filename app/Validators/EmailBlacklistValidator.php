<?php

namespace App\Validators;

use App\Helpers\BlacklistUpdater;
use Illuminate\Support\Facades\Cache;

class EmailBlacklistValidator
{
    /**
     * Array of blacklisted domains
     */
    private $domains = [];

    /**
     * Generate the error message on validation failure
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     * @return string
     */
    public function message($message, $attribute, $rule, $parameters)
    {
        //provide custom error message
        return "Domínio de {$attribute} não permitido, domínio descartável (na lista negra).";
    }

    /**
     * Execute the validation routine.
     *
     * @param string $attribute .
     * @param string $value .
     * @param array $parameters .
     *
     * @return bool.
     **/
    public function validate($attribute, $value, $parameters)
    {
        //load blacklisted domains
        $this->refresh();

        //extract domain from supplied email address
        $domain = str_after(strtolower($value), "@");

        //run validation check
        return !in_array($domain, $this->domains);
    }

    /**
     * Retrive latest selection of blacklisted domains and cache them
     * @param null
     * @return void
     */
    public function refresh()
    {
        //
        $this->shouldUpdate();
        // Retrieve blacklisted domains (preferably from the cache)
        $this->domains = Cache::get(config('email-blacklist.email.cache-key'), []);
        //
        $this->appendCustomDomains();
    }

    protected function shouldUpdate()
    {
        $autoupdate = config('email-blacklist.email.auto-update');
        if ($autoupdate && !Cache::has(config('email-blacklist.email.cache-key'))) {
            BlacklistUpdater::update();
        }
    }

    protected function appendCustomDomains()
    {
        $appendList = config('email-blacklist.email.append');
        if ($appendList === null) {
            return;
        }
        $appendDomains = explode('|', strtolower($appendList));
        $this->domains = array_merge($this->domains, $appendDomains);
    }
}
