<?php

namespace App\Http\Controllers\API\V1;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Http\Controllers\Controller;
use App\Models\CheckIn;
use App\Models\Client;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    use CoreJsonResponse;

    // "country", "city", "long", "lat", "client_id"
    public function index()
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $checkIns = $client->checkIns()->get()->all();
        return $this->ok(["locations" => $checkIns]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "country" => ["required", "string"],

            "city" => ["required", "string"], "long" => ["required"], "lat" => ["required"]

        ]);
        $data = $request->all();

        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $data["client_id"] = $client->id;

        $checkIn = CheckIn::create($data);
        return $this->created(["locations" => $checkIn]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "country" => ["required", "string"],

            "city" => ["required", "string"], "long" => ["required"], "lat" => ["required"]

        ]);
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $checkin = $client->checkIns()->find($id);
        if ($checkin) {
            $checkin->update($request->all());
            $checkin->save();
            return $this->created(["location" => $checkin]);
        }
    }

    public function destroy($id)
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $checkin = $client->checkIns()->find($id);
        if ($checkin) {
            $checkin->delete();
            return $this->ok(["location deleted"]);
        }
    }
}
