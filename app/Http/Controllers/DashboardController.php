<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\LectureRoom;
use App\Models\User;
use App\Models\Labour;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = Hostel::get();
        $no_hostels=count($hostels);
        $restaurants = Restaurant::get();
        $no_restaurants=count($restaurants);
        $shops = Shop::get();
        $no_shops=count($shops);
        $hotels = Hotel::get();
        $no_hotels=count($hotels);
        $lectureRooms = LectureRoom::get();
        $no_lectureRooms=count($lectureRooms);
        $users = User::get();
        $no_users=count($users);
        $labours = Labour::get();
        $no_labours=count($labours);
        return view('admin.dashboard', compact('no_hostels','no_hotels','no_restaurants','no_labours','no_shops','no_lectureRooms', 'no_users'));   
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
