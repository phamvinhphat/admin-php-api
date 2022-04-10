import { createContext, useState, ReactNode } from 'react';

import themeConfig from '@configs/themeConfig';
import { Settings } from '@core/layouts/types';

export type SettingsContextValue = {
    settings: Settings;
    saveSettings: (updatedSettings: Settings) => void;
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
    // ** State
    const [settings, setSettings] = useState<Settings>({ ...initialSettings });

    const saveSettings = (updatedSettings: Settings) => {
        setSettings(updatedSettings);
    };

    return (
        <SettingsContext.Provider value={{ settings, saveSettings }}>
            {children}
        </SettingsContext.Provider>
    );
};

export const SettingsConsumer = SettingsContext.Consumer;
