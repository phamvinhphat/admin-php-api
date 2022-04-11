// ** React Import
import { ReactNode } from 'react';

// ** Next Import

// ** MUI Imports
import Box, { BoxProps } from '@mui/material/Box';
import { styled } from '@mui/material/styles';
import Typography, { TypographyProps } from '@mui/material/Typography';
import Link from 'next/link';

// ** Type Import

// ** Configs
import { Settings } from '@core/layouts/types';
import Logo from '@views/pages/misc/Logo';
import themeConfig from '@configs/themeConfig';

interface Props {
    hidden: boolean;
    settings: Settings;
    toggleNavVisibility: () => void;
    saveSettings: (values: Settings) => void;
    verticalNavMenuBranding?: (props?: any) => ReactNode;
}

// ** Styled Components
const MenuHeaderWrapper = styled(Box)<BoxProps>(({ theme }) => ({
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingRight: theme.spacing(4.5),
    transition: 'padding .25s ease-in-out',
    minHeight: theme.mixins.toolbar.minHeight,
}));

const HeaderTitle = styled(Typography)<TypographyProps>(({ theme }) => ({
    fontWeight: 600,
    lineHeight: 'normal',
    textTransform: 'uppercase',
    color: theme.palette.text.primary,
    transition: 'opacity .25s ease-in-out, margin .25s ease-in-out',
}));

const StyledLink = styled('a')({
    display: 'flex',
    alignItems: 'center',
    textDecoration: 'none',
});

const VerticalNavHeader = (props: Props) => {
    const { verticalNavMenuBranding: userVerticalNavMenuBranding } = props;

    return (
        <MenuHeaderWrapper className="nav-header" sx={{ pl: 6 }}>
            {userVerticalNavMenuBranding ? (
                userVerticalNavMenuBranding(props)
            ) : (
                <Link href="/" passHref>
                    <StyledLink>
                        <Logo />
                        <HeaderTitle variant="h6" sx={{ ml: 3 }}>
                            {themeConfig.templateName}
                        </HeaderTitle>
                    </StyledLink>
                </Link>
            )}
        </MenuHeaderWrapper>
    );
};

export default VerticalNavHeader;
