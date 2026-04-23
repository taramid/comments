##!/bin/bash
## This script handles the multi-arch build and exports it to a file
#echo "Building image for linux/amd64..."
#docker buildx build \
#  --platform linux/amd64 \
#  --pull \
#  --no-cache \
#  -f compose.yaml \
#  -f compose.prod.yaml \
#  -t app-php-prod:latest \
#  --output type=docker,dest=app.tar .
#echo "Build complete: app.tar created."
#
# з цим підохдом потрібно якось окремо тягти змінні з *.yaml файлів, що трохи морочливо
#
# тому поки будемо створювати образ на linux-сервері

SERVER_NAME=:80 docker compose -f compose.yaml -f compose.prod.yaml build --pull --no-cache
