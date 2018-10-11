<?php
namespace App\Apis;


class ApiService
{


    /**
     * Get a Shipment Information JSON from the api using the reference code
     * @param $reference String shipment reference
     * @return JSON object
     */
    public static function getShipmentData($reference = null)
    {
        $shipmentInfo = self::sendRequest($reference);

        return json_decode($shipmentInfo, true);
    }


    /**
     * Method to send request to the api
     * @param $reference String shipment reference
     * @return Object response api 
     */
    private static function sendRequest($reference)
    {
        $request = curl_init(env('DELIVEREA_API_URL', null) . $reference);
        curl_setopt($request, CURLOPT_USERPWD, env('DELIVEREA_API_USER', null) . ":" . env('DELIVEREA_API_PASSWORD', null));
        curl_setopt($request, CURLOPT_TIMEOUT, 30);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($request);
        curl_close($request);

        return $response;
    }
}

