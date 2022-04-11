import { useState, Fragment, ChangeEvent, MouseEvent, ReactNode } from 'react';

import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import MuiCard, { CardProps } from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import Checkbox from '@mui/material/Checkbox';
import Divider from '@mui/material/Divider';
import FormControl from '@mui/material/FormControl';
import MuiFormControlLabel, {
    FormControlLabelProps,
} from '@mui/material/FormControlLabel';
import IconButton from '@mui/material/IconButton';
import InputAdornment from '@mui/material/InputAdornment';
import InputLabel from '@mui/material/InputLabel';
import OutlinedInput from '@mui/material/OutlinedInput';
import { styled, useTheme } from '@mui/material/styles';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography';
import EyeOffOutline from 'mdi-material-ui/EyeOffOutline';
import EyeOutline from 'mdi-material-ui/EyeOutline';
import Facebook from 'mdi-material-ui/Facebook';
import Github from 'mdi-material-ui/Github';
import Google from 'mdi-material-ui/Google';
import Twitter from 'mdi-material-ui/Twitter';
import Link from 'next/link';

import themeConfig from '@configs/themeConfig';
import BlankLayout from '@core/layouts/BlankLayout';
import FooterIllustrationsV1 from '@views/pages/auth/FooterIllustration';
import Logo from '@views/pages/misc/Logo';

interface State {
    password: string;
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
        marginTop: theme.spacing(1.5),
        marginBottom: theme.spacing(4),
        '& .MuiFormControlLabel-label': {
            fontSize: '0.875rem',
            color: theme.palette.text.secondary,
        },
    })
);

const RegisterPage = () => {
    // ** States
    const [values, setValues] = useState<State>({
        password: '',
        showPassword: false,
    });

    const handleChange =
        (prop: keyof State) => (event: ChangeEvent<HTMLInputElement>) => {
            setValues({ ...values, [prop]: event.target.value });
        };
    const handleClickShowPassword = () => {
        setValues({ ...values, showPassword: !values.showPassword });
    };
    const handleMouseDownPassword = (event: MouseEvent<HTMLButtonElement>) => {
        event.preventDefault();
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
                            Adventure starts here 🚀
                        </Typography>
                        <Typography variant="body2">
                            Make your app management easy and fun!
                        </Typography>
                    </Box>
                    <form
                        noValidate
                        autoComplete="off"
                        onSubmit={(e) => e.preventDefault()}
                    >
                        <TextField
                            autoFocus
                            fullWidth
                            id="username"
                            label="Username"
                            sx={{ marginBottom: 4 }}
                        />
                        <TextField
                            fullWidth
                            type="email"
                            label="Email"
                            sx={{ marginBottom: 4 }}
                        />
                        <FormControl fullWidth>
                            <InputLabel htmlFor="auth-register-password">
                                Password
                            </InputLabel>
                            <OutlinedInput
                                label="Password"
                                value={values.password}
                                id="auth-register-password"
                                onChange={handleChange('password')}
                                type={values.showPassword ? 'text' : 'password'}
                                endAdornment={
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
                                                <EyeOutline fontSize="small" />
                                            ) : (
                                                <EyeOffOutline fontSize="small" />
                                            )}
                                        </IconButton>
                                    </InputAdornment>
                                }
                            />
                        </FormControl>
                        <FormControlLabel
                            control={<Checkbox />}
                            label={
                                <Fragment>
                                    <span>I agree to </span>
                                    <Link href="/" passHref>
                                        <LinkStyled
                                            onClick={(
                                                e: MouseEvent<HTMLElement>
                                            ) => e.preventDefault()}
                                        >
                                            privacy policy & terms
                                        </LinkStyled>
                                    </Link>
                                </Fragment>
                            }
                        />
                        <Button
                            fullWidth
                            size="large"
                            type="submit"
                            variant="contained"
                            sx={{ marginBottom: 7 }}
                        >
                            Sign up
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
                                Already have an account?
                            </Typography>
                            <Typography variant="body2">
                                <Link passHref href="/pages/login">
                                    <LinkStyled>Sign in instead</LinkStyled>
                                </Link>
                            </Typography>
                        </Box>
                        <Divider sx={{ my: 5 }}>or</Divider>
                        <Box
                            sx={{
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'center',
                            }}
                        >
                            <Link href="/" passHref>
                                <IconButton
                                    component="a"
                                    onClick={(e: MouseEvent<HTMLElement>) =>
                                        e.preventDefault()
                                    }
                                >
                                    <Facebook sx={{ color: '#497ce2' }} />
                                </IconButton>
                            </Link>
                            <Link href="/" passHref>
                                <IconButton
                                    component="a"
                                    onClick={(e: MouseEvent<HTMLElement>) =>
                                        e.preventDefault()
                                    }
                                >
                                    <Twitter sx={{ color: '#1da1f2' }} />
                                </IconButton>
                            </Link>
                            <Link href="/" passHref>
                                <IconButton
                                    component="a"
                                    onClick={(e: MouseEvent<HTMLElement>) =>
                                        e.preventDefault()
                                    }
                                >
                                    <Github
                                        sx={{
                                            color: (theme) =>
                                                theme.palette.mode === 'light'
                                                    ? '#272727'
                                                    : theme.palette.grey[300],
                                        }}
                                    />
                                </IconButton>
                            </Link>
                            <Link href="/" passHref>
                                <IconButton
                                    component="a"
                                    onClick={(e: MouseEvent<HTMLElement>) =>
                                        e.preventDefault()
                                    }
                                >
                                    <Google sx={{ color: '#db4437' }} />
                                </IconButton>
                            </Link>
                        </Box>
                    </form>
                </CardContent>
            </Card>
            <FooterIllustrationsV1 />
        </Box>
    );
};

RegisterPage.getLayout = (page: ReactNode) => <BlankLayout>{page}</BlankLayout>;

export default RegisterPage;
