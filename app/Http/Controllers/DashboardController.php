<?php

namespace App\Http\Controllers;

use App\Models\Phishing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Phishing::select()->paginate(5);
        return view('dashboard.table', compact('data'));
    }
    public function create()
    {
        return view('dashboard.create');
    }
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'url' => ['required', 'url', 'unique:phishing,url'],
            'disposition' => ['required'],
        ]);
      

        $model = Phishing::create(
            [
                'url' => $credentials['url'],
                'disposition' => $credentials['disposition']
            ]
        );
        $model->save();
        return redirect('/')->with('success','data added successfully');
    }
}
