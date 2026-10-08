
# k8s-projeto1-app-base

Stack completa de microsserviços rodando no Kubernetes (Docker Desktop), com frontend HTML/JS, backend PHP e banco MySQL.

## Arquitetura

```
[Navegador] → [backend-service:80] → [backend-deployment (6x PHP+Apache)]
                                              │
                                              │ TCP 3306
                                              ▼
                                    [mysql-local (Service)]
                                              │
                                              ▼
                                    [mysql-local (MySQL 8.0)]
                                              │
                                              ▼
                                    [PVC local] → [PV local]
                                              │
                                              ▼
                                    hostPath: /local/meuBanco
```

## Tecnologias

- **Frontend**: HTML5, CSS3, JavaScript, jQuery
- **Backend**: PHP 8.2 + Apache
- **Banco de dados**: MySQL 8.0
- **Orquestração**: Kubernetes (Docker Desktop)
- **Persistência**: PersistentVolume + PersistentVolumeClaim (hostPath)

## Pré-requisitos

- Docker Desktop com Kubernetes habilitado
- `kubectl` configurado
- Conta no Docker Hub (ou ajuste as tags das imagens)

## Como rodar

### 1. Clone o repositório

```bash
git clone https://github.com/SEU_USUARIO/k8s-projeto1-app-base.git
cd k8s-projeto1-app-base
```

### 2. Ajuste as imagens

Edite `deployment.yaml` e troque `edy1901` pelo seu usuário do Docker Hub.

### 3. Rode o script de build e deploy

No Windows:

```cmd
script.bat
```

Ou manualmente:

```bash
docker build -t SEU_USUARIO/projeto-backend:1.0 ./backend
docker build -t SEU_USUARIO/projeto-database:1.0 ./database
docker push SEU_USUARIO/projeto-backend:1.0
docker push SEU_USUARIO/projeto-database:1.0
kubectl apply -f ./pv.yaml
kubectl apply -f ./pvc.yaml
kubectl apply -f ./services.yaml
kubectl apply -f ./deployment.yaml
kubectl rollout restart deployment backend-deployment
```

### 4. Acesse

```bash
kubectl port-forward service/backend-service 8080:80
```

Abra `http://localhost:8080` no navegador.

## Estrutura de pastas

- `backend/` — Código PHP + Dockerfile (imagem PHP 8.2 + Apache)
- `database/` — SQL de inicialização + Dockerfile (imagem MySQL 8.0)
- `*.yaml` — Manifestos Kubernetes
- `script.bat` — Automação de build + push + deploy

## Funcionalidades

- Formulário de contato (nome, email, mensagem)
- Inserção no banco MySQL via AJAX
- Listagem de mensagens cadastradas
- Persistência de dados entre reinícios dos Pods

## Aviso

Este projeto é para fins de estudo. As senhas estão em texto plano nos manifestos e no Dockerfile. **Não use em produção** sem antes:

- Mover senhas para Kubernetes Secrets
- Configurar HTTPS com Ingress + cert-manager
- Usar um StorageClass dinâmico em vez de hostPath
- Configurar liveness/readiness probes
- Adicionar monitoramento e logging centralizado

## Licença

MIT
