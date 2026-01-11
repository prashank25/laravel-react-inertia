<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Laravel\WorkOS\User as WorkOSUser;

final class AuthenticateController extends Controller
{
    public function __invoke(AuthKitAuthenticationRequest $request): RedirectResponse
    {
        $request->authenticate(
            createUsing: function (WorkOSUser $workosUser): User {
                $team = Team::query()->create([
                    'name' => ($workosUser->firstName ?? 'New')."'s Team",
                ]);

                return User::query()->create([
                    'team_id' => $team->id,
                    'owner' => true,
                    'name' => mb_trim(($workosUser->firstName ?? '').' '.($workosUser->lastName ?? '')),
                    'email' => $workosUser->email,
                    'workos_id' => $workosUser->id,
                    'avatar' => $workosUser->avatar ?? '',
                    'email_verified_at' => now(),
                ]);
            }
        );

        return redirect()->intended(route('dashboard'));
    }
}
