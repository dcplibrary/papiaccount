<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PatronCodeRequest;
    use App\Http\Resources\PatronCodeResource;
    use App\Models\PatronCode;
    use Blashbrook\PAPIClient\Clients\PAPIClient;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    class PatronCodeController extends Controller
    {
        use AuthorizesRequests;

        public function index()
        {
            $this->authorize('viewAny', PatronCode::class);

            return PatronCodeResource::collection(PatronCode::all());
        }

        public function store(PatronCodeRequest $request)
        {
            $this->authorize('create', PatronCode::class);

            return new PatronCodeResource(PatronCode::create($request->validated()));
        }

        public function show(PatronCode $patronCode)
        {
            $this->authorize('view', $patronCode);

            return new PatronCodeResource($patronCode);
        }

        public function update(PatronCodeRequest $request, PatronCode $patronCode)
        {
            $this->authorize('update', $patronCode);

            $patronCode->update($request->validated());

            return new PatronCodeResource($patronCode);
        }

        public function destroy(PatronCode $patronCode)
        {
            $this->authorize('delete', $patronCode);

            $patronCode->delete();

            return response()->json();
        }

        /**
         * @TODO Add write PatronCode results to database
         * @TODO Create scheduled task to update PatronCodes
         *
         *
         * @return mixed
         * @throws \GuzzleHttp\Exception\GuzzleException
         */
        public static function getPatronCodes()
        {
            $papiclient = new PAPIClient();
           $result = $papiclient::publicRequest('GET', 'patroncodes');
            return json_decode($result->getBody());
        }

        /*
         * @TODO Move getPatronUDFs to proper controller
         *  @TODO Add write PatronUDFs results to database
         * @TODO Create scheduled task to update PatronUDFs
         */
        public static function getPatronUDFs()
        {
            $papiclient = new PAPIClient();
            $result = $papiclient::publicRequest('GET', 'patronudfs');
            return json_decode($result->getBody());
        }
    }
