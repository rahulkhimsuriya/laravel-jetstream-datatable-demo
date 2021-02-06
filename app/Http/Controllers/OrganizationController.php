<?php

namespace App\Http\Controllers;

use App\Models\Organization;
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
}
