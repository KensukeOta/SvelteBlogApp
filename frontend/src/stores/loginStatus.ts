import { persistentWritable } from "./persistantStore";

export const isLogin = persistentWritable("loginStatus", false);