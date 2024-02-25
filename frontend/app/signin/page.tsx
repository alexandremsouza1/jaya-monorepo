import CheckoutForm from "../checkout/[paymentReqId]/checkoutForm";
import { getPaymentReq } from "@/src/api/server/checkout";
import { IPaymentRequiredDataResponse } from "@/src/api/types";



export default async function Home() {
    const paymentReqId = '1';
    const paymentInfo: IPaymentRequiredDataResponse = await getPaymentReq(
        paymentReqId
    );
    return (
        <CheckoutForm
          paymentReqId={paymentReqId}
          paymentInfo={paymentInfo}
        ></CheckoutForm>
    )
}