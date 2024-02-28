import React,{ useEffect,useState } from "react";
import * as MP from "@/app/services/mercadoPagoService";

import { IPaymentRunRequest,ICard } from "@/src/api/types";
import {PayerCost} from "@mercadopago/sdk-react/coreMethods/util/types";
import { useRunPayment } from "@/src/api/checkout";
import {
  Card,
  CardBody,
  CardHeader,
  Divider,
  Button,
  Input,
  Select,
  SelectItem,
  Spinner,
} from "@nextui-org/react";
import toast from "@/components/toast";



export default function PaymentInformationCard() {

  const [installments, setInstallments] = useState<PayerCost[]>([]);
  const [selectedParcel, setSelectedParcel] = useState<string>('');
  const [email , setEmail] = useState<string>('');
  const [documentType, setDocumentType] = useState<string>('');
  const [documentNumber, setDocumentNumber] = useState<string>('');
  const [amount, setAmount] = useState<string>('');
  const [card , setCard] = useState<ICard>({
    cardNumber: '',
    cardHolder: '',
    expirationMonth: '',
    expirationYear: '',
    cvv: ''
  });
  const [loadingRequest, setLoadingRequest] = useState(false);

  const { doRunPayment, error: paymentError } = useRunPayment();
  useEffect(() => {
    const getParcels = async () => {
      const mercadoPagoService: MP.MercadoPagoService = new MP.MercadoPagoService();
      let installments = await mercadoPagoService.GetParcels('master', amount, card.cardNumber);
      if(installments && typeof installments[0] !== 'undefined')
        setInstallments(installments[0].payer_costs);
    }
    getParcels();
  },[amount]);

  const handleSelectionChange = (e: any) => {
    setSelectedParcel(e.target.value);
  }

  const getMpToken = async () => {
    let mpToken = null;

    try {
      const mercadoPagoService: MP.MercadoPagoService =
        new MP.MercadoPagoService();
      mpToken = await mercadoPagoService.MercadoPagoCardToken(
        card.cardNumber,
        card.cardHolder,
        card.cvv,
        card.expirationMonth,
        card.expirationYear
      );
    } catch (err) {
      toast({"type": "error", "message": "Erro ao gerar o token do cartão."});
    }
    return mpToken;
  };

  const handleSubmit = async (e: any) => {
    e.preventDefault();
    let cardToken = await getMpToken();
    let payload: IPaymentRunRequest = {
      "transaction_amount": amount,
      "installments": selectedParcel,
      "token": cardToken?.id,
      "payment_method_id": "master",
      "payer": {
          "email": email,
          "identification": {
              "type": documentType,
              "number": documentNumber
          }
      },
    };
    try {
      await doRunPayment(payload);
      if(paymentError){
        toast({"type": "error", "message": "Erro ao realizar o pagamento."});
        return;
      }
    } catch (err) {
      toast({"type": "error", "message": "Erro ao realizar o pagamento."});
    }
  };
  
  return (
    <form className="w-full flex flex-wrap gap-4">
      <Card className="flex-1">
        <CardHeader className="flex gap-3 justify-center">
          <h1 className="text-2xl font-semibold">Dados do pagador</h1>
        </CardHeader>
        <Divider />
        <CardBody className="flex w-full flex-wrap md:flex-nowrap mb-6 md:mb-0 gap-4">
            <Input  placeholder="Email do pagador"  type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
            <Select placeholder="Tipo de documento" value={documentType} onChange={(e) => setDocumentType(e.target.value)}>
              <SelectItem key="cpf" value="cpf">CPF</SelectItem>
              <SelectItem key="cnpj"value="cnpj">CNPJ</SelectItem>
            </Select>
            <Input placeholder="Número de identificação" value={documentNumber} onChange={(e) => setDocumentNumber(e.target.value)} />
        </CardBody>
      </Card>
      <Card className="flex-1">
        <CardHeader className="flex gap-3 justify-center">
          <h1 className="text-2xl font-semibold">Dados do pagamento</h1>
        </CardHeader>
        <Divider />
        <CardBody className="flex w-full flex-wrap md:flex-nowrap mb-6 md:mb-0 gap-4">
        <Input
            placeholder="Valor do pagamento"
            type="number"
            value={amount}
            onChange={(e) => setAmount(e.target.value)}
          />
          <Input placeholder="Número do cartão" type="number" value={card.cardNumber} onChange={(e) => setCard({...card, cardNumber: e.target.value})} />
          <Input placeholder="Nome do titular" value={card.cardHolder} onChange={(e) => setCard({...card, cardHolder: e.target.value})} />
          <Input placeholder="Mês de expiração" pattern="[0-9]{2}" value={card.expirationMonth} onChange={(e) => setCard({...card, expirationMonth: e.target.value})} />
          <Input placeholder="Ano de expiração" pattern="[0-9]{4}" value={card.expirationYear} onChange={(e) => setCard({...card, expirationYear: e.target.value})} />
          <Input placeholder="CVV" value={card.cvv} onChange={(e) => setCard({...card, cvv: e.target.value})} />
          <Select 
              placeholder="Parcelas"
              onChange={handleSelectionChange}
          >
          {
              installments.map(({installments, recommended_message}) => (
                <SelectItem 
                    key={installments}
                    value={recommended_message}
                >
                  {recommended_message}
                </SelectItem>
              ))
          }
          </Select>
        </CardBody>
      </Card>
      <div className="fixed bottom-0 left-0 right-0 p-4 bg-white">
      {loadingRequest ? (
        // Render the button with a spinner when loadingRequest is true
        <Button className="w-full text-white" color="success" variant="shadow" disabled>
          <Spinner color="white" />
          Aguarde...
        </Button>
      ) : (
        // Render the regular button when loadingRequest is false
        <Button
          className="w-full text-white"
          color="success"
          variant="shadow"
          onClick={handleSubmit}
        >
          Pagar
        </Button>
      )}
    </div>
    </form>
  );
}