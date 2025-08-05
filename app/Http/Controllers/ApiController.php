<?php

namespace App\Http\Controllers;

use App\Jobs\CreateEndpointHistory;
use App\Models\Endpoint;
use App\Models\EndpointHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function show(Request $request, $user, $slug): JsonResponse {

        //TODO: A lot of stuff in this controller should be done through Queues.
        $start_time = Carbon::now();
        $user = User::where('id', $user)->firstOrFail();

        $endpoint = Endpoint::where('user_id', $user->id)
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$endpoint->is_public) {
            return response()->json(['message' => 'Endpoint not found.'], 404);
        }

        if ($endpoint->delay_ms) {
            usleep($endpoint->delay_ms * 1000);
        }

        if ($endpoint->require_auth) {
            $provided = $request->bearerToken();
            if(!$provided || $provided !== $endpoint->auth_token) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }

        $response = response()->json($endpoint->payload, $endpoint->status_code);
        if ($endpoint->headers && is_array($endpoint->headers)) {
            foreach ($endpoint->headers as $key => $value) {
                $response->header($key, $value);
            }
        }

        $response_time = $start_time->diffInMilliseconds(Carbon::now());
        CreateEndpointHistory::dispatch($endpoint->id, $response->status(), $response_time);

        $endpoint->request_count += 1;
        $endpoint->save();

        return $response;
    }
}
