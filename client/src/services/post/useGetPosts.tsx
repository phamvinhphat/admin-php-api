import { useQuery } from 'react-query';

import { client } from '@services';

const useGetPosts = () => {
    return useQuery('getPosts', async () => {
        const response = await client.instance.get('');
        if (response.status === 200) {
            const { data } = response.data;
        }
    });
};

export default useGetPosts;
