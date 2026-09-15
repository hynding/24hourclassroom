import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Site theme', href: '/admin/site-theme' }];

type Option = { value: string; label: string };
type Theme = { layout: string; palette: string; typeset: string };
type Options = { layouts: Option[]; palettes: Option[]; typesets: Option[] };

const SELECT_CLASS =
    'border-input bg-background h-9 w-64 rounded-md border px-3 text-sm shadow-xs focus-visible:ring-ring/50 focus-visible:ring-[3px] outline-none';

export default function SiteTheme({ theme, options }: { theme: Theme; options: Options }) {
    const { data, setData, patch, processing, errors, recentlySuccessful } = useForm<Theme>(theme);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch('/admin/site-theme', { preserveScroll: true });
    };

    const field = (name: keyof Theme, label: string, choices: Option[]) => (
        <div className="grid gap-2">
            <Label htmlFor={name}>{label}</Label>
            <select id={name} className={SELECT_CLASS} value={data[name]} onChange={(e) => setData(name, e.target.value)}>
                {choices.map((o) => (
                    <option key={o.value} value={o.value}>
                        {o.label}
                    </option>
                ))}
            </select>
            {errors[name] && <p className="text-destructive text-sm">{errors[name]}</p>}
        </div>
    );

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin: site theme" />

            <div className="space-y-6 px-4 py-6">
                <HeadingSmall title="Site theme" description="The layout, palette and typeset every visitor sees on the public site." />

                <form onSubmit={submit} className="space-y-6">
                    {field('layout', 'Layout', options.layouts)}
                    {field('palette', 'Palette', options.palettes)}
                    {field('typeset', 'Typeset', options.typesets)}

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
