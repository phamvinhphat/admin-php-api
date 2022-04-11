import { useMutation } from 'react-query';

import { client } from '@services';
import { IRolePermissions, IResponse } from '@services/types';

interface Props {
    roleId: string;
}
const useGetGrantedPermissionOfRole = () => {
    return useMutation<
        IResponse<IRolePermissions[]>,
        IResponse<undefined>,
        Props
    >(async (variables) => {
        const response = await client.instance.get(
            '/rolePermission/findGrantPermission',
            { params: variables }
        );
        if (response.status === 200) {
            return response.data;
        }
        return response;
    });
};

export default useGetGrantedPermissionOfRole;
