<?php

namespace App\Enums;

/**
 * What a url_slugs row names. Mirrored as SLUG_KINDS in @24hc/shared.
 *
 * - teacher: a handle, /teachers/<handle>. Admin-approved.
 * - teacher_course: /teachers/<handle>/<slug>, scoped to its teacher.
 *   Approved automatically once the teacher's handle is (the owner's call,
 *   2026-11-13): the namespace under an approved handle is the teacher's.
 * - site_course: /courses/<slug>, the scarce site-wide namespace. Set by
 *   an admin only.
 */
enum SlugKind: string
{
    case Teacher = 'teacher';
    case TeacherCourse = 'teacher_course';
    case SiteCourse = 'site_course';
}
