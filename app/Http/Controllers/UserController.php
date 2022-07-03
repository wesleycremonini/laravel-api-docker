<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as Status;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(['users' => User::all()], Status::HTTP_OK);
    }


    public function store(Request $request)
    {
        $user = User::create([]);
        return response()->json(['user' => $user], Status::HTTP_CREATED);
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
