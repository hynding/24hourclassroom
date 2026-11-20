import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';

type RegisterForm = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
    role: string;
    birth_month: string;
    birth_year: string;
};

// Mirrors Role::screensAge(): sign-up asks birth month and year (checked, never stored).
const AGE_SCREEN_ROLES = ['student', 'assistant'];
const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

export default function Register({ registration }: { registration: { open: boolean; message: string | null } }) {
    const { data, setData, post, processing, errors, reset } = useForm<Required<RegisterForm>>({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 'teacher',
        birth_month: '',
        birth_year: '',
    });
    const screensAge = AGE_SCREEN_ROLES.includes(data.role);
    const thisYear = new Date().getFullYear();

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <AuthLayout
            title={registration.open ? 'Create an account' : 'Registration is closed'}
            description={registration.open ? 'Enter your details below to create your account' : (registration.message ?? 'Registration is closed.')}
        >
            <Head title="Register" />
            {registration.open ? (
                <form className="flex flex-col gap-6" onSubmit={submit}>
                    <div className="grid gap-6">
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autoFocus
                                tabIndex={1}
                                autoComplete="name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                disabled={processing}
                                placeholder="Full name"
                            />
                            <InputError message={errors.name} className="mt-2" />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="role">I am a</Label>
                            <select
                                id="role"
                                required
                                value={data.role}
                                onChange={(e) => setData('role', e.target.value)}
                                disabled={processing}
                                className="border-input h-9 rounded-md border bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                                <option value="tutor">Tutor</option>
                                <option value="assistant">Teacher assistant</option>
                                <option value="guardian">Parent or guardian</option>
                            </select>
                            <InputError message={errors.role} />
                        </div>

                        {screensAge && (
                            <fieldset className="grid gap-2">
                                <legend className="text-sm font-medium">When were you born?</legend>
                                <p className="text-muted-foreground text-sm">We check this once to set up your account and do not keep it.</p>
                                <div className="flex gap-2">
                                    <select
                                        aria-label="Birth month"
                                        required
                                        value={data.birth_month}
                                        onChange={(e) => setData('birth_month', e.target.value)}
                                        disabled={processing}
                                        className="border-input h-9 rounded-md border bg-transparent px-3 py-1 text-sm shadow-xs"
                                    >
                                        <option value="">Month</option>
                                        {MONTHS.map((m, i) => (
                                            <option key={m} value={String(i + 1)}>
                                                {m}
                                            </option>
                                        ))}
                                    </select>
                                    <select
                                        aria-label="Birth year"
                                        required
                                        value={data.birth_year}
                                        onChange={(e) => setData('birth_year', e.target.value)}
                                        disabled={processing}
                                        className="border-input h-9 rounded-md border bg-transparent px-3 py-1 text-sm shadow-xs"
                                    >
                                        <option value="">Year</option>
                                        {Array.from({ length: 100 }, (_, i) => thisYear - i).map((y) => (
                                            <option key={y} value={String(y)}>
                                                {y}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                <InputError message={errors.birth_year} />
                            </fieldset>
                        )}

                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                tabIndex={2}
                                autoComplete="email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                disabled={processing}
                                placeholder="email@example.com"
                            />
                            <InputError message={errors.email} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                required
                                tabIndex={3}
                                autoComplete="new-password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                disabled={processing}
                                placeholder="Password"
                            />
                            <InputError message={errors.password} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                required
                                tabIndex={4}
                                autoComplete="new-password"
                                value={data.password_confirmation}
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                                disabled={processing}
                                placeholder="Confirm password"
                            />
                            <InputError message={errors.password_confirmation} />
                        </div>

                        <Button type="submit" className="mt-2 w-full" tabIndex={5} disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Create account
                        </Button>
                    </div>

                    <div className="text-muted-foreground text-center text-sm">
                        Already have an account?{' '}
                        <TextLink href={route('login')} tabIndex={6}>
                            Log in
                        </TextLink>
                    </div>
                </form>
            ) : null}
        </AuthLayout>
    );
}
