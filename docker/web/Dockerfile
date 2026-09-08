FROM node:22-alpine

WORKDIR /workspace

CMD ["sh", "-c", "npm install && npm run build -w @24hc/shared && npm run build -w @24hc/api-client && npm run dev -w @24hc/web"]
