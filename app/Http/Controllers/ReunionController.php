<?php

namespace App\Http\Controllers;

use App\Models\Reunion;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReunionController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     *
     * @throws AuthorizationException
     */
    public function index() {
        $this->authorize("viewAny", Reunion::class);
        return Inertia::render("Reunions/Index", [
            "reunions" => Reunion::withTrashed()->paginate(10)
        ]);
    }

    /**
     * @return string
     * @throws AuthorizationException
     */
    public function create() {
        $this->authorize('create', Reunion::class);
        return "Can Create";
    }

    /**
     * @param Reunion $reunion
     * @return string
     * @throws AuthorizationException
     */
    public function show(Reunion $reunion) {
        $this->authorize('view', $reunion);
        return "Can Show";
    }

    /**
     * @param Reunion $reunion
     * @return string
     * @throws AuthorizationException
     */
    public function edit(Reunion $reunion) {
        $this->authorize('update', $reunion);
        return "Can Edit";
    }

    /**
     * @param Request $request
     * @param Reunion $reunion
     * @return string
     * @throws AuthorizationException
     */
    public function update(Request $request, Reunion $reunion) {
        $this->authorize('update', $reunion);
        return "Can Update";
    }

    /**
     * @param Reunion $reunion
     * @return string
     * @throws AuthorizationException
     */
    public function destroy(Reunion $reunion) {
        $this->authorize('delete', $reunion);
        return "Can Delete";
    }

    /**
     * @param int $id
     * @return string
     * @throws AuthorizationException
     */
    public function restore(int $id) {
        $reunion = Reunion::withTrashed()->find($id);
        $this->authorize('restore', $reunion);
        return "Can Restore";
    }
}
