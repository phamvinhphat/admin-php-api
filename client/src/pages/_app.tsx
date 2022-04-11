import type { EmotionCache } from '@emotion/cache';
import { CacheProvider } from '@emotion/react';
import type { NextPage } from 'next';
import type { AppProps } from 'next/app';
import Head from 'next/head';
import { Router, useRouter } from 'next/router';
import NProgress from 'nprogress';
import { ToastContainer } from 'react-toastify';

import { isMatch, protectedRoutes } from '@configs/protectedRoutes';
import themeConfig from '@configs/themeConfig';
import {
    SettingsConsumer,
    SettingsProvider,
} from '@core/context/settingsContext';
import ThemeComponent from '@core/theme/ThemeComponent';
import { createEmotionCache } from '@core/utils/create-emotion-cache';
import UserLayout from '@layouts/UserLayout';
import LoginPage from '@pages/pages/login';
import { QueryClientProvider } from '@services';
import { getLocalToken } from '@services/utils';

import 'react-perfect-scrollbar/dist/css/styles.css';
import 'react-toastify/dist/ReactToastify.min.css';
import '../../styles/globals.css';
import { useCallback } from 'react';

// ** Extend App Props with Emotion
type ExtendedAppProps = AppProps & {
    Component: NextPage;
    emotionCache: EmotionCache;
};

const clientSideEmotionCache = createEmotionCache();

// ** Pace Loader
if (themeConfig.routingLoader) {
    Router.events.on('routeChangeStart', () => {
        NProgress.start();
    });
    Router.events.on('routeChangeError', () => {
        NProgress.done();
    });
    Router.events.on('routeChangeComplete', () => {
        NProgress.done();
    });
}

// ** Configure JSS & ClassName
const App = (props: ExtendedAppProps) => {
    const {
        Component,
        emotionCache = clientSideEmotionCache,
        pageProps,
    } = props;

    const { route } = useRouter();

    const renderLayout = useCallback(() => {
        const token = getLocalToken();
        const protect = protectedRoutes.some((item) => isMatch(route, item));
        const getLayout =
            Component.getLayout ?? ((page) => <UserLayout>{page}</UserLayout>);
        return protect && !token
            ? LoginPage.getLayout(<LoginPage />)
            : getLayout(<Component {...pageProps} />);
    }, [Component, pageProps, route]);

    return (
        <QueryClientProvider>
            <CacheProvider value={emotionCache}>
                <Head>
                    <title>{`${themeConfig.templateName} - Administrator Page`}</title>
                    <meta
                        name="description"
                        content={`${themeConfig.templateName} – Administrator Page`}
                    />
                    <meta
                        name="keywords"
                        content="Material Design, MUI, Rent, House, Find house, find place to stay"
                    />
                    <meta
                        name="viewport"
                        content="initial-scale=1, width=device-width"
                    />
                </Head>

                <SettingsProvider>
                    <SettingsConsumer>
                        {({ settings }) => {
                            return (
                                <>
                                    <ThemeComponent settings={settings}>
                                        {renderLayout()}
                                    </ThemeComponent>
                                    <ToastContainer
                                        position="top-left"
                                        containerId="toast-4rent"
                                    />
                                </>
                            );
                        }}
                    </SettingsConsumer>
                </SettingsProvider>
            </CacheProvider>
        </QueryClientProvider>
    );
};

export default App;
