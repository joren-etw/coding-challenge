## Usage

To get started, make sure you have [Docker](https://docs.docker.com/docker-for-mac/install/), docker-compose (included in Docker for Mac) and composer installed on your system

Open your terminal and go to the `./src` folder. From here, run `composer install`.
Next, go to the root folder and run `run.sh`.

After that completes, the service will be available on localhost on default port 80.

The requested endpoint is available at `localhost:80/api/calculate-discounts` and will accept a `get` request with the content as JSON in it's body.

I've included two versions for the free product discount:

It was not clear to me wether the sixth product needed to be added automatically, that's why I made:
- a version that automatically adds the sixth product
- a version that sets the sixth product for free but keeps the original quantity.

`App\Models\DiscountRuleFreeFromQuantity` contains a private Boolean `discountMethodSet`. If this is true, the sixth product will be set as free.
In the examples this means that:

- when you buy 5 you will not get a free product
- when you buy 10 you will get 1 free product (5 + 1 free + 4)

if this is false a sixth product will automatically be added.

I know this is something that differs between users so it seemed to me this would be a good way to solve this. In a real life situation this boolean could be a usersetting.

All data will be stored in a MySQL database to simulate a real life situation as good as possible.

`` A postman collection was included (`Discounts_challenge.postman_collection.json`) that includes all example orders and can be imported in Postman. ``

Bringing up the Docker Compose network with `site` instead of just using `up`, ensures that only our site's containers are brought up at the start, instead of all of the command containers as well. The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

Three additional containers are included that handle Composer, NPM, and Artisan commands _without_ having to have these platforms installed on your local computer. Use the following command examples from your project root, modifying them to fit your particular use case.

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate`
