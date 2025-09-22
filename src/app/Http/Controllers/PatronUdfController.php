<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PatronUdfRequest;
    use App\Http\Resources\PatronUdfResource;
    use App\Models\PatronUdf;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    class PatronUdfController extends Controller
    {
        use AuthorizesRequests;

        public function index()
        {
            $this->authorize('viewAny', PatronUdf::class);

            return PatronUdfResource::collection(PatronUdf::all());
        }

        public function store(PatronUdfRequest $request)
        {
            $this->authorize('create', PatronUdf::class);

            return new PatronUdfResource(PatronUdf::create($request->validated()));
        }

        public function show(PatronUdf $patronUdf)
        {
            $this->authorize('view', $patronUdf);

            return new PatronUdfResource($patronUdf);
        }

        public function update(PatronUdfRequest $request, PatronUdf $patronUdf)
        {
            $this->authorize('update', $patronUdf);

            $patronUdf->update($request->validated());

            return new PatronUdfResource($patronUdf);
        }

        public function destroy(PatronUdf $patronUdf)
        {
            $this->authorize('delete', $patronUdf);

            $patronUdf->delete();

            return response()->json();
        }
    }
