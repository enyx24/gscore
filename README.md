# GScore
This is an assignment for my internship.
### Requirement
- Docker
- Git
### Installation
- Clone this project:<br>
`git clone https://github.com/enyx24/gscore`
- Change dir into repo:<br>
`cd gscore`
- Run docker compose:<br>
`docker compose up`<br>
Including docker compose, composer install, npm install, build, run server, database migrate - seed. Details: [docker-compose](https://github.com/enyx24/gscore/blob/master/docker-compose.yml) [init.sh](https://github.com/enyx24/gscore/blob/master/init.sh)<br>
**Notes: It takes long time so please be patient**
- Access on localhost:8000
### Features
- [Migration](https://github.com/enyx24/gscore/blob/master/database/migrations/2025_05_18_101527_create_score_table.php), [Seeder](https://github.com/enyx24/gscore/blob/master/database/seeders/ScoreSeeder.php), [Converter](https://github.com/enyx24/gscore/blob/master/app/Console/Commands/ImportScores.php).
- Check score from registration number (Check Scores tab).
- Statistics of the number of student with scores in 4 levels by subjects (Reports tab).
- List top 10 students of group A (Reports tab).
- Responsive design.
