# PHP/Laravel Conventions

## Controllers

- Use single-action invokable controllers with `__invoke()` method
- Name controllers by action: `ListContactsController`, `CreateContactController`, `UpdateContactController`, `DeleteContactController`

## Data Access

- Use Eloquent directly in controllers
- Do NOT use repository classes for new code
- Always pass only `$request->validated()` or `$request->safe()` to Eloquent `update()`/`create()` methods

## Current User

- Use `$request->user()` (not `Auth::user()` or helpers)

## Type Hints

- Always add return types and parameter types to PHP methods

## Control Flow

- Always add a line break after control statements:
  ```php
  // Good
  if (! $value) {
      return;
  }

  doSomething();

  // Bad
  if (! $value) {
      return;
  }
  doSomething();
  ```

## Response Conventions

- Return 204 via `response()->noContent()` when nothing useful to return (e.g., password change, delete)

## Enums

- Use native PHP 8.1+ enums:
  ```php
  enum Status: string
  {
      case Draft = 'draft';
      case Published = 'published';

      public function label(): string
      {
          return match ($this) {
              self::Draft => 'Draft',
              self::Published => 'Published',
          };
      }
  }
  ```
- Validate enums with `Rule::enum(Status::class)`

## Validation Rules

- Use `Rule::exists()->where()` for scoped validation:
  ```php
  Rule::exists('projects', 'id')->where('team_id', $this->user()->team_id)
  ```
- Use `Rule::notIn()` instead of string concatenation
- For flat array requests, use `*.field` validation (e.g., `'*.title' => 'required'`)
- Use `$request->safe()->collect()` to get validated array data as collection

## Form Request Patterns

- Use short closure syntax with return type for `once()` calls:
  ```php
  public function forProject(): Project
  {
      return once(fn (): Project => Project::whereTeam($this->user()->team_id)
          ->findOrFail($this->route('id')));
  }
  ```

## Route Files

- Use full namespace imports for controllers (enables IDE navigation):
  ```php
  use App\Http\Controllers\Example\MyController;
  Route::post('/', MyController::class);
  ```

## Database Conventions

- **No foreign key constraints**: Do not use `->constrained()`, `->cascadeOnDelete()`, or similar. Handle referential integrity in application code.
- **No default values**: Do not use `->default()` in migrations. Set defaults in application code (models, factories, etc.).
- **ULIDs for primary keys**: Use `$table->ulid('id')->primary()` instead of `$table->id()`.

## Model Conventions

- **PHPDoc for properties**: Add `@property` annotations to models for all database columns.
- **Generic types for relations**: Use `@return HasMany<User, $this>` style annotations on relationship methods.
- **Final classes**: All classes should be `final` unless designed for extension.
