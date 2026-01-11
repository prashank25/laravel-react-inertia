<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class TeamCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_belongs_to_team(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Team::class, $user->team);
    }

    public function test_user_can_be_marked_as_owner(): void
    {
        $user = User::factory()->withTeam()->create();

        $this->assertTrue($user->isOwner());
    }

    public function test_team_has_members(): void
    {
        $user = User::factory()->create();

        $this->assertTrue($user->team->members->contains($user));
    }

    public function test_team_has_owner_relationship(): void
    {
        $user = User::factory()->withTeam()->create();

        $this->assertEquals($user->id, $user->team->owner->id);
    }

    public function test_team_slug_is_auto_generated(): void
    {
        $team = Team::create(['name' => 'My Awesome Team']);

        $this->assertEquals('my-awesome-team', $team->slug);
    }

    public function test_team_slug_is_unique(): void
    {
        Team::create(['name' => 'Test Team', 'slug' => 'test-team']);
        $team2 = Team::create(['name' => 'Test Team']);

        $this->assertEquals('test-team-1', $team2->slug);
    }
}
