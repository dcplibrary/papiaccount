<?php

    namespace App\Services;

    use App\Models\PatronUdf;
    use Blashbrook\PAPIClient\Clients\PAPIClient;

    class PAPIPatronUdfsFetcher
    {
        /**
        * Fetches data from the external API and populates the database.
        *
        * @param string $uri
        * @return int The number of records imported.
        * @throws \Exception
        */
        public function fetchAndPopulate(): int
        {
            $papiclient = new PAPIClient;
            $response = $papiclient::publicRequest('GET', 'patronudfs');

/*            if ($response->failed()) {
                throw new \Exception('Failed to connect to the API. Status: ' . $response->status());
            }*/

            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            if (!isset($body['PatronUdfConfigsRows']) || !is_array($body['PatronUdfConfigsRows'])) {
                throw new \Exception('Invalid API response: PatronUdfConfigsRows missing or not an array.');
            }

            $apiCodes = $body['PatronUdfConfigsRows'];
            $apiIds = [];

            foreach ($apiCodes as $item) {
                PatronUdf::updateOrCreate([
                    'PatronUdfID' => $item['PatronUdfID'],
                    'Label' => $item['Label'],
                    'Display' => $item['Display'],
                    'Values' => $item['Values'],
                    'Required' => $item['Required'],
                    'DefaultValue' => $item['DefaultValue']
                ]);
                $apiIds[] = $item['PatronUdfID'];
            }

            // Delete local records not in the API
            PatronUdf::whereNotIn('PatronUdfID', $apiIds)->delete();

            return count($apiIds);
        }

    }
