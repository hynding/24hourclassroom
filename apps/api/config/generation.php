<?php

return [
    'model' => 'claude-opus-5',
    'effort' => 'high',
    'budget_cents' => 200,
    'max_materials' => 5,
    'min_questions' => 5,
    'max_questions' => 30,
    'max_tool_failures' => 3,
    'max_run_minutes' => 30,           // wall-clock cap; idle sessions bill running time against the budget
    'environment_name' => '24hc-generate',
    'agent_name' => '24hc test generator',
    'mount_dir' => '/workspace/materials',
];
