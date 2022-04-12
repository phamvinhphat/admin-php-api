import React, { MouseEvent } from 'react';

import Box from '@mui/material/Box';
import IconButton from '@mui/material/IconButton';
import Facebook from 'mdi-material-ui/Facebook';
import Github from 'mdi-material-ui/Github';
import Google from 'mdi-material-ui/Google';
import Twitter from 'mdi-material-ui/Twitter';
import Link from 'next/link';

const OAuthSection = () => {
    return (
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
                    onClick={(e: MouseEvent<HTMLElement>) => e.preventDefault()}
                >
                    <Facebook sx={{ color: '#497ce2' }} />
                </IconButton>
            </Link>
            <Link href="/" passHref>
                <IconButton
                    component="a"
                    onClick={(e: MouseEvent<HTMLElement>) => e.preventDefault()}
                >
                    <Twitter sx={{ color: '#1da1f2' }} />
                </IconButton>
            </Link>
            <Link href="/" passHref>
                <IconButton
                    component="a"
                    onClick={(e: MouseEvent<HTMLElement>) => e.preventDefault()}
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
                    onClick={(e: MouseEvent<HTMLElement>) => e.preventDefault()}
                >
                    <Google sx={{ color: '#db4437' }} />
                </IconButton>
            </Link>
        </Box>
    );
};

export default OAuthSection;
