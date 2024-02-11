export interface User {
    id: number;
    name: string;
    username: string;
    email: string;
    email_verified_at: string;
}

export interface ScreenInfo {
    size: "sm" | "md" | "lg",
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
