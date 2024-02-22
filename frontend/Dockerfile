# Stage 1: Construir a aplicação
FROM node:18 AS builder
WORKDIR /code/
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Executar a aplicação
FROM node:18
WORKDIR /code/
COPY --from=builder /code/ /code/
RUN npm install -g next
EXPOSE 3000
CMD ["npm", "run", "dev"]