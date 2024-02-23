import { createCardToken } from '@/lib/mercadopago';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

import React from 'react';

interface CardFormProps {
  amount: string;
  card: CardFormState;
  customer: CustomerFormState;
  onSubmit: (params: object) => void;
}

interface CardFormState {
  cardNumber: string;
  cardholderName: string;
  expirationMonth: string;
  expirationYear: string;
  securityCode: string;
  identificationType: string;
  identificationNumber: string;
  paymentMethodId: string;
  issuerId: string;
  installments: number;
  processingMode: string;
  cardToken: string;
}

interface CustomerFormState {
  email: string;
  identificationType: string;
  identificationNumber: string;
}

export function CardForm({ amount, card, customer, onSubmit }: CardFormProps) {
  const setCard = (newCard: CardFormState) => {
    card = newCard;
  };
  const error = new Error('Ocorreu um erro.');


  const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const cardToken = await createCardToken({
      securityCode: card.securityCode,
      cardNumber: card.cardNumber,
      cardholderName: card.cardholderName,
      expirationMonth: card.expirationMonth,
      expirationYear: card.expirationYear,
      identificationType: card.identificationType,
      identificationNumber: card.identificationNumber,
      cardId: card.paymentMethodId,
    });
    if(!cardToken) return toast.error(error.message);
    const resultSubmit = {
      transaction_amount: amount,
      installments : card.installments,
      token : cardToken ? cardToken.id : '',
      payment_method_id : card.paymentMethodId,
      payer : {
        email: customer.email,
        identification: {
          type: customer.identificationType,
          number: customer.identificationNumber,
        },
      }
    };
    onSubmit(resultSubmit);
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        value={card.cardNumber}
        onChange={(e) => setCard({ ...card, cardNumber: e.target.value })}
      />
      <input
        type="text"
        value={card.cardholderName}
        onChange={(e) => setCard({ ...card, cardholderName: e.target.value })}
      />
      <input
        type="text"
        value={card.expirationMonth}
        onChange={(e) => setCard({ ...card, expirationMonth: e.target.value })}
      />
      <input
        type="text"
        value={card.expirationYear}
        onChange={(e) => setCard({ ...card, expirationYear: e.target.value })}
      />
      <input
        type="text"
        value={card.securityCode}
        onChange={(e) => setCard({ ...card, securityCode: e.target.value })}
      />
      <input
        type="text"
        value={card.identificationType}
        onChange={(e) => setCard({ ...card, identificationType: e.target.value })}
      />
      <input
        type="text"
        value={card.identificationNumber}
        onChange={(e) => setCard({ ...card, identificationNumber: e.target.value })}
      />
      <button type="submit">Pagar</button>
    </form>
  );
}