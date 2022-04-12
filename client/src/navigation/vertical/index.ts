// ** Icon imports
import {
    SignCaution,
    NewspaperVariantOutline,
    AccountWrench,
} from 'mdi-material-ui';
import AccountPlusOutline from 'mdi-material-ui/AccountPlusOutline';
import CreditCardOutline from 'mdi-material-ui/CreditCardOutline';
import CubeOutline from 'mdi-material-ui/CubeOutline';
import FormatLetterCase from 'mdi-material-ui/FormatLetterCase';
import GoogleCirclesExtended from 'mdi-material-ui/GoogleCirclesExtended';
import HomeOutline from 'mdi-material-ui/HomeOutline';
import Table from 'mdi-material-ui/Table';

// ** Type import
import { VerticalNavItemsType } from '@core/layouts/types';

const navigation = (): VerticalNavItemsType => {
    return [
        {
            title: 'Dashboard',
            icon: HomeOutline,
            path: '/',
        },
        {
            title: 'Account Setting',
            icon: AccountWrench,
            path: '/account-settings',
        },
        {
            sectionTitle: 'Page Settings',
        },
        {
            title: 'Roles / Permissions',
            icon: SignCaution,
            path: '/authorization',
        },
        {
            title: 'Accounts',
            icon: AccountPlusOutline,
            path: '/account',
        },
        {
            title: 'Posts',
            icon: NewspaperVariantOutline,
            path: '/post',
        },
        {
            sectionTitle: 'User Interface',
        },
        {
            title: 'Typography',
            icon: FormatLetterCase,
            path: '/typography',
        },
        {
            title: 'Icons',
            path: '/icons',
            icon: GoogleCirclesExtended,
        },
        {
            title: 'Cards',
            icon: CreditCardOutline,
            path: '/cards',
        },
        {
            title: 'Tables',
            icon: Table,
            path: '/tables',
        },
        {
            icon: CubeOutline,
            title: 'Form Layouts',
            path: '/form-layouts',
        },
    ];
};

export default navigation;
