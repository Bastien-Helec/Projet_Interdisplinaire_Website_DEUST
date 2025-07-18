#!/bin/bash

while true
do
    echo "=== État des conteneurs Congres ==="
    
    # Obtenir les IDs des conteneurs correspondant à Congres
    CONTAINERS=$(docker ps -a --filter "name=Congres" --format "{{.ID}}")

    for ID in $CONTAINERS; do
        NAME=$(docker inspect -f '{{.Name}}' $ID | cut -c2-)
        STATUS=$(docker inspect -f '{{.State.Status}}' $ID)
        IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $ID)

        echo "Nom      : $NAME"
        echo "IP       : $IP"
        echo "Statut   : $STATUS"
        echo "-----------------------------"
    done

    sleep 45
done

