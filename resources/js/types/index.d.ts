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
    id: number,
    user: User,
    title: string,
    description: string,
    painter: string,
    author: string,
    status: string,
    otherNames: string,
    type: string,
    releaseYear: string,
    chaptersCount: string,
    latestChapters: Array<Chapter>,
}

export interface Chapter {
    series: string,
    title: string,
    number: number,
    published: boolean,
    releaseYear: string,
    pages: Array<Page>,
}

export interface Page {
    number: number,
}