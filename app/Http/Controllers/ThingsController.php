<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThingRequest;
use App\Http\Requests\UpdateThingRequest;
use Illuminate\Http\Request;
use App\Models\ThingModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as Status;

class ThingsController extends Controller
{

    public function index()
    {
        return response()->json(['things' => ThingModel::paginate()], Status::HTTP_OK);
    }

    public function store(StoreThingRequest $request)
    {
        $found = ThingModel::where('user_id', $request->user()->id)->first();

        if ($found) {
            return response()->json(['error' => 'Você só pode ter uma Coisa.'], Status::HTTP_BAD_REQUEST);
        }

        $thing = ThingModel::create([
            'user_id' => $request->user()->id,
            'one' => $request->one,
            'two' => $request->two,
            'three' => $request->three,
        ]);

        return response()->json(['thing' => $thing], Status::HTTP_CREATED);
    }

    public function show($id)
    {
        try {
            $thing = ThingModel::where('user_id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "Coisa do usuário id:{$id} não encontrada"], Status::HTTP_NOT_FOUND);
        }
        return response()->json(['thing' => $thing], Status::HTTP_OK);
    }

    public function update(UpdateThingRequest $request, $id)
    {
        try {
            $thing = ThingModel::where('user_id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "Coisa do usuário id:{$id} não encontrada"], Status::HTTP_NOT_FOUND);
        }
        $thing->update($request->only('one', 'two', 'three'));
        return response()->json(['thing' => $thing], Status::HTTP_OK);
    }

    public function destroy($id)
    {
        try {
            $thing = ThingModel::where('user_id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "Coisa do usuário id:{$id} não encontrada"], Status::HTTP_NOT_FOUND);
        }
        $thing->delete();
        return response()->json(['message' => 'Coisa removida com sucesso'], Status::HTTP_OK);
    }
}
