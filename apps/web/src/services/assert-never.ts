/**
 * The `default` arm of an exhaustive switch. Passing anything but `never`
 * is a compile error, so adding a `QuestionType` case upstream fails the
 * build at every switch that forgot it -- instead of rendering nothing.
 */
export function assertNever(value: never, what = 'value'): never {
  throw new Error(`Unhandled ${what}: ${String(value)}`);
}
