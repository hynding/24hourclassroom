<?php

return [
    // storage/app/private -- `throw => false, report => false`, so a failed
    // write returns false instead of throwing. Nothing here ever goes on the
    // `public` disk: a guessable URL would survive an unpublish.
    'disk' => 'local',

    'max_file_kb' => 10240,          // 10 MB
    // Per-teacher file cap. MATERIALS_MAX_FILES_PER_TEACHER overrides it. A
    // missing, zero, negative or non-numeric value falls back to 100 rather
    // than locking every teacher out of uploading. Deploys run config:cache,
    // so a changed value takes effect on the next deploy (or config:cache).
    'max_files_per_teacher' => filter_var(
        env('MATERIALS_MAX_FILES_PER_TEACHER'),
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]],
    ) ?: 100,
    'max_bytes_per_teacher' => 262144000, // 250 MB

    'extensions' => ['pdf', 'doc', 'docx', 'odt', 'rtf', 'txt', 'md', 'png', 'jpg', 'jpeg'],

    // Validation uses BOTH `extensions:` (the client's filename) and
    // `mimetypes:` (a content sniff), so an HTML file renamed .pdf fails on
    // content and a real PDF named .exe fails on name. A zip renamed to any
    // allowlisted extension passes, because application/zip is allowlisted
    // for .docx/.odt; attachment + nosniff + the stored sniffed type keep
    // such a file inert.
    'mimetypes' => [
        'application/pdf', 'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.oasis.opendocument.text', 'application/rtf', 'text/rtf',
        'text/plain', 'image/png', 'image/jpeg', // finfo reports .md as text/plain; there is no text/markdown to list
        'application/zip', // libmagic reports .docx/.odt as zip on some hosts
    ],
];
