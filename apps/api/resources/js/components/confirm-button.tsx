import { Button, buttonVariants } from '@/components/ui/button';
import { router } from '@inertiajs/react';
import { type VariantProps } from 'class-variance-authority';

type Props = {
    label: string;
    /** The confirm() question. The button does nothing when it is declined. */
    confirm: string;
    method: 'post' | 'patch' | 'delete';
    url: string;
    data?: Record<string, string | number | boolean>;
    disabled?: boolean;
    variant?: VariantProps<typeof buttonVariants>['variant'];
    size?: VariantProps<typeof buttonVariants>['size'];
    preserveScroll?: boolean;
};

/**
 * The one confirm-then-visit pattern the admin pages share. `router.visit`
 * takes method and data uniformly, so there is no branching on
 * router.delete(url, options) vs router.post(url, data, options).
 */
export function ConfirmButton({ label, confirm: question, method, url, data, disabled, variant = 'outline', size, preserveScroll = true }: Props) {
    const onClick = () => {
        if (confirm(question)) {
            router.visit(url, { method, data, preserveScroll });
        }
    };

    return (
        <Button type="button" variant={variant} size={size} disabled={disabled} onClick={onClick}>
            {label}
        </Button>
    );
}
