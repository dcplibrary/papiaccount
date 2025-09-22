<?php

    namespace App\Services;

    use Blashbrook\PAPIClient\Clients\PAPIClient;
    use App\Models\PatronCode;

    class PAPIPatronCodeFetcher
    {
        /**
        * Fetches data from the external API and populates the database.
        *
        * @param string $uri
        * @return int The number of records imported.
        * @throws \Exception
        */
        public function fetchAndPopulate($uri): int
        {
            $papiclient = new PAPIClient;
            $response = $papiclient::publicRequest('GET', $uri);

/*            if ($response->failed()) {
                throw new \Exception('Failed to connect to the API. Status: ' . $response->status());
            }*/

            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            if (!isset($body['PatronCodesRows']) || !is_array($body['PatronCodesRows'])) {
                throw new \Exception('Invalid API response: PatronCodesRows missing or not an array.');
            }

            $apiCodes = $body['PatronCodesRows'];
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
