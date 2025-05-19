#!/bin/bash

cd /app
composer install
npm install
npm run build
