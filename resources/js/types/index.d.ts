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
    status: 'ongoing' | 'stopped' | 'finished',
    otherNames: string,
    type: string,
    release_date: string,
    chaptersCount: string,
    latestChapters: Array<Chapter>,
}

export interface Chapter {
    series: string,
    title: string,
    number: number,
    published: boolean,
    releaseDate: string,
    pages: Array<Page>,
}

export interface Page {
    number: number,
}


export interface Response<T> {
    data: Array<T>,
    links: {
        first: string | null,
        last: string | null,
        next: string | null,
        prev: string | null,
    },
    meta: {
        current_page: number,
        from: number,
        path: string,
        per_page: number,
        to: number,
    },
}