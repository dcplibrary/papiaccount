<?php

namespace Dcplibrary\PAPIAccount\App\Services;

use Blashbrook\PAPIClient\PAPIClient;
use Dcplibrary\PAPIAccount\App\Models\PatronUdf;

class PAPIPatronUdfsFetcher
{
    public PAPIClient $papiclient;

    public function __construct(PAPIClient $papiclient)
    {
        $this->papiclient = $papiclient;
    }

    public function fetchAndPopulate(): int
    {
        $papiclient = new PAPIClient();
        $response = $this->papiclient
                    ->method('get')
                    ->uri('patronudfs')
                    ->execRequest();

        if (!isset($response['PatronUdfConfigsRows']) || !is_array($response['PatronUdfConfigsRows'])) {
            throw new \Exception('Invalid API response: PatronUdfConfigsRows missing or not an array.');
        }

        $apiCodes = $response['PatronUdfConfigsRows'];
        $apiIds = [];

        foreach ($apiCodes as $item) {
            PatronUdf::updateOrCreate([
                'PatronUdfID'  => $item['PatronUdfID'],
                'Label'        => $item['Label'],
                'Display'      => $item['Display'],
                'Values'       => $item['Values'],
                'Required'     => $item['Required'],
                'DefaultValue' => $item['DefaultValue'],
            ]);
            $apiIds[] = $item['PatronUdfID'];
        }

        // Delete local records not in the API
        PatronUdf::whereNotIn('PatronUdfID', $apiIds)->delete();

        return count($apiIds);
    }
}
