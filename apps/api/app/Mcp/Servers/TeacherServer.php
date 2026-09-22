<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('24 Hour Classroom')]
#[Version('1.0.0')]
#[Instructions(<<<'MARKDOWN'
You are connected to one teacher's account on 24 Hour Classroom.

Read their materials with list_materials and get_material. Read the exact
question shapes this app accepts with list_taxonomies before writing any
question. Write with create_test_draft, which creates a PRIVATE test the
teacher then edits in the app -- it never publishes anything and never
changes an existing test.

Everything you can see or write belongs to this one teacher. Subjects,
grade levels and question types are closed lists: use the values from
list_taxonomies verbatim.
MARKDOWN)]
class TeacherServer extends Server
{
    /**
     * Tools are added by the tasks that introduce them; the Pest harness
     * (TeacherServer::tool(...)) also resolves a tool through this list, so
     * a tool missing here is "Tool [x] not found." rather than a pass.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [];
}
