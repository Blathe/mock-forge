<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Jobs\CreateEndpointHistory;

class ApiController extends Controller
{

    public function insertFakerData($payload) {
        $payload = json_encode($payload);

        $faker = Factory::create();

        $result = preg_replace_callback('/{{(.*?)}}/', function ($matches) use ($faker) {
            $placeholder = $matches[1];
            switch ($placeholder) {
                case 'name':
                    return $faker->name();
                case 'email':
                    return $faker->unique()->safeEmail();
                case 'number':
                    return $faker->randomNumber(2);
                case 'string':
                    return $faker->sentence(3);
                default:
                    return $matches[0];
            }
        }, $payload);

        $payload = json_decode($result);

        return $payload;
    }

    public function show(Request $request, $user_id, $slug): JsonResponse {

        //TODO: A lot of stuff in this controller should be done through Queues.
        $start_time = Carbon::now();
        $user = User::where('id', $user_id)->firstOrFail();

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
                $response_time = $start_time->diffInMilliseconds(Carbon::now());
                CreateEndpointHistory::dispatch($endpoint->id, 401, $response_time); //create an unauthorized attempt in history.
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }

        $data = $this->insertFakerData($endpoint->payload);

        $response = response()->json($data, $endpoint->status_code);
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
