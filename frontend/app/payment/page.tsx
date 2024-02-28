import PaymentInformationCard from "../checkout/payment-info";


export default function Payment() {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', minHeight: '90vh' }}>
      <div style={{ flex: 1 }}>
        <PaymentInformationCard />
      </div>
    </div>
  );
}
