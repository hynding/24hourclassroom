{{-- Plain text, never HTML: this string is the session's first user message.
     {!! !!} for the same reason as system.blade.php. --}}
Draft a test from the materials mounted in this session.

Subject: {!! $subject !!}
Grade level: {!! $gradeLevel !!}
Questions requested: {{ $questionCount }}
@if (filled($instructions))

The teacher's instructions
--------------------------
{!! $instructions !!}
@endif

Mounted materials
-----------------
@foreach ($paths as $path)
- {!! $path !!}
@endforeach

Read every mounted file before you draft. Research with web search where the materials are thin.
Then call save_test_draft exactly once with the complete test body.
