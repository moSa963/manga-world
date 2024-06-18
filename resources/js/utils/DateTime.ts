


export const getDate = (date: Date | string | number): string => {
    return (new Date(date)).toLocaleDateString();
}

export const getYear = (date: Date | string | number): number => {
    return (new Date(date)).getFullYear();
}

export const getTime = (date: Date | string | number): string => {
    return (new Date(date)).toLocaleTimeString();
}

export const getDateTime = (date: Date | string | number): string => {
    return (new Date(date)).toLocaleString();
}

export const getPeriod = (date: Date | string | number): string => {
    const intervals = [
        { label: "year", seconds: 31536000 },
        { label: "month", seconds: 2592000 },
        { label: "day", seconds: 86400 },
        { label: "hour", seconds: 3600 },
        { label: "minute", seconds: 60 },
        { label: "second", seconds: 1 },
    ];

    let val = Math.floor((Date.now() - new Date(date).getTime()) / 1000);

    for (const { label, seconds } of intervals) {
        const count = Math.floor(val / seconds);
        if (count >= 1) {
            return `${count} ${label}${count > 1 ? 's' : ''}`;
        }
    }

    return "0 seconds";
}