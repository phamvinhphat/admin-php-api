import { useState, ElementType, ChangeEvent, SyntheticEvent } from 'react';

import { yupResolver } from '@hookform/resolvers/yup';
import {
    Avatar,
    Button,
    ButtonProps,
    Grid,
    Box,
    IconButton,
    Alert,
    CardContent,
    Typography,
    AlertTitle,
    Link,
    Badge,
} from '@mui/material';
import { styled } from '@mui/material/styles';
import Close from 'mdi-material-ui/Close';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import { useSettings } from '@core/hooks/useSettings';
import { identityCardRegExp, PhoneNumberRegex } from '@core/utils';
import InputField from '@layouts/components/input-field';
import { SelectField, SelectOption } from '@layouts/components/select-field';
import { IChangeUserInfo } from '@services/types';

const AvatarStyled = styled(Avatar)(({ theme }) => ({
    width: 120,
    height: 120,
    marginRight: theme.spacing(6.25),
    borderRadius: theme.shape.borderRadius,
}));

const ButtonStyled = styled(Button)<
    ButtonProps & { component?: ElementType; htmlFor?: string }
>(({ theme }) => ({
    [theme.breakpoints.down('sm')]: {
        width: '100%',
        textAlign: 'center',
    },
}));

const ResetButtonStyled = styled(Button)<ButtonProps>(({ theme }) => ({
    marginLeft: theme.spacing(4.5),
    [theme.breakpoints.down('sm')]: {
        width: '100%',
        marginLeft: 0,
        textAlign: 'center',
        marginTop: theme.spacing(4),
    },
}));

const schema = yup.object().shape({
    firstName: yup.string().required(),
    lastName: yup.string().required(),
    idCard: yup.string().required().matches(identityCardRegExp, ''),
    phoneNumber: yup.string().required().matches(PhoneNumberRegex, ''),
    dob: yup.date().required().typeError(''),
    gender: yup.string().required(),
});

const genders: SelectOption[] = [
    { label: 'Male', value: 'male' },
    { label: 'Female', value: 'female' },
    { label: 'Other', value: 'other' },
];

const TabAccount = () => {
    const { userInfo } = useSettings();
    // ** State
    const [openAlert, setOpenAlert] = useState<boolean>(!userInfo?.isVerify);
    const [imgSrc, setImgSrc] = useState<string>(userInfo?.avatar ?? '');

    const {
        control,
        formState: { isSubmitting, isDirty },
        handleSubmit,
        reset,
    } = useForm<IChangeUserInfo>({
        defaultValues: {
            dob: userInfo?.dob ?? new Date(),
            gender: userInfo?.gender ?? 'male',
            idCard: userInfo?.idCard ?? '',
            firstName: userInfo?.firstName ?? 'John',
            lastName: userInfo?.lastName ?? 'Doe',
            phoneNumber: userInfo?.phoneNumber ?? '',
        },
        resolver: yupResolver(schema),
    });

    const onChange = (file: ChangeEvent) => {
        const reader = new FileReader();
        const { files } = file.target as HTMLInputElement;
        if (files && files.length !== 0) {
            reader.onload = () => setImgSrc(reader.result as string);

            reader.readAsDataURL(files[0]);
        }
    };

    const handleFormSubmit = async (formValues: IChangeUserInfo) => {
        console.log(formValues);
    };

    return (
        <CardContent>
            <form onSubmit={handleSubmit(handleFormSubmit)}>
                <Grid container spacing={7}>
                    <Grid item xs={12} sx={{ marginTop: 4.8, marginBottom: 3 }}>
                        <Box sx={{ display: 'flex', alignItems: 'center' }}>
                            <Badge
                                badgeContent={
                                    userInfo?.isVerify ? 'Verified' : ''
                                }
                                color={
                                    userInfo?.isVerify ? 'primary' : undefined
                                }
                                anchorOrigin={{
                                    vertical: 'bottom',
                                    horizontal: 'right',
                                }}
                            >
                                <AvatarStyled
                                    src={imgSrc}
                                    alt={userInfo?.username}
                                    variant="rounded"
                                />
                            </Badge>
                            <Box>
                                <ButtonStyled
                                    component="label"
                                    variant="contained"
                                    htmlFor="account-settings-upload-image"
                                >
                                    Upload New Photo
                                    <input
                                        hidden
                                        type="file"
                                        onChange={onChange}
                                        accept="image/png, image/jpeg"
                                        id="account-settings-upload-image"
                                    />
                                </ButtonStyled>
                                <ResetButtonStyled
                                    color="error"
                                    variant="outlined"
                                    onClick={() =>
                                        setImgSrc(userInfo?.avatar ?? '')
                                    }
                                >
                                    Reset
                                </ResetButtonStyled>
                                <Typography
                                    variant="body2"
                                    sx={{ marginTop: 5 }}
                                >
                                    Allowed PNG or JPEG. Max size of 800K.
                                </Typography>
                            </Box>
                        </Box>
                    </Grid>

                    <Grid item xs={12} sm={6}>
                        <InputField
                            fullWidth
                            label="First Name"
                            control={control}
                            name="firstName"
                            placeholder="John"
                        />
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <InputField
                            control={control}
                            name="lastName"
                            fullWidth
                            label="Last Name"
                            placeholder="Doe"
                        />
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <InputField
                            control={control}
                            name="email"
                            fullWidth
                            type="email"
                            label="Email"
                            placeholder="email@email.com"
                        />
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <SelectField
                            label="Gender"
                            name="gender"
                            control={control}
                            options={genders}
                            fullWidth
                            sx={{ margin: 0 }}
                        />
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <InputField
                            control={control}
                            name="dob"
                            label="Date of birth"
                            type="date"
                            InputLabelProps={{
                                shrink: true,
                            }}
                            fullWidth
                        />
                    </Grid>
                    <Grid item xs={12} sm={6}>
                        <InputField
                            control={control}
                            name="idCard"
                            fullWidth
                            label="Identity Card"
                        />
                    </Grid>

                    {openAlert ? (
                        <Grid item xs={12} sx={{ mb: 3 }}>
                            <Alert
                                severity="warning"
                                sx={{ '& a': { fontWeight: 400 } }}
                                action={
                                    <IconButton
                                        size="small"
                                        color="inherit"
                                        aria-label="close"
                                        onClick={() => setOpenAlert(false)}
                                    >
                                        <Close fontSize="inherit" />
                                    </IconButton>
                                }
                            >
                                <AlertTitle>
                                    Your email is not confirmed. Please check
                                    your inbox.
                                </AlertTitle>
                                <Link
                                    href="/"
                                    onClick={(e: SyntheticEvent) =>
                                        e.preventDefault()
                                    }
                                >
                                    Resend Confirmation
                                </Link>
                            </Alert>
                        </Grid>
                    ) : null}

                    <Grid item xs={12}>
                        <Button
                            disabled={!isDirty || isSubmitting}
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
                            onClick={() => reset()}
                        >
                            Reset
                        </Button>
                    </Grid>
                </Grid>
            </form>
        </CardContent>
    );
};

export default TabAccount;
