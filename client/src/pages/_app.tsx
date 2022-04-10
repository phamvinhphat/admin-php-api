import type { EmotionCache } from '@emotion/cache';
import { CacheProvider } from '@emotion/react';
import type { NextPage } from 'next';
import type { AppProps } from 'next/app';
import Head from 'next/head';
import { Router } from 'next/router';
import NProgress from 'nprogress';
import { ToastContainer } from 'react-toastify';

import ThemeComponent from '@core/theme/ThemeComponent';
import { createEmotionCache } from '@core/utils/create-emotion-cache';
import { QueryClientProvider } from '@services';
import {
    SettingsConsumer,
    SettingsProvider,
} from 'src/@core/context/settingsContext';
import themeConfig from 'src/configs/themeConfig';
import UserLayout from 'src/layouts/UserLayout';

import 'react-perfect-scrollbar/dist/css/styles.css';
import 'react-toastify/dist/ReactToastify.min.css';
import '../../styles/globals.css';

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

    // Variables
    const getLayout =
        Component.getLayout ?? ((page) => <UserLayout>{page}</UserLayout>);

    return (
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
                            <QueryClientProvider>
                                <ThemeComponent settings={settings}>
                                    {getLayout(<Component {...pageProps} />)}
                                </ThemeComponent>
                                <ToastContainer
                                    position="top-left"
                                    containerId="toast-4rent"
                                />
                            </QueryClientProvider>
                        );
                    }}
                </SettingsConsumer>
            </SettingsProvider>
        </CacheProvider>
    );
};

export default App;
