import { initMercadoPago } from "@mercadopago/sdk-react";
import { createCardToken,getInstallments } from "@mercadopago/sdk-react/coreMethods";
import { CardToken } from "@mercadopago/sdk-react/coreMethods/util/types";

//doc: https://github.com/mercadopago/sdk-js/blob/main/API/core-methods.md#mp-instancecreatecardtokencardtokenparams
export class MercadoPagoService {
  publicKey: string;

  constructor() {
    this.publicKey = process.env.NEXT_PUBLIC_SDK_MERCADO_PAGO_KEY || '';
    initMercadoPago(this.publicKey);
  }

  public async MercadoPagoCardToken(
    cardNumber: string,
    cardName: string,
    cvv: string,
    cardExpirationMonth: string,
    cardExpirationYear: string,
    identificationType : string,
    identificationNumber : string
  ): Promise<CardToken | undefined> {
    return await createCardToken({
      cardNumber: cardNumber,
      cardholderName: cardName,
      cardExpirationMonth: cardExpirationMonth,
      cardExpirationYear: cardExpirationYear,
      securityCode: cvv,
      identificationType: identificationType.toUpperCase(),
      identificationNumber: identificationNumber,
    });
  }

  public async GetParcels(paymentMethodId: string, amount: string , cardNumber:string) {
    const response = await getInstallments({
      bin: this.getBin(cardNumber),
      amount: amount,
      paymentMethodId: paymentMethodId,
    });
    return response;
  }

  private getBin(cardNumber: string) : string {
    return cardNumber.substring(0, 6);
  }
}
