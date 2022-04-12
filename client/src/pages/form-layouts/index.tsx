import Grid from '@mui/material/Grid';

import DatePickerWrapper from '@core/styles/libs/react-datepicker';

import 'react-datepicker/dist/react-datepicker.css';
import {
    FormLayoutsAlignment,
    FormLayoutsBasic,
    FormLayoutsIcons,
    FormLayoutsSeparator,
} from '@views';

const FormLayouts = () => {
    return (
        <DatePickerWrapper>
            <Grid container spacing={6}>
                <Grid item xs={12} md={6}>
                    <FormLayoutsBasic />
                </Grid>
                <Grid item xs={12} md={6}>
                    <FormLayoutsIcons />
                </Grid>
                <Grid item xs={12}>
                    <FormLayoutsSeparator />
                </Grid>
                <Grid item xs={12}>
                    <FormLayoutsAlignment />
                </Grid>
            </Grid>
        </DatePickerWrapper>
    );
};

export default FormLayouts;
