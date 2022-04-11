import Grid from '@mui/material/Grid';
import Typography from '@mui/material/Typography';

import {
    CardImgTop,
    CardUser,
    CardMembership,
    CardTwitter,
    CardMobile,
    CardSupport,
    CardAppleWatch,
    CardInfluencer,
    CardHorizontalRatings,
    CardLinkedIn,
    CardFacebook,
    CardNavigationCenter,
    CardNavigation,
    CardVerticalRatings,
} from '@views';
import CardWithCollapse from '@views/cards/CardWithCollapse';

const CardBasic = () => {
    return (
        <Grid container spacing={6}>
            <Grid item xs={12} sx={{ paddingBottom: 4 }}>
                <Typography variant="h5">Basic Cards</Typography>
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardImgTop />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardUser />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardWithCollapse />
            </Grid>
            <Grid item xs={12} sm={6}>
                <CardMobile />
            </Grid>
            <Grid item xs={12} sm={6}>
                <CardHorizontalRatings />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardAppleWatch />
            </Grid>
            <Grid item xs={12} md={8}>
                <CardMembership />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardInfluencer />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardVerticalRatings />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardSupport />
            </Grid>
            <Grid
                item
                xs={12}
                sx={{
                    pb: 4,
                    pt: (theme) => `${theme.spacing(17.5)} !important`,
                }}
            >
                <Typography variant="h5">Navigation Cards</Typography>
            </Grid>
            <Grid item xs={12} md={6}>
                <CardNavigation />
            </Grid>
            <Grid item xs={12} md={6}>
                <CardNavigationCenter />
            </Grid>
            <Grid
                item
                xs={12}
                sx={{
                    pb: 4,
                    pt: (theme) => `${theme.spacing(17.5)} !important`,
                }}
            >
                <Typography variant="h5">Solid Cards</Typography>
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardTwitter />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardFacebook />
            </Grid>
            <Grid item xs={12} sm={6} md={4}>
                <CardLinkedIn />
            </Grid>
        </Grid>
    );
};

export default CardBasic;
