import { Permission, User } from "@/types";



export const hasPermission = (user: User | undefined | null, permission: Permission) => {
    const res = user?.permissions?.findIndex(e => e == permission);
    return user && (user.admin || (res != null && res > -1));
}