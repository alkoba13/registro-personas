<?php

/**
 * Functions for Persons table
 * PHP Version 8.3.6
 *
 * @category controller
 * @package  PERSONS TEST
 * @author   Angel Sandoval <alkoba.sandoval13@gmail.com.com>
 * @license  proprietary software
 * @since    1.0.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Person\StoreRequest;
use App\Http\Requests\Person\IndexRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/person",
     *     tags={"Person"},
     *     summary="Get all persons.",
     *     @OA\Parameter(
     *         description="Page",
     *         in="query",
     *         name="page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             default="1"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Size",
     *         in="query",
     *         name="size",
     *         required=true,
     *         @OA\Schema(
     *             enum={5,10,25},
     *             type="integer",
     *             format="int64",
     *             default="10"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Search",
     *         in="query",
     *         name="search",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         description="Order by",
     *         in="query",
     *         name="orderBy",
     *         @OA\Schema(
     *             type="string",
     *             enum={
     *                 "name",
     *                 "surname",
     *                 "second_surname",
     *                 "email",
     *                 "phone_number",
     *                 "postal_code",
     *                 "state"
     *             }
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Order operator",
     *         in="query",
     *         name="orderOperator",
     *         @OA\Schema(
     *             type="string",
     *             enum={"DESC","ASC"}
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(
     *         response=400,
     *         description="BAD REQUEST."
     *     )
     * )
     */

    public function index(IndexRequest $request)
    {
        $req = $request->all();
        $qb = Person::select();

        if (isset($req['search'])) {
            $qb->where(function ($query) use ($req) {
                $query->where('name', 'like', '%' . $req['search'] . '%')
                    ->orWhere('surname', 'like', '%' . $req['search'] . '%')
                    ->orWhere('second_surname', 'like', '%' . $req['search'] . '%')
                    ->orWhere('email', 'like', '%' . $req['search'] . '%')
                    ->orWhere('postal_code', 'like', '%' . $req['search'] . '%')
                    ->orWhere('state', 'like', '%' . $req['search'] . '%');
            });
        }

        if (isset($req['orderBy']) && isset($req['orderOperator'])) {
            $qb->orderBy($req['orderBy'], $req['orderOperator']);
        }

        return resp('codes.SUCCESS', 'success', $qb->paginate($req['size']));
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/person",
     *     tags={"Person"},
     *     summary="Crete new person.",
     *     @OA\RequestBody(
     *         description="Register person",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/person")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Test sesion."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="BAD REQUEST."
     *     )
     * )
     */
    public function store(StoreRequest $request)
    {
        $req = $request->all();
        DB::beginTransaction();
        try {
            $person = Person::create($req);
            DB::commit();
            return resp('codes.SUCCESS', 'success', $person);
        } catch (\Exception $e) {
            DB::rollBack();
            return resp(
                'codes.BAD_REQ',
                'The server cannot not process the request due to be a client error', 
                $e->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/api/person/{id}",
     *     tags={"Person"},
     *     summary="Delete person.",
     *     @OA\Parameter(
     *         description="Person id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Test sesion."
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="This id not exists"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="BAD REQUEST."
     *     )
     * )
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $person = Person::find($id);
            if (!$person) {
                return resp('codes.NO_EXISTS', 'This id not exists');
            }
            $person->delete();
            DB::commit();
            return resp('codes.SUCCESS', 'success', $person);
        } catch (\Exception $e) {
            DB::rollBack();
            return resp(
                'codes.BAD_REQ',
                'The server cannot not process the request due to be a client error',
                $e->getMessage()
            );
        }
    }
}
