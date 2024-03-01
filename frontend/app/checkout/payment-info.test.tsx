import '@testing-library/jest-dom';
import React from 'react';

import { render, fireEvent } from '@testing-library/react';
import PaymentInformationCard from "./payment-info";

describe('PaymentInformationCard', () => {
    it('render', () => {
        const { getByText } = render(
            <PaymentInformationCard />
        );
        expect(getByText('Pagar')).toBeInTheDocument();
    });
});