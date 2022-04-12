import { useQuery } from 'react-query';

import { client } from '@services';

const useGetRole = () => {
    return useQuery('getRoleById', async () => {
        const response = await client.instance.get('role');
    });
};

export default useGetRole;
