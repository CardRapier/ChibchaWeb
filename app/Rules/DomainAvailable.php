<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DomainAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domain = $value;
        $urlArray = explode(".", $domain);
        $passes = true;

        if (sizeof($urlArray) == 1) {
            $passes = false;
        } else if (sizeof($urlArray) == 3) {
            $domain = $urlArray[1] . $urlArray[2];
        }

        if ($passes == true) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ote-godaddy.com/v1/domains/available?domain={$domain}&checkType=FAST&forTransfer=false",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "application/json",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    'Content-Type: application/json',
                    'Authorization: sso-key 3mM44UaCaqRSmW_MUo6n4r5tiKsMBeQTLPQYL:AaFRJWKDxMgoXLBRu2VonY'
                ),
            ));

            $validation = json_decode(curl_exec($curl), true);

            if (!isset($validation['code']) and $validation['available'] == true) {
                $passes = true;
            } else {
                $passes = false;
            }

            $err = curl_error($curl);

            curl_close($curl);

            return $passes;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Domain is not available or it doesnt exist, insert a domain like the next one: Chibchaweb.com';
    }
}
