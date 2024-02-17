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

export interface Series {
    title: string,
    description: string,
    painter: string,
    author: string,
    status: string,
    otherNames: string,
    type: string,
    releaseYear: string,
    chaptersCount: string,
    image: string,
}