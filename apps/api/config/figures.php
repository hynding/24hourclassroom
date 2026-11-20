<?php

/*
 * Question pictures (App\Services\FigureWriter). Uploads are PNG or JPEG
 * only; SVG comes from the course seed data alone, checked by
 * App\Support\SafeSvg, and is only ever shown through an <img>, where a
 * browser runs no script.
 */
return [
    'disk' => 'local',
    'max_file_kb' => 2048,
    'max_per_teacher' => 2000,
    'upload_mimetypes' => ['image/png', 'image/jpeg'],
    'upload_extensions' => ['png', 'jpg', 'jpeg'],
    // A signed image link lasts until the end of the NEXT window, so every
    // payload built inside one window carries the same URL and the browser
    // can cache the picture.
    'link_window_hours' => 6,
];
