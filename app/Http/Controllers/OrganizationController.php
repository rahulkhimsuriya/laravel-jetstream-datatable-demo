<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::filterBy(request()->only('search'))
            ->when(
                request()->filled(['sortField', 'sortOrder']),
                function ($query) {
                    return $query->orderBy(request('sortField'), request('sortOrder'));
                },
                function ($query) {
                    return $query->orderByDesc('updated_at');
                },
            )
            ->paginate(10);

        return Inertia::render('Organization/Index', [
            'filters' => request()->only(['search', 'sortField', 'sortOrder']),
            'organizations' => $organizations
        ]);
    }

    public function create()
    {
        return Inertia::render('Organization/Create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:organizations'],
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => ['required', 'in:CA,US'],
            'postal_code' => 'required',
        ]);

        Auth::user()->account->organizations()->create($validatedData);

        return redirect()->route('organizations.index')->with('success', 'Organization created.');
    }

    public function edit(Organization $organization)
    {
        return Inertia::render('Organization/Edit', [
            'organization' => $organization
        ]);
    }

    public function update(Organization $organization)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:organizations,id,' . $organization->id],
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => ['required', 'in:CA,US'],
            'postal_code' => 'required',
        ]);

        $organization->update($validatedData);

        return redirect()->route('organizations.index')->with('success', 'Organization updated.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted.');
    }
}
