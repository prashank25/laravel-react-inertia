# Testing Conventions

## PHP Tests

Located in `tests/Unit/` and `tests/Feature/`, uses PHPUnit with Laravel testing utilities.

## PHPUnit Test Structure

```php
#[\PHPUnit\Framework\Attributes\Test]
public function can_create_a_project()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/projects', [
        'name' => 'My Project',
    ]);

    $response->assertStatus(200);
    $response->assertJson(['data' => ['name' => 'My Project']]);
}
```

- Use `#[\PHPUnit\Framework\Attributes\Test]` attribute
- Structure: Setup → Act → Assert with single blank line between sections
- No blank lines within each section
- **Verbose test names** that explain intention: `user_cannot_create_project_without_name` not `invalid_project`
- **Required fields:** Consolidate into one test, don't test each field separately
- **assertEquals order:** Expected value first, actual value second: `$this->assertEquals($expected, $actual)`

## Test File Organization

- Test files map 1:1 with controllers: `app/Http/Controllers/ListProjectsController.php` → `tests/Feature/Projects/ListProjectsTest.php`
- When creating a new feature, write tests first before implementing

## Team Isolation Tests

- Create a user and attempt to access another team's resources
- Should return 404 (not revealing resource exists)

## User Isolation Tests

- For user-specific resources, test that User A cannot modify User B's entities (even on same team)
- Should return 403 for in-team permission failures
