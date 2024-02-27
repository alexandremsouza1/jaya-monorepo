import React,{useEffect} from "react";
import * as MP from "@/app/services/mercadoPagoService";

import { IPaymentRequiredDataResponse } from "@/src/api/types";
import {PayerCost} from "@mercadopago/sdk-react/coreMethods/util/types";
import {
  Badge,
  Card,
  CardBody,
  CardHeader,
  Divider,
  Image,
  Table,
  TableBody,
  TableCell,
  TableColumn,
  TableHeader,
  TableRow,
  Input,
  Select,
  SelectItem
} from "@nextui-org/react";

type Props = {
  paymentInfo: IPaymentRequiredDataResponse;
};

interface ICard {
  cardNumber: string;
  cardHolder: string;
  expirationMonth: string;
  expirationYear: string;
  cvv: string;
}

export default function PaymentInformationCard({paymentInfo}: Props) {

  const [installments, setInstallments] = React.useState<PayerCost[]>([]);
  const [selectedParcel, setSelectedParcel] = React.useState<string>();
  const [email , setEmail] = React.useState<string>('');
  const [documentType, setDocumentType] = React.useState<string>('');
  const [documentNumber, setDocumentNumber] = React.useState<string>('');
  const [amount, setAmount] = React.useState<string>('');
  const [card , setCard] = React.useState<ICard>({
    cardNumber: '',
    cardHolder: '',
    expirationMonth: '',
    expirationYear: '',
    cvv: ''
  });

  useEffect(() => {
    const getParcels = async () => {
      const mercadoPagoService: MP.MercadoPagoService = new MP.MercadoPagoService('TEST-7edc1fe6-c838-4c60-a86c-c05a3c3f1df7');
      let installments = await mercadoPagoService.GetParcels('1');
      if(installments && typeof installments[0] !== 'undefined')
        setInstallments(installments[0].payer_costs);
    }
    getParcels();
  },[amount]);

  const onParcelChange = (value: string) => {
    alert("Selected Installment:" + value);
    setSelectedParcel(value);
    // const parcel = installments.find(parcel => parcel.installments === parseInt(value));
    // setSelectedParcel(parcel?.recommended_message);
  }
  
  return (
    <div className="w-full flex flex-wrap gap-4">
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
    </div>
  );
}