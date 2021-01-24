# create data object

1.  just extend this class and set attributes and methods you need.

    ```php
    use miladm\DataObject;

    class User extends DataObject
    {
        public string $name;
        public int $age;
        public string $email;

        public function validateEmail()
        {
            return $this->email == 'miladmohebnia@gmail.com';
        }

        public function validateName()
        {
            return strlen($this->name) >= 4;
        }

        public function validate()
        {
            return $this->validateName() &&
                $this->validateEmail();
        }
    }
    ```

1.  create init method for setting actions happen before object constructs.

    ```php
    class User extends DataObject
    {
        public object $profile;
        public object $feed;

        public function init()
        {
            $this->profile = new Profile();
            $this->feed = Feed::class;
        }
    }
    ```

1.  you can add data both with `constructor` and `injectMethod`

    1. using constructor

       ```php
           class User extends DataObject
           { .... }

           $user = UserModel::get_by_id(12);
           $u = new User($user);
       ```

    1. using `injectMethod`

       ```php
            class User extends DataObject
           { .... }

           $u = new User();
           $user = UserModel::get_by_id(12);
           $u->injectData($user);

       ```

# Using Model inside DataObject

```php
class User extends DataObject
{
    private $model;

    public function init()
    {
        $this->model = UserModel::class;
    }

    public function loadUser_byId(int $id)
    {
        $this->injectData($this->model::where(['id' => $id])->getOne());
    }
}

$user = new User;
$user->loadUser_byId(12);

// code above used as alternative to code below

// $user = UserModel::get_by_id(12);
// $u = new User($user);

```
