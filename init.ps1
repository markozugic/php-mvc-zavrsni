Function log {
    param(
        [Parameter(Mandatory=$true)][String]$msg
    )

    Write-Output "[$(Get-Date)] - $($msg)"
}

Function err {
    param(
        [Parameter(Mandatory=$true)][String]$msg
    )

    Write-Error "[$(Get-Date)] - $($msg)"
    exit
}

log "Removing previous volumes"
docker-compose down -v
log "Starting docker-compose stack..."
docker-compose up -d
if (!$?)
{
    err "Error while starting docker-compose stack."
}

log "Installing dependencies"
docker-compose run --rm composer install
if (!$?)
{
    err "Error while installing dependencies."
}

log "Finished."