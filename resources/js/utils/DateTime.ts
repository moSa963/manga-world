


export const getDate =  (date: Date | string | number) :string => {
    return (new Date(date)).toLocaleDateString();
}

export const getYear =  (date: Date | string | number) :number => {
    return (new Date(date)).getFullYear();
}

export const getTime =  (date: Date | string | number) :string => {
    return (new Date(date)).toLocaleTimeString();
}

export const getDateTime =  (date: Date | string | number) :string => {
    return (new Date(date)).toLocaleString();
}