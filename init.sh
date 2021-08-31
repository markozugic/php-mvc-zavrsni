#!/bin/bash
#
# Initialize Laravel project for first usage.
#

# STDERR log function
err() {
  echo -e "\n[$(date +'%Y-%m-%dT%H:%M:%S%z')]: $@\n" >&2
  exit 1
}

# STDOUT log function
log() {
  echo -e "\n[$(date +'%Y-%m-%dT%H:%M:%S%z')]: $@\n"
}

# Check if Docker is installed
if ! type "docker" > /dev/null 2>&1; then
    err "Docker not installed"
fi

# Check if Docker-compose is installed
if ! type "docker-compose" > /dev/null 2>&1; then
    err "Docker-Compose not installed"
fi
log "Looks like both docker and docker-compose are installed, everything looks good."

log "Removing previous volumes"
docker-compose down -v
log "Starting docker-compose stack..."
docker-compose up -d
if [ $? -ne 0 ]; then
    err "Error while starting docker-compose stack."
fi

log "Installing dependencies"
docker-compose run --rm composer install
if [ $? -ne 0 ]; then
    err "Error while installing dependencies."
fi

log "Finished."