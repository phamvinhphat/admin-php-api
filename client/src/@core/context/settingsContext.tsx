import { createContext, useState, ReactNode, useCallback } from 'react';

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

    const { data } = useCurrentUser();

    const saveSettings = (updatedSettings: Settings) => {
        setSettings(updatedSettings);
    };

    const hasToken = useCallback(() => Boolean(getLocalToken()), []);

    return (
        <SettingsContext.Provider
            value={{
                settings,
                saveSettings,
                isAuthenticated: hasToken(),
                userInfo: data?.result,
            }}
        >
            {children}
        </SettingsContext.Provider>
    );
};

export const SettingsConsumer = SettingsContext.Consumer;
