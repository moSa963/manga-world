import { Permission, User } from "@/types";



export const hasPermission = (user: User | undefined | null, permission: Permission) => {
    return user && (user.admin || (user.permissions?.findIndex(e => e == permission) || -1) != -1);
}