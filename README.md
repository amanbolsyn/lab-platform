# Lab Platform

Inventory Management System(IMS) API for unversity lab. Students can register and books items. 

## Installation

Clone the repository 
```bash
git clone https://github.com/amanbolsyn/lab-platform.git
```

Build docker containers
```bash
make install
```

Start docker containers
```bash
make run
```

Stop docker containers
```bash
make down
```

Run new db migrations 
```bash
make migrate
```

Seed the database
```
make seed
```

 Run already migreated migrations
```
make fresh
```


## Roles 

| Roles | Description | 
|:------:|------|
| User | Can order items | 
| Admin | Can access all enpoints except adding new admins | 
| Root | Can access all endpoints | 


## API Endpoints 

### Cart endpoints 

| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/carts`| get all carts | admin, root
| GET | `/carts/:id`| get a cart | user, admin, root
| POST | `/carts`| create new cart | user
| PUT | `/carts/:id`| edit a cart | admin, root
| DELETE | `/carts/:id`| delete a cart| admin, root

### Item endpoints 

| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/items`| get all items | everyone
| GET | `/items?category=val1,val2`| filter items by category| everyone
| GET | `/items/:id`| get an item | everyone
| POST | `/items`| create new item| admin, root
| PUT | `/items/:id`| edit an item | admin, root
| DELETE | `/items/:id`| delete an item | admin, root


### Category endpoints 

| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/categories`| get all categories | user, admin, root
| POST | `/categories`| create new category | admin, root
| PUT | `/categories/:id`| edit a category | admin, root
| DELETE | `/categories/:id`| delete a category | admin, root


### Program endpoints 

| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/programs`| get all programs | user, admin, root
| POST | `/programs`| create new program | admin, root
| PUT | `/programs/:id`| edit a program | admin, root
| DELETE | `/programs/:id`| delete a program | admin, root

### User endpoints 
| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/users`| get all users | admin, root
| GET | `/users/:id`| get a user| user, admin, root
| PUT | `/users/:id`| change user information | admin
| PUT | `/users/:id`| add admin role | root

### Session endpoints 
| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| POST | `/login`| create new session | everyone
| POST | `/login`| destory the session| user

### Regisration endpoints 
| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| POST | `/register`| create new user | everyone

### Role endpoint
| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/roles`| get all roles | admin, root

### Dashboard endpoint 
| Method | Endpoint | Description | Roles |
|:------:|------|------|:------:|
| GET | `/dashboard`| get cart analytics | admin, root

## Possible improvements 


## Bugs 

## Resources 

+ [Laravel Docs](https://laravel.com/docs/12.x/installation)

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

## License

Cannot be used for commercial purposes.