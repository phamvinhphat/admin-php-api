import { useQuery } from 'react-query';

import { client } from '@services';
import { IDocument, IResponse } from '@services/types';

const useGetPostDocument = () => {
    return useQuery<IDocument[], IResponse<undefined>>(
        'getDocumentPost',
        async () => {
            const response = await client.instance.get(
                '/document/getAllDocumentAndStatus'
            );
            if (response.status === 200) {
                return response.data;
            }
            return response;
        },
        { refetchOnWindowFocus: true, refetchOnMount: true }
    );
};

export default useGetPostDocument;
