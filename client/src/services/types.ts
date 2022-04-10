export interface IResponse<T> {
    message?: string;
    result: T;
    success: boolean;
}
