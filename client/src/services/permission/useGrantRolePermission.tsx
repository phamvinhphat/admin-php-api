import { useMutation } from 'react-query';

import { client } from '@services';
import { IResponse, IRolePermissions } from '@services/types';

const useGrantRolePermission = () => {
    return useMutation<
        IResponse<boolean>,
        IResponse<undefined>,
        IRolePermissions
    >(async (variables) => {
        const response = await client.instance.post(
            '/rolePermission/createGrantPermission',
            variables
        );
        if (response.status === 201) {
            return response.data;
        }
        return response;
    });
};

export default useGrantRolePermission;
