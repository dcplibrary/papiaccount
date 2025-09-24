<?php

namespace Dcplibrary\PAPIAccount\App\Services;

use Blashbrook\PAPIClient\PAPIClient;
use Dcplibrary\PAPIAccount\App\Models\PatronCode;

class PAPIPatronCodeFetcher
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
                    ->uri('patroncodes')
                    ->execRequest();

        if (!isset($response['PatronCodesRows']) || !is_array($response['PatronCodesRows'])) {
            throw new \Exception('Invalid API response: PatronCodesRows missing or not an array.');
        }

        $apiCodes = $response['PatronCodesRows'];
        $apiIds = [];

        foreach ($apiCodes as $item) {
            PatronCode::updateOrCreate(
                ['PatronCodeID' => $item['PatronCodeID']],
                ['Description' => $item['Description']]
            );
            $apiIds[] = $item['PatronCodeID'];
        }

        // Delete local records not in the API
        PatronCode::whereNotIn('PatronCodeID', $apiIds)->delete();

        return count($apiIds);
    }
}
