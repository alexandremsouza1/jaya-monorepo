import { CardForm } from "@/components/CardForm";

export default function Home() {
  return (
    <CardForm
      amount="100"
      card={{
        cardNumber: "4235647728025682",
        cardholderName: "APRO",
        expirationMonth: "11",
        expirationYear: "2023",
        securityCode: "123",
        identificationType: "CPF",
        identificationNumber: "19119119100",
        paymentMethodId: "visa",
        issuerId: "282",
        installments: 1,
        processingMode: "aggregator",
        cardToken: "token",
      }}
      customer={{
        email: "",
        identificationType: "CPF",
        identificationNumber: "19119119100",
      }}
      onSubmit={(resultSubmit) => {
        console.log(resultSubmit);
      }}
    />
  );
}
