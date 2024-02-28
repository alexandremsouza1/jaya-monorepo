export type ICustomer = {
  email: string;
  identification : {
    type: string;
    number: string;
  }
};

export type IItem = {
  name: string;
  unitPrice: number;
  description: string;
  imgUrl: string;
  quantity: number;
};

export type IPaymentRequiredDataResponse = {
  amount: number;
  currency: string;
  shopId: number;
  products: IItem[];
  executed: boolean
  requiredData?: IPaymentRequestRequiredData;
};

export type IPaymentRunRequest = {
  transaction_amount : string;
  installments: string;
  token?: string;
  payment_method_id: string;
  payer: ICustomer;
};

export type ICard = {
  cardNumber: string;
  cardHolder: string;
  expirationMonth: string;
  expirationYear: string;
  cvv: string;
};

export type IPaymentRequestRequiredData = {
  mercadoPagoToken?: string;
};

export type CreateUserRequest = {
  email: string;
  password: string;
};

export type IEntityBase = {
  id: number;
  deletedAt: Date | null;
  updatedAt: Date;
  createdAt: Date;
};

export type IRole = IEntityBase & {
  name: string;
};

export type IUser = IEntityBase & {
  email: string;
  // TODO: add status
};

export type IUserStatus = "VERIFY" | "FORGOT_PASSWORD" | "OK";

export type UserResponse = IEntityBase & {
  role: IRole;
  email: string;
  status: IUserStatus;
};

export type ParsedUser = {
  id: number;
  email: string;
  role_name: string;
};

export type ShopResponse = IEntityBase & {
  name: string;
};

export type FlowSummary = {
  id: string;
  name: string;
  active: boolean;
  updatedAt: Date;
  createdAt: Date;
};

export type AmountProcessed = {
  value: string;
  currency: string;
};

export type ICurrency =
  | 'ARS'
  | 'USD'
  | 'EUR'
  | 'GBP'

  export type Payment = {
    value: number;
    currency: ICurrency;
  };

export type TemporalAmounts = {
  date: string;
  payments: Payment[];
};

export type AnalyticsResponse = {
  avgPaymentSucceeded: string
  overAllPayments: string
  paymentsSucceeded: string
  paymentsFailed: string
  flowsSucceeded: string
  flowsFailed: string
  totalAmountsProcessed: AmountProcessed[]
  avgPaymentAmounts: AmountProcessed[]
  temporalAmounts: TemporalAmounts[]
}

export type ProcessorAnalyticsResponse = {
  processor: string
  analytics: AnalyticsResponse
}

export type ICardType =
  | 'VISA'
  | 'AMEX'

export type Card = {
  nameOnCard: string
  last4Numbers: string
  cardBrand: ICardType
}

export type IPaymentMethod =
  | 'CREDIT_CARD'
  | 'DEBIT_CARD'

export type PaymentRequest = {
  amount: string
  associatedFlowId: string
  customer: ICustomer
  currency: ICurrency
  products: IItem[]
  executed: boolean
  id: string
  notificationURL: string
  redirectURL: string
}

export type PaymentSummary = {
  card: Card
  paymentReq: PaymentRequest
  paymentMethod: IPaymentMethod
  customer: ICustomer
}

export type IDisplayType =
  | 'secret'
  | 'plain'
  | 'content'

export type ITypeParameter = 
  | 'string'
  | 'object'
  | 'any'
  | 'number'
  | 'boolean'

export type IField =
  | 'ACCESS_TOKEN'

export type Parameters = {
  field: IField
  type: ITypeParameter
  display: IDisplayType
  value: string
  id: string
}

export type ITypeTask = 
  | 'MERCADO_PAGO_TASK'
  | 'BINANCE_TASK'
  | 'TRANSBANK_TASK'
  | 'SLACK_TASK'
  | 'EMAIL_TASK'

  export type ICategoryTask = 
  | 'PROCESSOR'
  | 'NOTIFICATION'
  | 'QUERY'

export type Task = {
  type: ITypeTask
  category?: ICategoryTask
  name: string
  description: string
  isAsync: boolean
  taskParams: Parameters
  fallback?: Task
}

export type IOperator = 
| 'NONE'
| 'EQUALS'
| 'GREATER_THAN'
| 'GREATER_OR_EQUALS_THAN'
| 'LESS_THAN'
| 'LESS_OR_EQUALS_THAN'
| 'IS'
| 'IS_NOT'
| 'CONTAINS'
| 'DOES_NOT_CONTAIN'

export type IFieldType = 
| 'AMOUNT'
| 'CURRENCY'
| 'METHOD'

export type ICondition = {
  operator: IOperator
  value: any
  field: IFieldType
}

export type IConditionOperators = 
| 'AND'
| 'OR'

export type Rule = {
  name: string
  conditions: ICondition[]
  conditionOperators: IConditionOperators
  task?: Task
}

export type TaskDescription = {
  type: ITypeTask
  name: string
  description: string
}

export type ICanonicalError = 
// User params errors
| "INVALID_USER_PARAMETERS"
| "INVALID_CARD_NUMBER"
| "INVALID_CVV"
// External errors
| "PARAMS_PARSE_ERROR"
| "ALREADY_MAKE_REQUEST_EARLY"
| "PROVIDER_RETURNED_500"
| "PROVIDER_TIMEOUT"
| "INVALID_CREDENTIALS"
| "UNKNOWN_ERROR"
| "NO_ERROR"

export type TaskError = {
  task: TaskDescription
  statusCode: number
  canonicalError: ICanonicalError
  taskMessage: string[]
}

export type FlowExecutionResponse = {
  createdAt: Date
  flowSummary: FlowSummary
  paymentSummary: PaymentSummary
  flowSucceed: boolean
  paymentSucceed: boolean
  executedRules: Rule[]
  tasksErrors: TaskError[]
  id: string
}

export type IPaymentStatusResponse = {
  flowExecId: string
  paymentSucceed: boolean
  tasksErrors: TaskError[]
  paymentReqExecuted: boolean
  redirectURL?: string
}


export type IPaymentRequest = {
  amount: number
  customer: ICustomer
  shopId: number
  associatedFlowId: string
  products: IItem[]
}


