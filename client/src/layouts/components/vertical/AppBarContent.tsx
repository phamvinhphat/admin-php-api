import {
    IconButton,
    InputAdornment,
    TextField,
    useMediaQuery,
} from '@mui/material';
import Box from '@mui/material/Box';
import { Theme } from '@mui/material/styles';
import { Magnify, Menu } from 'mdi-material-ui';

import ModeToggler from '@core/layouts/components/shared-components/ModeToggler';
import NotificationDropdown from '@core/layouts/components/shared-components/NotificationDropdown';
import UserDropdown from '@core/layouts/components/shared-components/UserDropdown';
import { Settings } from '@core/layouts/types';

interface Props {
    hidden: boolean;
    settings: Settings;
    toggleNavVisibility: () => void;
    saveSettings: (values: Settings) => void;
}

const AppBarContent = (props: Props) => {
    // ** Props
    const { hidden, settings, saveSettings, toggleNavVisibility } = props;

    // ** Hook
    const hiddenSm = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('sm')
    );

    return (
        <Box
            sx={{
                width: '100%',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'space-between',
            }}
        >
            <Box
                className="actions-left"
                sx={{ mr: 2, display: 'flex', alignItems: 'center' }}
            >
                {hidden ? (
                    <IconButton
                        color="inherit"
                        onClick={toggleNavVisibility}
                        sx={{ ml: -2.75, ...(hiddenSm ? {} : { mr: 3.5 }) }}
                    >
                        <Menu />
                    </IconButton>
                ) : null}
                <TextField
                    size="small"
                    sx={{ '& .MuiOutlinedInput-root': { borderRadius: 4 } }}
                    InputProps={{
                        startAdornment: (
                            <InputAdornment position="start">
                                <Magnify fontSize="small" />
                            </InputAdornment>
                        ),
                    }}
                />
            </Box>
            <Box
                className="actions-right"
                sx={{ display: 'flex', alignItems: 'center' }}
            >
                <ModeToggler settings={settings} saveSettings={saveSettings} />
                <NotificationDropdown />
                <UserDropdown />
            </Box>
        </Box>
    );
};

export default AppBarContent;
