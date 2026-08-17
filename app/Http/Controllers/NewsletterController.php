<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(10);

        return view('backend.newsletters.index', compact('newsletters'));
    }

    public function show($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('backend.newsletters.show', compact('newsletter'));
    }

    public function destroy($id)
    {
        Newsletter::findOrFail($id)->delete();

        return back()->with('success', 'Subscriber deleted successfully');
    }
}