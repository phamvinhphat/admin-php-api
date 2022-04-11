export interface IResponse<T> {
    message?: string;
    result: T;
}

export interface ILogin {
    email: string;
    password: string;
}

export interface IToken {
    accessToken: string;
    expiresIn: number;
}

export type IGender = 'male' | 'female' | 'other';

export interface IUser extends IChangeUserInfo {
    id: string;
    avatar?: string;
    isVerify: boolean;
    savedPosts?: string | string[];
    recentlyViewedPosts: string | string[];
    email: string;
    isAdmin: boolean;
    roleId: string;
    username: string;
}

export interface IRole {
    id: string;
    name: string;
}

export interface IPermission {
    id: string;
    name: string;
}

export interface IChangeUserInfo {
    firstName: string;
    lastName: string;
    idCard: string;
    phoneNumber: string;
    gender: IGender | string;
    dob: Date;
}
