<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userById(int $id) {
        $user = User::where('id',$id)->with(['vaccination'])->first();
        return $user;
    }

    public function updateUser(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = User::with(['vaccination'])
                ->where('id', $id)->first();
            if ($user != null) {
                $request = $this->parseRequest($request);
                $user->update($request->all());

                // if isset
                if(isset($request['vaccination_id'])) {
                    $vacc = Vaccination::find($request->vaccination_id);
                    $user->vaccination()->associate($vacc);
                }
                $user->save();
            }
            DB::commit();
            $user1 = User::with(['vaccination'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($user1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating user failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {
        return $request;
    }
}
