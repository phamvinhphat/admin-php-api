import { createContext, useState, ReactNode, useLayoutEffect } from 'react';

import themeConfig from '@configs/themeConfig';
import { Settings } from '@core/layouts/types';
import { useCurrentUser } from '@services';
import { IUser } from '@services/types';
import { getLocalToken } from '@services/utils';

export type SettingsContextValue = {
    settings: Settings;
    saveSettings: (updatedSettings: Settings) => void;
    isAuthenticated?: boolean;
    userInfo?: IUser;
};

const initialSettings: Settings = {
    themeColor: 'primary',
    mode: themeConfig.mode,
    contentWidth: themeConfig.contentWidth,
};

// ** Create Context
export const SettingsContext = createContext<SettingsContextValue>({
    saveSettings: () => null,
    settings: initialSettings,
});

export const SettingsProvider = ({ children }: { children: ReactNode }) => {
    const [settings, setSettings] = useState<Settings>({ ...initialSettings });
    const [isAuthenticated, setAuthenticated] = useState<boolean>(false);

    const { data } = useCurrentUser();

    const saveSettings = (updatedSettings: Settings) => {
        setSettings(updatedSettings);
    };

    useLayoutEffect(() => {
        const localToken = getLocalToken()?.Authorization;
        setAuthenticated(localToken !== undefined);
    }, []);

    return (
        <SettingsContext.Provider
            value={{
                settings,
                saveSettings,
                isAuthenticated,
                userInfo: data?.result,
            }}
        >
            {children}
        </SettingsContext.Provider>
    );
};

export const SettingsConsumer = SettingsContext.Consumer;
