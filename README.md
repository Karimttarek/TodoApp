# ToDo-List-Application
Simple ToDo List Application(ASSESSMENT TASK)

## Version
```bash
Laravel v11.16.0 
(PHP v8.3.9)
```
## Installation
```bash
git clone https://github.com/Karimttarek/TodoApp.git
```
```bash
cd TodoApp
```
```bash
composer update
```

## Copy env.example to .env
```bash
cp .env.example .env
```
- Change DB_CONNECTION=sqlite to mysql
- Then configure database connection

## Generate a new key 
```bash
php artisan key:generate
```
## Database Migration 
```bash
php artisan migrate --seed
```
- Make sure to use the command to seed categories to database

## Default user created
[kariimttarek@gmail.com]
[password]

## NPM
```bash
npm i
```
```bash
npm run build
```

## Run the application.
```bash
php artisan serve
```

## Finaly !
- After Login, Click on top right button (Todo-List) to see tasks list 
- There is no tasks seeded by default try to add some tasks
- or visit the link below.
```bash
your-app-url/todo-list
```
