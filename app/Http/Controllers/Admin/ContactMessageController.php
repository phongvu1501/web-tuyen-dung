<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = '%'.$request->string('keyword').'%';
                $query->where(fn ($query) => $query->where('full_name', 'like', $keyword)->orWhere('email', 'like', $keyword));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact): View
    {
        if (! $contact->read_at) {
            $contact->update(['read_at' => now()]);
        }

        return view('admin.contacts.show', compact('contact'));
    }
}
