<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\UserServiceInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const INDEX_PAGE = "Users";

    public function __construct(private UserServiceInterface $repo)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [];
            $data['page'] = self::INDEX_PAGE;
            $data['users'] = $this->repo->getUsers();
            dd($data);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
