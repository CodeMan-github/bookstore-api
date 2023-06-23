# Bookstore api
Create a bookstore api 

### Constraints:
1. Laravel 9+ (PHP 8.1+)
2. Git

### API Requirements:
1. Users can view the book details.
2. Users can borrow books and retrieve the borrowed books details.
3. Managers can add new, update details, or remove books.
4. Create/Update seeders accordingly
5. Api testing - 3 tests minimum.

#### Book model:
- Title
- Description
- Publisher
- Author
- Cover Photo
- Price

**Come up with a solution for any other required model(s)**

## API Endpoints

### **Auth**

#### *Register*

URL Parameters:

- `name` - string / *must not be greater than 255 characters*
- `email` - string / *must not be greater than 255 characters and must be a valid email address.*
- `password` - string  
- `password_confirmation` - string  
- `user_type` - string  / *must be `user` or `manager`*

Endpoints:

- `POST api/auth/register`

#### *Login*

URL Parameters:

- `email` - string / *must be a valid email address.*
- `password` - string  

Endpoints:

- `POST api/auth/login`

---

### **Books**

Note: All endpoints requires authentication.

#### *Display a listing of the books*

Endpoints:

- `GET api/v1/books`

#### *Store a newly created book in storage*

Endpoints:

- `POST api/v1/books`

#### *Display the specified book*

URL Parameters:

- `id` - integer 

Endpoints:

- `GET api/v1/books/{id}`

#### *Update the specified book in storage*

URL Parameters:

- `id` - integer  

Endpoints:

- `PUT api/v1/books/{id}`
- `PATCH api/v1/books/{id}`

#### *Remove the specified book from storage*

URL Parameters:

- `id` - integer 

Endpoints:

- `DELETE api/v1/books/{id}`

#### *Borrow the specified book*

POST Parameters:

- `book_id` - integer  

Endpoints:

- `POST api/v1/books/borrow`

#### *Get the borrowed books of the current user*

Endpoints:

- `GET api/v1/books/borrowed`

## How To Run

- Clone the repository to your local machine and navigate to the project's root directory in a terminal.
- Copy the `.env.example` file and name it `.env`.
- Update the `.env` file with the appropriate database credentials and settings.
- Run `composer install` to install all the required dependencies.
- Generate an application key by running `php artisan key:generate`.
- Run database migrations by running `php artisan migrate`.
- Run database seeds by running `php artisan db:seed`.
- Run api tests by running `php artisan test`.
- Run the Laravel server by running `php artisan serve`.
