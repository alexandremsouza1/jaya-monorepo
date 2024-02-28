(1) '/api/clients' = Aqui se cria o usuário no banco efetivamente. São informações básicas (cpfCnpj, nome da empresa, nome do proprietário, senha, email e telefones)
(2) '/api/step-2' = Update no user com endereço
(3) '/api/step-3' = Update no user com o object quiz (codigo, dias_semana, turnos)
(4) '/api/step-4' = Etapa que conclui o cadastro do usuário. São informações de upload de documentos e dados do sócio (cpf_socio, data_nascimento_socio, primeiro_nome_socio, ultimo_nome_socio, foto_documento, foto_endereco, foto_estabelecimento_fachada, foto_estabelecimento_interior)





'/api/registration-status/' = Request para verificar o status do CNPJ/CPF do usuário

//Define o status (ativo, cliente_base, sem_registros, parcial_sms, parcial_sms_ativo, cadastro_parcial, parcial_quiz, bloqueado, analise)

'/api/valida-cpf' = verifica primeiro nome + último nome + data de nascimento + CPF na receita federal



//
| 0-  Tem cadastro na base = dbClient
| 1-  Sem registro  = noRegister
| 2 - Ativação SMS Pendente  = confirmation
| 3 - Cadastro em Análise  = review
| 4 - Cadastro Bloqueado =  blocked
| 5 - Cadastro Cancelado = canceled
| 6 - Cadastro na etapa do Contato = contact
| 7 - Cadastro na etapa da Empresa = company
| 8 - Cadastro na etapa da Logistica = logistic
| 9 - Cadastro na Etapa de Envio de Documento = documents
| 10 - Cadastro dentro do prazo para reanalise = reanalysis
| 11 - Ativo  = active


const client = {
  cpfCnpj: '034.875.283-04',
  company: {
    name: 'Razão Social da Empresa',
    businessKey: '',
    address: {
      postalCode: '60.020-060',
      street: 'Rua Coronel Luiz David de Souza',
      neighborhood: 'Benfica',
      city: 'Fortaleza',
      state: 'CE',
      streetNumber: '123',
      complement: 'AP 2101, Torre A',
      reference: 'Prox ao posto',
    },
  },
  responsible: {
    name: 'Guibson Martins',
    email: 'guibson1991@gmail.com',
    cellphone: '(85) 99694-2049',
    residencialPhone: '(85) 94848-1243',
    comercialPhone: '',
    password: '123',
  },
  logistic: {
    attendanceMode: 'digital', //'digital' or 'in-person'
    openingStatus: 'open',
    availableDays: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
    availableHours: ['MORNING', 'AFTERNOON', 'NIGHT'],
  },
  partner: {
    cpf: '040.720.323-01',
    firstName: 'João',
    lastName: 'Alencar',
    birthday: '1982-08-02T19:21:00',
  },
  documents: {
    identification:
      'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA/EAAAVXCAIAVORK5CYII=',
    addressProof:
      'data:image/jpeg;base64,/9j/4cEVRXhpZgAASUkqAAgAAAANAAABBAABAAAAgAsAAAEB',
    storeFront:
      'data:image/jpeg;base64,/9j/4cAlRXhpZgAASUkqAAgAAAANAAABBAABAAAAwA8AAAEBBA',
    storeInterior:
      'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgICAgMCAgID',
  },
};



------------------------------

- Connect to Docker PHP-FPM Container Terminal

Linux Users:

    docker exec -it mup_mobiq_register_php /bin/bash

Windows Users, via PowerShell or CMD:

    docker exec -it mup_mobiq_register_php /bin/sh

Windows Users, via Git Bash:

    winpty docker exec -it mup_mobiq_register_php //bin/bash


