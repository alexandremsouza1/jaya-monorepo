import mercadopago from '@mercadopago/sdk-react';

import { InstallmentsParams,PaymentMethodsParams,CardTokenParams } from './interfaces/mercadopago-sdk';

// Inicializa o MercadoPago SDK com a chave pública
mercadopago.initMercadoPago(process.env.PUBLIC_SDK_MERCADO_PAGO_KEY);


// Função para carregar opções de parcelamento
export const getInstallments = async (params: InstallmentsParams) => {
  try {
    const installmentsData = await mercadopago.getInstallments(params);
    return installmentsData;
  } catch (error) {
    console.error('Erro ao carregar opções de parcelamento:', error);
  }
};

// Função para encontrar o campo payment_method_id
export const getPaymentMethods = async (params: PaymentMethodsParams) => {
  try {
    const paymentMethodsData = await mercadopago.getPaymentMethods(params);
    return paymentMethodsData;
  } catch (error) {
    console.error('Erro ao encontrar payment_method_id:', error);
  }
};

// Função para criar o token do cartão
export const createCardToken = async (cardData: CardTokenParams) => {
  try {
    const cardToken = await mercadopago.createCardToken(cardData);
    return cardToken;
  } catch (error) {
    console.error('Erro ao criar token do cartão:', error);
  }
};
