docker-compose up -d --build site
echo "Will wait 10 seconds to make sure everything is running, if the following command fails please execute manually"
echo "docker-compose run artisan migrate --seed"
sleep 10
docker-compose run artisan migrate --seed