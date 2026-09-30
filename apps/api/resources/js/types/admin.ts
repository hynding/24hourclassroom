export type Paginated<T> = {
    data: T[];
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

export type AdminGenerationRow = {
    id: number;
    user: { id: number; name: string };
    title: string;
    subject: string;
    grade_level: string;
    /** A GenerationStatus value; the list of them comes from the server as `statuses`. */
    status: string;
    /** Server-computed: never derive this from `status` here. */
    live: boolean;
    list_cost_cents: number | null;
    started_at: string | null;
    finished_at: string | null;
    duration_seconds: number | null;
    has_leftovers: boolean;
    test_id: number | null;
};

export type AdminGenerationDetail = Omit<AdminGenerationRow, 'user'> & {
    user: { id: number; name: string; email: string };
    instructions: string | null;
    material_ids: number[];
    file_ids: string[] | null;
    session_id: string | null;
    error: string | null;
    agent_note: string | null;
    tool_failures: number;
    teardown_attempts: number;
    archived_at: string | null;
    created_at: string;
    test: { id: number; title: string } | null;
    owner_has_key: boolean;
};

export type GenerationFilters = {
    status: string | null;
    user: number | null;
    leftovers: boolean;
};

export type CostWindow = { cents: number; unpriced: number };

export type ContentCounts = { public: number; private: number; published_30d: number };

export type AdminRelated = { id: number; name: string; role: string };

export type AdminUserDetail = {
    user: {
        id: number;
        name: string;
        email: string;
        /** A Role value. The page never branches on it: use actionable / role_options. */
        role: string;
        email_verified_at: string | null;
        created_at: string;
        deactivated_at: string | null;
        google_linked: boolean;
        is_self: boolean;
        actionable: boolean;
        /** Roles this target may be changed to, server-built by allowlist. */
        role_options: string[];
    };
    profile: {
        bio: string | null;
        school: string | null;
        specialties: string | null;
        subjects: string[];
        grade_levels: string[];
        avatar_url: string | null;
    } | null;
    integration: { has_key: boolean; key_hint: string | null; key_verified_at: string | null; provisioned: boolean } | null;
    counts: {
        tests: Record<string, number>;
        materials: Record<string, number>;
        generations_live: number;
        generations_total: number;
        attempts_taken: number;
        attempts_received: number;
        assignments: number;
        shares_out: number;
        tokens: number;
    };
    following: { follow_id: number; user: AdminRelated }[];
    followers: { follow_id: number; user: AdminRelated }[];
    connections: { id: number; counterpart: AdminRelated; status: string; created_at: string }[];
    tests: { id: number; title: string; visibility: string; published_at: string | null; question_count: number }[];
    materials: { id: number; title: string; visibility: string; size_bytes: number; published_at: string | null }[];
    generations: AdminGenerationRow[];
    notifications: { type: string; message: string | null; created_at: string; read_at: string | null }[];
};

export type AdminMetrics = {
    people: {
        by_role: { teacher: number; student: number; admin: number };
        verified_percentage: number;
        new_7d: number;
        new_30d: number;
        unverified_7d_plus: number;
        follows: number;
        connections: number;
    };
    content: { tests: ContentCounts; materials: ContentCounts };
    generations: {
        /** Keyed by GenerationStatus value, every case present (zero-filled server-side). */
        by_status: Record<string, number>;
        live: number;
        cost_30d: CostWindow;
        cost_all: CostWindow;
        leftovers: number;
    };
    recent_users: { id: number; name: string; email: string; role: string; verified: boolean; created_at: string }[];
};
