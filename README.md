# Build
## Run locally using php
In src/ directory run:
```
php -S localhost:4220
```

## Build & run locally using docker
```
docker build -t php-timeline:1.0 .
docker run -p 8000:80 php-timeline:1.0
```

# Deploy
## Google cloud login
```
gcloud auth login
gcloud config set project php-timeline
gcloud auth configure-docker
```

## Build & push docker image to GCloud
```
docker build -t gcr.io/php-timeline/php-timeline-app .
docker push gcr.io/php-timeline/php-timeline-app  
```

