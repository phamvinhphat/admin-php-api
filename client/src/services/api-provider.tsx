import React from 'react';

import {
    MutationCache,
    QueryCache,
    QueryClient,
    QueryClientProvider,
} from 'react-query';
import { toast } from 'react-toastify';

import { IResponse } from './types';

const client = new QueryClient({
    queryCache: new QueryCache({
        onError: (error) => {
            const { message } = error as IResponse<undefined>;
            toast(message, { position: 'top-left' });
        },
    }),
    mutationCache: new MutationCache({
        onError: (error) => {
            const { message } = error as IResponse<undefined>;
            toast(message, { position: 'top-left' });
        },
    }),
    defaultOptions: {
        queries: {
            refetchOnWindowFocus: false,
            refetchOnMount: false,
            refetchOnReconnect: false,
            retry: false,
            staleTime: 5 * 60 * 1000,
        },
    },
});

const ApiProvider: React.FC = ({ children }) => {
    return (
        <QueryClientProvider client={client}>{children}</QueryClientProvider>
    );
};

export default ApiProvider;
