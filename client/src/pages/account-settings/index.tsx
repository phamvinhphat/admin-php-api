import { SyntheticEvent, useState } from 'react';

import TabContext from '@mui/lab/TabContext';
import TabList from '@mui/lab/TabList';
import TabPanel from '@mui/lab/TabPanel';
import Box from '@mui/material/Box';
import Card from '@mui/material/Card';
import { styled } from '@mui/material/styles';
import MuiTab, { TabProps } from '@mui/material/Tab';
import AccountOutline from 'mdi-material-ui/AccountOutline';
import InformationOutline from 'mdi-material-ui/InformationOutline';
import LockOpenOutline from 'mdi-material-ui/LockOpenOutline';

import 'react-datepicker/dist/react-datepicker.css';
import { TabInfo, TabSecurity, TabAccount } from '@views';

const Tab = styled(MuiTab)<TabProps>(({ theme }) => ({
    [theme.breakpoints.down('md')]: {
        minWidth: 100,
    },
    [theme.breakpoints.down('sm')]: {
        minWidth: 67,
    },
}));

const TabName = styled('span')(({ theme }) => ({
    lineHeight: 1.71,
    fontSize: '0.875rem',
    marginLeft: theme.spacing(2.4),
    [theme.breakpoints.down('md')]: {
        display: 'none',
    },
}));

const AccountSettings = () => {
    // ** State
    const [value, setValue] = useState<string>('account');

    const handleChange = (event: SyntheticEvent, newValue: string) => {
        setValue(newValue);
    };

    return (
        <Card>
            <TabContext value={value}>
                <TabList
                    onChange={handleChange}
                    aria-label="account-settings tabs"
                    sx={{
                        borderBottom: (theme) =>
                            `1px solid ${theme.palette.divider}`,
                    }}
                >
                    <Tab
                        value="account"
                        label={
                            <Box sx={{ display: 'flex', alignItems: 'center' }}>
                                <AccountOutline />
                                <TabName>Account</TabName>
                            </Box>
                        }
                    />
                    <Tab
                        value="security"
                        label={
                            <Box sx={{ display: 'flex', alignItems: 'center' }}>
                                <LockOpenOutline />
                                <TabName>Security</TabName>
                            </Box>
                        }
                    />
                </TabList>

                <TabPanel sx={{ p: 0 }} value="account">
                    <TabAccount />
                </TabPanel>
                <TabPanel sx={{ p: 0 }} value="security">
                    <TabSecurity />
                </TabPanel>
            </TabContext>
        </Card>
    );
};

export default AccountSettings;
