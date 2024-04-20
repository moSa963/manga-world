
function getCookie(cookie: string) {
    let name = cookie + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');

    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }

    return "";
}

const getHeaders = () => {
    const headers = {
        'Accept': "application/json",
        'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
    };
    return headers;
}

const apiRequest = async (url: string, method = "GET", data = null) => {
    var body = <RequestInit>{
        headers: getHeaders(),
        method: method,
        body: data,
    };

    if (data && method !== 'GET' && typeof (data) === "object") {
        var form = new FormData();

        Object.keys(data).forEach(key => {
            if (Array.isArray(data[key])) {
                (data[key] as Array<string>).forEach((e) => {
                    form.append(key + "[]", e);
                });
            } else {
                form.append(key, data[key]);
            }
        });
        
        body["body"] = form;
    }

    return await fetch(url, body);
}


export default apiRequest;