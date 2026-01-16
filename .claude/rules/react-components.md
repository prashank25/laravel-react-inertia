# React Component Conventions

## Path Aliases

TypeScript uses `@/*` to alias `resources/js/*` (configured in tsconfig.json and components.json).

## Component Rules

- Use functional components with hooks
- Use TypeScript for all components
- Style with Tailwind CSS utilities
- **Variable naming:** Use descriptive names, never single-letter variables (e.g., `statuses.map(status => ...)` not `statuses.map(s => ...)`)
- **Control flow:** Always use curly braces for if statements, even single-line returns. Always add a line break after control statements:
  ```typescript
  // Good
  if (!value) {
    return;
  }

  doSomething();

  // Bad
  if (!value) return;
  if (!value) {
    return;
  }
  doSomething();
  ```
- **Line breaks before return:** Always add a line break before `return` unless it's the only statement (early return):
  ```typescript
  // Good
  function calculate(x: number) {
    const result = x * 2;

    return result;
  }

  // Good - early return, no line break needed
  function validate(x: number) {
    if (!x) {
      return null;
    }

    const result = process(x);

    return result;
  }

  // Bad - no line break before return
  function calculate(x: number) {
    const result = x * 2;
    return result;
  }
  ```
- **Organize by logical concern:** Group related state, effects, and functions together by feature - not scattered by type
