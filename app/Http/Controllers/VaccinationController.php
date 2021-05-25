<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VaccinationController extends Controller
{
    public function index() {
        $vaccinations = Vaccination::with(['location', 'users'])->get();
        return $vaccinations;
    }

    public function findById(int $id) {
        $vaccination = Vaccination::where('id',$id)->with(['location', 'users'])->first();
        return $vaccination;
    }

    public function findBySearchTerm(string $searchTerm) {
        $vaccination = Vaccination::with(['location', 'users'])
            ->where('peopleMax', 'LIKE', '%' . $searchTerm. '%')
            ->orWhere('vaccDate' , 'LIKE', '%' . $searchTerm. '%')

            //search by location
            ->orWhereHas('location', function ($query) use ($searchTerm) {
                $query->where('city', 'LIKE', '%' . $searchTerm. '%')
                ->orWhere('zipcode', 'LIKE', '%' . $searchTerm. '%');
            })
            //search by user
            ->orWhereHas('users', function ($query) use ($searchTerm) {
                $query->where('username', 'LIKE', '%' . $searchTerm. '%')
                ->orWhere('gender', 'LIKE', '%' . $searchTerm. '%')
                ->orWhere('ssn', 'LIKE', '%' . $searchTerm. '%')
                ->orWhere('firstName', 'LIKE', '%' . $searchTerm. '%')
                ->orWhere('lastName', 'LIKE', '%' . $searchTerm. '%');
            })
        ->get();
        return $vaccination;
    }

    /**
     * create new Vaccination
     */
    public function save(Request $request) : JsonResponse  {
        $request = $this->parseRequest($request);
        /*+
        *  use a transaction for saving model including relations
        * if one query fails, complete SQL statements will be rolled back
        */
        DB::beginTransaction();
        try {
            $vaccination = Vaccination::create($request->all());
            DB::commit();
            // return a vaild http response
            return response()->json($vaccination, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving vaccination failed: " . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $vaccination = Vaccination::with(['location', 'users'])
                ->where('id', $id)->first();
            if ($vaccination != null) {
                $request = $this->parseRequest($request);
                $vaccination->update($request->all());
                $vaccination->save();
            }
            DB::commit();
            $vaccination1 = Vaccination::with(['location', 'users'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($vaccination1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating vaccination failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id) : JsonResponse
    {
        $vaccination = Vaccination::where('id', $id)->first();
        if ($vaccination != null) {
            $vaccination->delete();
        }
        else
            throw new \Exception("vaccination couldn't be deleted - it does not exist");
        return response()->json('vaccination (' . $id . ') successfully deleted', 200);
    }


    //Hilfsmethode
    /**
     * modify / convert values if needed
     */
    private function parseRequest(Request $request) : Request {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $from = new \DateTime($request->from);
        $request['from'] = $from;
        $to = new \DateTime($request->to);
        $request['to'] = $to;
        $vaccDate = new \Carbon\Carbon($request->vaccDate);
        $request['vaccDate'] = $vaccDate;
        return $request;
    }
}
