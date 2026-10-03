import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Site settings', href: '/admin/site' }];

type Site = {
    name: string;
    tagline: string | null;
    registration_open: boolean;
    registration_message: string | null;
    banner_enabled: boolean;
    banner_text: string | null;
    max_materials_per_teacher: number | null;
};

type Defaults = {
    max_materials_per_teacher: number;
};

type Form = {
    name: string;
    tagline: string;
    registration_open: boolean;
    registration_message: string;
    banner_enabled: boolean;
    banner_text: string;
    max_materials_per_teacher: string;
};

export default function SiteSettings({ site, defaults }: { site: Site; defaults: Defaults }) {
    // Nullable strings seed as '' (React warns on a null value); the server turns '' back into null.
    const { data, setData, patch, processing, errors, recentlySuccessful } = useForm<Form>({
        name: site.name,
        tagline: site.tagline ?? '',
        registration_open: site.registration_open,
        registration_message: site.registration_message ?? '',
        banner_enabled: site.banner_enabled,
        banner_text: site.banner_text ?? '',
        // A number input still yields a string; blank means "use the server default".
        max_materials_per_teacher: site.max_materials_per_teacher === null ? '' : String(site.max_materials_per_teacher),
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch('/admin/site', { preserveScroll: true });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: site settings" />

            <div className="space-y-6 px-4 py-6">
                <HeadingSmall
                    title="Site settings"
                    description="The name, sign-up switch and announcement every visitor sees, and how many materials each teacher can store."
                />

                <form onSubmit={submit} className="space-y-8">
                    <section className="space-y-2">
                        <h2 className="font-medium">Identity</h2>
                        <div className="grid max-w-md gap-2">
                            <Label htmlFor="name">Site name</Label>
                            <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                            <InputError message={errors.name} />
                        </div>
                        <div className="grid max-w-md gap-2">
                            <Label htmlFor="tagline">Tagline</Label>
                            <Input id="tagline" value={data.tagline} onChange={(e) => setData('tagline', e.target.value)} />
                            <InputError message={errors.tagline} />
                        </div>
                    </section>

                    <section className="space-y-2">
                        <h2 className="font-medium">Registration</h2>
                        <div className="flex items-center gap-2">
                            <Checkbox
                                id="registration_open"
                                checked={data.registration_open}
                                onCheckedChange={(c) => setData('registration_open', c === true)}
                            />
                            <Label htmlFor="registration_open">Registration is open</Label>
                        </div>
                        <InputError message={errors.registration_open} />
                        <div className="grid max-w-md gap-2">
                            <Label htmlFor="registration_message">Closed message</Label>
                            <Input
                                id="registration_message"
                                value={data.registration_message}
                                onChange={(e) => setData('registration_message', e.target.value)}
                            />
                            <p className="text-muted-foreground text-sm">Shown on the sign-up pages only while registration is closed.</p>
                            <InputError message={errors.registration_message} />
                        </div>
                    </section>

                    <section className="space-y-2">
                        <h2 className="font-medium">Announcement</h2>
                        <div className="flex items-center gap-2">
                            <Checkbox
                                id="banner_enabled"
                                checked={data.banner_enabled}
                                onCheckedChange={(c) => setData('banner_enabled', c === true)}
                            />
                            <Label htmlFor="banner_enabled">Show the announcement</Label>
                        </div>
                        <InputError message={errors.banner_enabled} />
                        <div className="grid max-w-md gap-2">
                            <Label htmlFor="banner_text">Text</Label>
                            <Input id="banner_text" value={data.banner_text} onChange={(e) => setData('banner_text', e.target.value)} />
                            <p className="text-muted-foreground text-sm">Shown above the header on every page of the site.</p>
                            <InputError message={errors.banner_text} />
                        </div>
                    </section>

                    <section className="space-y-2">
                        <h2 className="font-medium">Materials</h2>
                        <div className="grid max-w-md gap-2">
                            <Label htmlFor="max_materials_per_teacher">Files per teacher</Label>
                            <Input
                                id="max_materials_per_teacher"
                                type="number"
                                min={1}
                                max={10000}
                                step={1}
                                inputMode="numeric"
                                placeholder={String(defaults.max_materials_per_teacher)}
                                value={data.max_materials_per_teacher}
                                onChange={(e) => setData('max_materials_per_teacher', e.target.value)}
                            />
                            <p className="text-muted-foreground text-sm">
                                The most materials one teacher can store. Leave blank to use the server default of{' '}
                                {defaults.max_materials_per_teacher}. Lowering it never removes files: a teacher already over the limit keeps them but
                                cannot upload more. The storage limit per teacher is unchanged.
                            </p>
                            <InputError message={errors.max_materials_per_teacher} />
                        </div>
                    </section>

                    <div className="flex items-center gap-4">
                        <Button type="submit" disabled={processing}>
                            Save
                        </Button>
                        {recentlySuccessful && <p className="text-muted-foreground text-sm">Saved.</p>}
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
