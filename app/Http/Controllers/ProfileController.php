<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $view = "app.profile";
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view("{$this->view}.edit", [
            'user' => $request->user(),
            "title" => "Profile"
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $id = $request->user()->id;
        $requestRule = new ProfileUpdateRequest();
        $validator = Validator::make($request->all(), $requestRule->rules($id), [], $requestRule->attributes());
        DB::beginTransaction();
        try {
            $attributes = $validator->validated();
            $request->user()->fill($attributes);
            $request->user()->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return responseFail($e->getMessage());
        }

        DB::commit();
        return responseSuccess(BERHASIL_SIMPAN);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
