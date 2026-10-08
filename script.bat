echo "Building Docker images..."
docker build -t edy1901/projeto-backend:1.0 ./backend
docker build -t edy1901/projeto-database:1.0 ./database  

echo "Pushing Docker images to Docker Hub..."
docker push edy1901/projeto-backend:1.0
docker push edy1901/projeto-database:1.0

echo "Docker images built and pushed successfully!"

echo "Deploying to Kubernetes..."
kubectl apply -f ./pv.yaml
kubectl apply -f ./pvc.yaml
kubectl apply -f ./services.yaml
kubectl apply -f ./deployment.yaml

kubectl rollout restart deployment backend-deployment

echo "Deployment completed successfully!"



