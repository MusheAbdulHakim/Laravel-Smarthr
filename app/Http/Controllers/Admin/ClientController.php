<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "clients";
        $clients = Client::get();
        return view('backend.clients.clients', compact('title', 'clients'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "clients";
        $clients = Client::get();
        return view('backend.clients.clients-list', compact('title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/clients'), $imageName);
            $validatedData['avatar'] = $imageName;
        } else {
            $validatedData['avatar'] = null;
        }

        Client::create($validatedData);

        return back()->with('success', 'Client has been added successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Client $client)
    {
        return view('backend.clients.clients-edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {

            if ($client->avatar) {
                $oldAvatarPath = public_path('storage/clients/' . $client->avatar);
                if (File::exists($oldAvatarPath)) {
                    File::delete($oldAvatarPath);
                }
            }

            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/clients'), $imageName);
            $validatedData['avatar'] = $imageName;
        }

        $client->update($validatedData);

        return back()->with('success', 'Client has been updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->id);

        if ($client->avatar) {
            $avatarPath = public_path('storage/clients/' . $client->avatar);
            if (File::exists($avatarPath)) {
                File::delete($avatarPath);
            }
        }

        $client->delete();
        return back()->with('success', "Client has been deleted successfully!!");
    }
}
