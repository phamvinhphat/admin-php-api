import { useMutation } from 'react-query';

import { client } from '@services';
import { IResponse, IRolePermissions } from '@services/types';

const useRemoveRolePermission = () => {
    return useMutation<
        IResponse<number>,
        IResponse<undefined>,
        IRolePermissions
    >(async (variables) => {
        const response = await client.instance.delete(
            '/rolePermission/deleteGrantPermission',
            { params: variables }
        );
        if (response.status === 200) {
            return response.data;
        }
        return response;
    });
};

export default useRemoveRolePermission;
