## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) and docker-compose (included in Docker for Mac) on your system

Next, go to your terminal and run `run.sh` in this folder

After that completes, the service will be available on localhost on default port 80.

The requested endpoint is available at `localhost/api/calculate-discounts` and will accept a `get` request with the content as JSON in it's body.

All data will be stored in a MySQL database to simulate a real life situation as good as possible.

This microservice was developped on Ubuntu, please keep in mind that when running Docker on MacOS might decrease it's performance.

Bringing up the Docker Compose network with `site` instead of just using `up`, ensures that only our site's containers are brought up at the start, instead of all of the command containers as well. The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

Three additional containers are included that handle Composer, NPM, and Artisan commands _without_ having to have these platforms installed on your local computer. Use the following command examples from your project root, modifying them to fit your particular use case.

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate`
