import { useQuery } from 'react-query';

import { client } from '@services';
import { IResponse, IStatus } from '@services/types';

const useGetStatus = () => {
    return useQuery<IResponse<IStatus[]>, IResponse<undefined>>(
        'getAllStatus',
        async () => {
            const response = await client.instance.get('/status/getAllStatus');
            if (response.status === 200) {
                return response.data;
            }
            return response;
        }
    );
};

export default useGetStatus;
