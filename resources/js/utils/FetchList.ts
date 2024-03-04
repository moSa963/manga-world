import { Response } from "@/types";
import { Ref } from "vue";


const fetchList = async <T>(obj: Ref<Response<T> | null | undefined>, url: string | null, progress?: Ref<boolean>) => {
    if (!url || progress?.value) return;
    progress && (progress.value = true);

    const res = await fetch(url);

    if (!res.ok) return;

    const js = await res.json();

    progress && (progress.value = false);

    if (obj.value == null) {
        obj.value = js;
        return;
    }

    obj.value = {
        ...js,
        data: [
            ...obj.value.data,
            ...js.data,
        ]
    }
}


export default fetchList;