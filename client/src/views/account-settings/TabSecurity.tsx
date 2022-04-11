// ** React Imports
import { useState } from 'react';

// ** MUI Imports
import { yupResolver } from '@hookform/resolvers/yup';
import Avatar from '@mui/material/Avatar';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import CardContent from '@mui/material/CardContent';
import Divider from '@mui/material/Divider';
import Grid from '@mui/material/Grid';
import IconButton from '@mui/material/IconButton';
import InputAdornment from '@mui/material/InputAdornment';
import Typography from '@mui/material/Typography';
import EyeOffOutline from 'mdi-material-ui/EyeOffOutline';
import EyeOutline from 'mdi-material-ui/EyeOutline';
import KeyOutline from 'mdi-material-ui/KeyOutline';
import LockOpenOutline from 'mdi-material-ui/LockOpenOutline';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import InputField from '@layouts/components/input-field';

interface State {
    newPassword: string;
    currentPassword: string;
    showNewPassword: boolean;
    confirmNewPassword: string;
    showCurrentPassword: boolean;
    showConfirmNewPassword: boolean;
}

const TabSecurity = () => {
    // ** States
    const [values, setValues] = useState<State>({
        newPassword: '',
        currentPassword: '',
        showNewPassword: false,
        confirmNewPassword: '',
        showCurrentPassword: false,
        showConfirmNewPassword: false,
    });

    const schema = yup.object().shape({
        currentPassword: yup.string().required(),
        newPassword: yup
            .string()
            .required()
            .min(8, 'At least 8 characters')
            .notOneOf([yup.ref('currentPassword')], 'Can not use old password'),
        confirmPassword: yup
            .string()
            .required('Confirm Password is required')
            .oneOf([yup.ref('newPassword')], 'Passwords must match'),
    });

    const {
        control,
        handleSubmit,
        formState: { isSubmitting, isDirty },
    } = useForm({
        resolver: yupResolver(schema),
        defaultValues: {
            newPassword: '',
            currentPassword: '',
            confirmPassword: '',
        },
    });

    const handleClickShowCurrentPassword = () => {
        setValues({
            ...values,
            showCurrentPassword: !values.showCurrentPassword,
        });
    };

    const handleClickShowNewPassword = () => {
        setValues({ ...values, showNewPassword: !values.showNewPassword });
    };

    function handleClickShowConfirmNewPassword() {
        setValues({
            ...values,
            showConfirmNewPassword: !values.showConfirmNewPassword,
        });
    }

    const handleFormSubmit = () => {};

    return (
        <form onSubmit={handleSubmit(handleFormSubmit)}>
            <CardContent sx={{ paddingBottom: 0 }}>
                <Grid container spacing={5}>
                    <Grid item xs={12} sm={6}>
                        <Grid container spacing={5}>
                            <Grid item xs={12} sx={{ marginTop: 4.75 }}>
                                <InputField
                                    label="Current Password"
                                    control={control}
                                    name="currentPassword"
                                    id="account-settings-current-password"
                                    type={
                                        values.showCurrentPassword
                                            ? 'text'
                                            : 'password'
                                    }
                                    InputProps={{
                                        endAdornment: (
                                            <InputAdornment position="end">
                                                <IconButton
                                                    edge="end"
                                                    aria-label="toggle password visibility"
                                                    onClick={
                                                        handleClickShowCurrentPassword
                                                    }
                                                >
                                                    {values.showCurrentPassword ? (
                                                        <EyeOutline />
                                                    ) : (
                                                        <EyeOffOutline />
                                                    )}
                                                </IconButton>
                                            </InputAdornment>
                                        ),
                                    }}
                                />
                            </Grid>

                            <Grid item xs={12} sx={{ marginTop: 6 }}>
                                <InputField
                                    label="New Password"
                                    name="newPassword"
                                    control={control}
                                    type={
                                        values.showNewPassword
                                            ? 'text'
                                            : 'password'
                                    }
                                    InputProps={{
                                        endAdornment: (
                                            <InputAdornment position="end">
                                                <IconButton
                                                    edge="end"
                                                    onClick={
                                                        handleClickShowNewPassword
                                                    }
                                                    aria-label="toggle password visibility"
                                                >
                                                    {values.showNewPassword ? (
                                                        <EyeOutline />
                                                    ) : (
                                                        <EyeOffOutline />
                                                    )}
                                                </IconButton>
                                            </InputAdornment>
                                        ),
                                    }}
                                />
                            </Grid>

                            <Grid item xs={12}>
                                <InputField
                                    label="Confirm New Password"
                                    control={control}
                                    name="confirmNewPassword"
                                    id="account-settings-confirm-new-password"
                                    type={
                                        values.showConfirmNewPassword
                                            ? 'text'
                                            : 'password'
                                    }
                                    InputProps={{
                                        endAdornment: (
                                            <InputAdornment position="end">
                                                <IconButton
                                                    edge="end"
                                                    aria-label="toggle password visibility"
                                                    onClick={
                                                        handleClickShowConfirmNewPassword
                                                    }
                                                >
                                                    {values.showConfirmNewPassword ? (
                                                        <EyeOutline />
                                                    ) : (
                                                        <EyeOffOutline />
                                                    )}
                                                </IconButton>
                                            </InputAdornment>
                                        ),
                                    }}
                                />
                            </Grid>
                        </Grid>
                    </Grid>

                    <Grid
                        item
                        sm={6}
                        xs={12}
                        sx={{
                            display: 'flex',
                            marginTop: [7.5, 2.5],
                            alignItems: 'center',
                            justifyContent: 'center',
                        }}
                    >
                        <img
                            width={183}
                            alt="avatar"
                            height={256}
                            src="/images/pages/pose-m-1.png"
                        />
                    </Grid>
                </Grid>
            </CardContent>

            <Divider sx={{ margin: 0 }} />

            <CardContent>
                <Box sx={{ mt: 1.75, display: 'flex', alignItems: 'center' }}>
                    <KeyOutline sx={{ marginRight: 3 }} />
                    <Typography variant="h6">
                        Two-factor authentication
                    </Typography>
                </Box>

                <Box
                    sx={{ mt: 5.75, display: 'flex', justifyContent: 'center' }}
                >
                    <Box
                        sx={{
                            maxWidth: 368,
                            display: 'flex',
                            textAlign: 'center',
                            alignItems: 'center',
                            flexDirection: 'column',
                        }}
                    >
                        <Avatar
                            variant="rounded"
                            sx={{
                                width: 48,
                                height: 48,
                                color: 'common.white',
                                backgroundColor: 'primary.main',
                            }}
                        >
                            <LockOpenOutline sx={{ fontSize: '1.75rem' }} />
                        </Avatar>
                        <Typography
                            sx={{
                                fontWeight: 600,
                                marginTop: 3.5,
                                marginBottom: 3.5,
                            }}
                        >
                            Two factor authentication is not enabled yet.
                        </Typography>
                        <Typography variant="body2">
                            Two-factor authentication adds an additional layer
                            of security to your account by requiring more than
                            just a password to log in. Learn more.
                        </Typography>
                    </Box>
                </Box>

                <Box sx={{ mt: 11 }}>
                    <Button
                        disabled={isSubmitting || !isDirty}
                        variant="contained"
                        type="submit"
                        sx={{ marginRight: 3.5 }}
                    >
                        Save Changes
                    </Button>
                    <Button
                        type="reset"
                        variant="outlined"
                        color="secondary"
                        onClick={() =>
                            setValues({
                                ...values,
                                currentPassword: '',
                                newPassword: '',
                                confirmNewPassword: '',
                            })
                        }
                    >
                        Reset
                    </Button>
                </Box>
            </CardContent>
        </form>
    );
};
export default TabSecurity;
