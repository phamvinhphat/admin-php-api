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

export interface IRolePermissions {
    roleId: string;
    permissionId: string;
}

export interface IDocument {
    id: string;
    documentCode: string;
    data: string;
    statusName: string; // status_name
    createdBy: IUserView[];
}

export interface IPostCreate {
    longitude: number;
    latitude: number;
    contents: string;
    price: number;
    floorArea: number;
    address: string;
    furnitureStatus: string;
    documentId: string;
    albumId?: string;
}

export interface IPost extends IPostCreate {
    id: string;
    createdBy: IUserView;
    createdAt: Date;
}

export interface IUserView {
    id: string;
    username: string;
    firstName: string;
    lastName: string;
    idCard: string;
    phoneNumber: string;
    gender: IGender | string;
    dob: Date;
    avatar?: string;
}

export interface IAlbumCreate {
    name?: string;
    isHidden: boolean;
}

export interface IAlbum extends IAlbumCreate {
    id: string;
    createdBy: IUserView;
    createdAt: Date;
}

export interface IStatus {
    id: string;
    name: string;
}
