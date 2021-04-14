# TestApp (Yii2 + Docker)

## Desscription
Test app for getting last 100 tweets that contains hashtag pilulka.cz or link to pilulka.cz

## Installation
1. Clone repo
2. Create .env file from docker/environment/local-dev/.env.dist and adjust USER_ID and GROUP_ID
   settings according to your current user (to make right permissions on files created from the containers)
3. You'll need the Make tool to run this project (Ubuntu `apt install make`)
4. Run `make build` it will build and run docker containers and install dependencies (composer)
5. The app would be available on localhost:80
6. Configure Twitter API tokens and secrets in /app/config/params.php

**Look to the MakeFile for other useful commands**

## Usage
### API
The app provides several API endpoints for getting or setting the settings of the microservices:

- GET /api/tweets/last-html
  
  _returns JSON array with tweets in simple html template_
- GET /api/tweets/last-json

  _returns JSON array with tweets as it's come from Twitter API_

Response format **JSON**

### From browser
Use these urls

- /api/tweets/last-html
- /api/tweets/last-json
