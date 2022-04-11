// ** React Imports
import { MouseEvent, ReactNode, useEffect, useState } from 'react';

// ** Next Imports

// ** MUI Components
import { yupResolver } from '@hookform/resolvers/yup';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import MuiCard, { CardProps } from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import Checkbox from '@mui/material/Checkbox';
import Divider from '@mui/material/Divider';
import MuiFormControlLabel, {
    FormControlLabelProps,
} from '@mui/material/FormControlLabel';
import IconButton from '@mui/material/IconButton';
import InputAdornment from '@mui/material/InputAdornment';
import { styled } from '@mui/material/styles';
import Typography from '@mui/material/Typography';
import EyeOffOutline from 'mdi-material-ui/EyeOffOutline';
import EyeOutline from 'mdi-material-ui/EyeOutline';
import Link from 'next/link';
import { useRouter } from 'next/router';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';
import * as yup from 'yup';

import themeConfig from '@configs/themeConfig';
import BlankLayout from '@core/layouts/BlankLayout';
import { EmailRegex } from '@core/utils';
import InputField from '@layouts/components/input-field';
import { useLogin } from '@services';
import { getLocalToken, setLocalToken } from '@services/utils';
import FooterIllustrationsV1 from '@views/pages/auth/FooterIllustration';
import OAuthSection from '@views/pages/auth/OAuthSection';
import Logo from '@views/pages/misc/Logo';

interface State {
    password: string;
    email: string;
    showPassword: boolean;
}

// ** Styled Components
const Card = styled(MuiCard)<CardProps>(({ theme }) => ({
    [theme.breakpoints.up('sm')]: { width: '28rem' },
}));

const LinkStyled = styled('a')(({ theme }) => ({
    fontSize: '0.875rem',
    textDecoration: 'none',
    color: theme.palette.primary.main,
}));

const FormControlLabel = styled(MuiFormControlLabel)<FormControlLabelProps>(
    ({ theme }) => ({
        '& .MuiFormControlLabel-label': {
            fontSize: '0.875rem',
            color: theme.palette.text.secondary,
        },
    })
);

const LoginPage = () => {
    // ** State
    const [values, setValues] = useState<State>({
        password: '',
        email: '',
        showPassword: false,
    });

    const schema = yup.object().shape({
        email: yup
            .string()
            .matches(EmailRegex, 'Invalid email format')
            .required('Please enter your email'),
        password: yup.string().required('Please enter your password'),
    });

    // ** Hook
    const router = useRouter();
    const { mutateAsync } = useLogin();
    const {
        control,
        handleSubmit,
        formState: { isSubmitting },
    } = useForm<Omit<State, 'showPassword'>>({
        defaultValues: { email: '', password: '' },
        resolver: yupResolver(schema),
    });

    useEffect(() => {
        if (getLocalToken()) router.push('/');
    }, []);

    const handleClickShowPassword = () => {
        setValues({ ...values, showPassword: !values.showPassword });
    };

    const handleMouseDownPassword = (event: MouseEvent<HTMLButtonElement>) => {
        event.preventDefault();
    };

    const handleFormSubmit = async (
        formValues: Omit<State, 'showPassword'>
    ) => {
        await toast.promise(
            mutateAsync(formValues, {
                onSuccess: (data) => {
                    console.log('Login data', data);
                    if (data.result) {
                        setLocalToken(data.result);
                        router.push('/');
                    }
                },
            }),
            {
                pending: 'Authenticating...',
            }
        );
    };

    return (
        <Box className="content-center">
            <Card sx={{ zIndex: 1 }}>
                <CardContent
                    sx={{
                        padding: (theme) =>
                            `${theme.spacing(12, 9, 7)} !important`,
                    }}
                >
                    <Box
                        sx={{
                            mb: 8,
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                        }}
                    >
                        <Logo />
                        <Typography
                            variant="h6"
                            sx={{
                                ml: 3,
                                lineHeight: 1,
                                fontWeight: 600,
                                textTransform: 'uppercase',
                                fontSize: '1.5rem !important',
                            }}
                        >
                            {themeConfig.templateName}
                        </Typography>
                    </Box>
                    <Box sx={{ mb: 6 }}>
                        <Typography
                            variant="h5"
                            sx={{ fontWeight: 600, marginBottom: 1.5 }}
                        >
                            Welcome to {themeConfig.templateName}! 👋🏻
                        </Typography>
                        <Typography variant="body2">
                            Please sign-in to your account and start the
                            adventure
                        </Typography>
                    </Box>
                    <form
                        noValidate
                        autoComplete="off"
                        onSubmit={handleSubmit(handleFormSubmit)}
                    >
                        <InputField
                            autoFocus
                            fullWidth
                            id="email"
                            label="Email"
                            sx={{ marginBottom: 4 }}
                            control={control}
                            name="email"
                        />
                        <InputField
                            name="password"
                            label="Password"
                            fullWidth
                            control={control}
                            type={values.showPassword ? 'text' : 'password'}
                            InputProps={{
                                endAdornment: (
                                    <InputAdornment position="end">
                                        <IconButton
                                            edge="end"
                                            onClick={handleClickShowPassword}
                                            onMouseDown={
                                                handleMouseDownPassword
                                            }
                                            aria-label="toggle password visibility"
                                        >
                                            {values.showPassword ? (
                                                <EyeOutline />
                                            ) : (
                                                <EyeOffOutline />
                                            )}
                                        </IconButton>
                                    </InputAdornment>
                                ),
                            }}
                        />
                        <Box
                            sx={{
                                mb: 4,
                                display: 'flex',
                                alignItems: 'center',
                                flexWrap: 'wrap',
                                justifyContent: 'space-between',
                            }}
                        >
                            <FormControlLabel
                                control={<Checkbox />}
                                label="Remember Me"
                            />
                            <Link passHref href="/">
                                <LinkStyled onClick={(e) => e.preventDefault()}>
                                    Forgot Password?
                                </LinkStyled>
                            </Link>
                        </Box>
                        <Button
                            fullWidth
                            size="large"
                            variant="contained"
                            sx={{ marginBottom: 7 }}
                            disabled={isSubmitting}
                            type="submit"
                        >
                            Login
                        </Button>
                        <Box
                            sx={{
                                display: 'flex',
                                alignItems: 'center',
                                flexWrap: 'wrap',
                                justifyContent: 'center',
                            }}
                        >
                            <Typography variant="body2" sx={{ marginRight: 2 }}>
                                New on our platform?
                            </Typography>
                            <Typography variant="body2">
                                <Link passHref href="/pages/register">
                                    <LinkStyled>Create an account</LinkStyled>
                                </Link>
                            </Typography>
                        </Box>
                        <Divider sx={{ my: 5 }}>or</Divider>
                        <OAuthSection />
                    </form>
                </CardContent>
            </Card>
            <FooterIllustrationsV1 />
        </Box>
    );
};

LoginPage.getLayout = (page: ReactNode) => <BlankLayout>{page}</BlankLayout>;

export default LoginPage;
